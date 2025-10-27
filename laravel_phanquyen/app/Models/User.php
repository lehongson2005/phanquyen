<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// 1. LỖI NGHIÊM TRỌNG: Phải dùng 'Authenticatable', không phải 'Model'
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable; // Thêm trait Notifiable tiêu chuẩn
use Laravel\Sanctum\HasApiTokens; // 2. LỖI NGHIÊM TRỌNG: Thiếu trait này
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class User extends Authenticatable // <-- SỬA Ở ĐÂY
{
    // 3. THÊM 2 TRAITS QUAN TRỌNG
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * Tên bảng.
     */
    protected $table = 'users';

    /**
     * Tên khóa chính (Đã đúng).
     */
    protected $primaryKey = 'user_id';

    /**
     * Các trường được phép gán (Đã đúng).
     */
    protected $fillable = [
        // Thông tin cá nhân
        'user_student_code',
        'user_full_name',
        'user_first_name',
        'user_last_name',
        'user_gender',
        'user_date_of_birth',
        'user_avatar',
        // Thông tin liên hệ
        'user_email',
        'user_phone_number',
        'user_address',
        'user_city',
        'user_country',
        // Thông tin học vụ
        'user_student_id_card',
        'user_faculty_id',
        'user_class_id',
        'user_major',
        'user_course_year',
        'user_status', // Cột enum('Đang học', 'Bỏ Học', 'Tạm nghỉ')
        // Thông tin đăng nhập
        'user_username',
        'user_password',
        'user_email_verified_at',
        'user_last_login_at',
        'user_is_active',
        // Thông tin bổ sung
        'user_social_id',
        'user_emergency_contact_name',
        'user_emergency_contact_phone',
        'user_note',
        // Trường chung
        'status', // Cột tinyInteger (0, 1, 2...)
        'sequence',
        'version',
        'created_user_id',
        'updated_user_id'
    ];

    /**
     * Các trường ẩn khi trả về JSON (Đã đúng).
     */
    protected $hidden = [
        'user_password',
        'user_remember_token',
    ];

    /**
     * Ép kiểu (Đã đúng).
     */
    protected $casts = [
        'user_email_verified_at' => 'datetime',
        'user_last_login_at' => 'datetime',
        'user_date_of_birth' => 'date',
        'user_is_active' => 'boolean',
    ];

    /**
     * Lấy cột mật khẩu (Đã đúng).
     * BẮT BUỘC vì bạn dùng 'user_password'.
     */
    public function getAuthPassword()
    {
        return $this->user_password;
    }

    // --- CÁC QUAN HỆ ---

    /**
     * Quan hệ (N-1) với Faculty (Khoa).
     * Giả định Model 'Faculty' tồn tại.
     */
    public function faculty(): BelongsTo
    {
        return $this->belongsTo(Faculty::class, 'user_faculty_id', 'faculty_id');
    }

    /**
     * Quan hệ (N-1) với Class (Lớp).
     * Giả định Model 'ClassModel' tồn tại.
     */
    public function class(): BelongsTo
    {
        return $this->belongsTo(ClassModel::class, 'user_class_id', 'class_id');
    }

    /**
     * Quan hệ (N-N) với Role (Vai trò).
     * Đây là quan hệ chính để kiểm tra vai trò.
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'user_roles', 'user_id', 'role_id')
                    ->withTimestamps()
                    // Thêm các trường chung của bảng pivot nếu bạn cần truy cập
                    ->withPivot('status', 'created_user_id', 'updated_user_id');
    }

    /*
     * 4. GHI CHÚ:
     * Hai hàm 'userRoles()' và 'hasPermission()' của bạn không cần thiết
     * và không phù hợp với logic 6 bảng mà chúng ta đã thiết kế.
     *
     * - 'userRoles()': Bị thừa vì đã có 'roles()' mạnh hơn.
     * - 'hasPermission()': Logic kiểm tra quyền sẽ nằm trong
     * Controller (hàm computePermissions) và Middleware (screen.can).
     * Xóa bỏ 2 hàm đó sẽ giúp code sạch hơn.
     */

    // --- CÁC SCOPE (Đã đúng) ---

    public function scopeByFaculty($query, $facultyId)
    {
        return $query->where('user_faculty_id', $facultyId);
    }

    public function scopeByClass($query, $classId)
    {
        return $query->where('user_class_id', $classId);
    }
}