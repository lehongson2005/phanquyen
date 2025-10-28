<?php

namespace App\Models; // Sửa namespace thành App\Models

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; // <-- Kế thừa từ Model là đủ
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\DB; // Vẫn cần DB facade cho computePermissionsMap

class User extends Model // <-- Chỉ cần kế thừa Model
{
    use HasFactory, SoftDeletes; // Bỏ Notifiable, HasApiTokens

    protected $table = 'users';
    protected $primaryKey = 'user_id';

    // Bỏ các trường liên quan đến password, token
    // Bỏ luôn user_username nếu không cần thiết cho việc hiển thị/tìm kiếm
    protected $fillable = [
        'user_student_code',
        'user_full_name',
        'user_first_name',
        'user_last_name',
        'user_gender',
        'user_date_of_birth',
        'user_avatar',
        'user_email',
        'user_phone_number',
        'user_address',
        'user_city',
        'user_country',
        'user_student_id_card',
        'user_faculty_id',
        'user_class_id',
        'user_major',
        'user_course_year',
        'user_status', // Cột enum('Đang học', 'Bỏ Học', 'Tạm nghỉ') từ migration gốc
        'user_is_active', // Vẫn giữ để biết user có bị khóa không (từ API gốc)
        'user_emergency_contact_name',
        'user_emergency_contact_phone',
        'user_note',
        'status', // Cột tinyInteger (0, 1, 2...) từ migration chung
        'sequence',
        'version',
        'created_user_id', // Giữ lại nếu bạn muốn biết ai đồng bộ/tạo record này
        'updated_user_id', // Giữ lại nếu bạn muốn biết ai cập nhật record này
        // 'user_username', // Chỉ thêm nếu API public trả về và bạn cần dùng
    ];

    // Bỏ hidden password, token
    protected $hidden = [
        // Không cần ẩn gì đặc biệt ở đây nữa
    ];

    // Bỏ các cast liên quan đến xác thực/đăng nhập
    protected $casts = [
        'user_date_of_birth' => 'date',
        'user_is_active' => 'boolean',
        // 'user_email_verified_at' => 'datetime', // Chỉ giữ nếu API public trả về
        // 'user_last_login_at' => 'datetime', // Chỉ giữ nếu API public trả về
    ];

    // --- CÁC QUAN HỆ (Vẫn giữ nguyên) ---

    public function faculty(): BelongsTo
    {
        // Giả định Model Faculty tồn tại trong App\Models
        return $this->belongsTo(\App\Models\Faculty::class, 'user_faculty_id', 'faculty_id');
    }

    public function class(): BelongsTo
    {
        // Giả định Model ClassModel tồn tại trong App\Models
        return $this->belongsTo(\App\Models\ClassModel::class, 'user_class_id', 'class_id');
    }

    /**
     * Quan hệ này RẤT QUAN TRỌNG để liên kết với hệ thống phân quyền CỦA BẠN
     */
    public function roles(): BelongsToMany
    {
        // Giả định Model Role tồn tại trong App\Models
        return $this->belongsToMany(\App\Models\Role::class, 'user_roles', 'user_id', 'role_id')
                    ->withTimestamps()
                    // Lấy các trường chung từ bảng pivot user_roles
                    ->withPivot('status', 'created_user_id', 'updated_user_id', 'deleted_at');
    }

    // --- HÀM TÍNH TOÁN QUYỀN (Vẫn giữ nguyên logic query 6 bảng) ---

