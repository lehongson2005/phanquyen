<?php
// app/Models/Screen.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class Screen extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'screen_id';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $table = 'screens';

    protected $fillable = [
        'screen_name',
        'screen_code',
        'screen_description',
        'status',
        'sequence',
        'version',
        'created_user_id',
        'updated_user_id'
    ];

    // ==============================
    // 🔹 QUAN HỆ
    // ==============================

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'permission_screens', 'screen_id', 'permission_id')
                    ->withTimestamps()
                    ->withPivot(
                        'is_view', 'is_add', 'is_edit', 'is_delete', 'is_scan', 'is_all',
                        'status', 'sequence', 'version', 'created_user_id', 'updated_user_id', 'deleted_at'
                    );
    }

    // ==============================
    // 🔹 VALIDATION RULES
    // ==============================

    /**
     * Quy tắc kiểm tra dữ liệu khi thêm/sửa
     */
    public static function getValidationRules($screenId = null): array
    {
        $uniqueRule = $screenId
            ? Rule::unique('screens', 'screen_code')->ignore($screenId, 'screen_id')
            : 'unique:screens,screen_code';

        return [
            'screen_name'        => ['required', 'string', 'max:100'],
            'screen_code'        => ['required', 'string', 'max:50', $uniqueRule],
            'screen_description' => ['nullable', 'string', 'max:255'],
            'status'             => ['required', 'integer', 'in:0,1'],
            'sequence'           => ['nullable', 'integer', 'min:0'],
            'version'            => ['nullable', 'integer', 'min:1'],
        ];
    }

    // ==============================
    // 🔹 LOGIC THÊM / SỬA / XÓA
    // ==============================

    /**
     * Tạo mới một màn hình
     */
    public static function createScreen(array $data): self
    {
        $data['created_user_id'] = Auth::id();
        $data['version'] = $data['version'] ?? 1;
        return self::create($data);
    }

    /**
     * Cập nhật màn hình
     */
    public function updateScreen(array $data): bool
    {
        $data['updated_user_id'] = Auth::id();
        $data['version'] = ($this->version ?? 1) + 1;
        return $this->update($data);
    }

    /**
     * Xóa mềm (soft delete)
     */
    public function deleteScreen(): bool
    {
        return $this->delete();
    }

    // ==============================
    // 🔹 SEARCH
    // ==============================

    public function scopeSearch($query, $term)
    {
        if ($term) {
            return $query->where(function ($q) use ($term) {
                $q->where('screen_name', 'like', "%$term%")
                  ->orWhere('screen_code', 'like', "%$term%");
            });
        }
        return $query;
    }
}