    /**
     * Tính toán map quyền dựa trên các role được gán TRONG DATABASE CỦA BẠN.
     * @return array
     */
    public function computePermissionsMap(): array
    {
        // Kiểm tra xem quan hệ 'roles' có tồn tại không
        if (!method_exists($this, 'roles')) {
            return [];
        }

        // Lấy ID các role gắn với user này (từ bảng user_roles CỦA BẠN)
        $roleIds = $this->roles()->pluck('roles.id')->toArray();

        if (empty($roleIds)) {
            return []; // User này không có role nào được gán trong hệ thống của bạn
        }

        // Logic này query các bảng phân quyền (role_permissions, permissions_screens, screens)
        // để xây dựng map quyền cho user dựa trên các role họ có (trong DB của bạn)
        $rows = DB::table('roles')
            // 1. Từ Role -> role_permissions (để lấy permission_id)
            ->join('role_permissions', 'roles.id', '=', 'role_permissions.role_id')
            // 2. Từ role_permissions -> permissions_screens (dùng chung permission_id)
            ->join('permissions_screens', 'role_permissions.permission_id', '=', 'permissions_screens.permission_id')
            // 3. Từ permissions_screens -> screens (để lấy screen_code)
            ->join('screens', 'permissions_screens.screen_id', '=', 'screens.id')
            // Chỉ lấy các quyền của các role mà user này có
            ->whereIn('roles.id', $roleIds)
             // Lọc thêm các bản ghi không bị soft delete trong bảng pivot (nếu cần)
            ->whereNull('role_permissions.deleted_at') 
            ->whereNull('permissions_screens.deleted_at')
            ->select(
                'screens.screen_code',
                'permissions_screens.is_view',
                'permissions_screens.is_add',
                'permissions_screens.is_edit',
                'permissions_screens.is_delete',
                'permissions_screens.is_scan', // Giữ lại quyền tùy chỉnh của bạn
                'permissions_screens.is_all'
            )
            ->distinct() // Lấy các quyền duy nhất cho từng màn hình
            ->get();

        $map = [];
        foreach ($rows as $r) {
            $screenCode = $r->screen_code;
            if (!isset($map[$screenCode])) {
                // Khởi tạo map cho màn hình này
                $map[$screenCode] = [
                    'is_view' => false, 'is_add' => false, 'is_edit' => false,
                    'is_delete' => false, 'is_scan' => false, 'is_all' => false,
                ];
            }
            // Gộp quyền (logic OR)
            // Nếu MỘT trong các role có quyền true, thì user sẽ có quyền true
            $map[$screenCode]['is_view'] = $map[$screenCode]['is_view'] || (bool)$r->is_view;
            $map[$screenCode]['is_add'] = $map[$screenCode]['is_add'] || (bool)$r->is_add;
            $map[$screenCode]['is_edit'] = $map[$screenCode]['is_edit'] || (bool)$r->is_edit;
            $map[$screenCode]['is_delete'] = $map[$screenCode]['is_delete'] || (bool)$r->is_delete;
            $map[$screenCode]['is_scan'] = $map[$screenCode]['is_scan'] || (bool)$r->is_scan;
            $map[$screenCode]['is_all'] = $map[$screenCode]['is_all'] || (bool)$r->is_all;
        }
        return $map;
    }


    // --- CÁC SCOPE (Để lấy/lọc dữ liệu) ---

    /**
     * (Logic) Scope tìm kiếm user dựa trên tên, email, mã SV.
     */
    public function scopeSearch($query, $term)
    {
        if ($term) {
            // Bao trong closure để nhóm các điều kiện OR lại
            return $query->where(function ($q) use ($term) {
                $q->where('user_full_name', 'like', '%' . $term . '%')
                  ->orWhere('user_email', 'like', '%' . $term . '%')
                  ->orWhere('user_student_code', 'like', '%' . $term . '%');
            });
        }
        // Nếu không có term, không làm gì cả
        return $query;
    }

    /**
     * Scope để lọc user theo khoa.
     */
    public function scopeByFaculty($query, $facultyId)
    {
        return $query->where('user_faculty_id', $facultyId);
    }

    /**
     * Scope để lọc user theo lớp.
     */
    public function scopeByClass($query, $classId)
    {
        return $query->where('user_class_id', $classId);
    }
}

