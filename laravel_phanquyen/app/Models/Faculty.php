<?php
// app/Models/Faculty.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class Faculty extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'faculty_id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'faculty_code',
        'faculty_name',
        'faculty_description',
        'faculty_dean',
        'faculty_email',
        'faculty_phone',
        'faculty_address',
        'faculty_total_students',
        'faculty_total_teachers',
        'faculty_established_date',
        'faculty_status',
        'faculty_sequence',
        'faculty_version',
        'faculty_created_user_id',
        'faculty_updated_user_id'
    ];

    protected $casts = [
        'faculty_established_date' => 'date',
    ];

    // --- CÁC QUAN HỆ ---

    /**
     * Quan hệ một-nhiều với Class
     */
    public function classes(): HasMany
    {
        return $this->hasMany(ClassModel::class, 'class_faculty_id', 'faculty_id');
    }

    /**
     * Quan hệ một-nhiều với User
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'user_faculty_id', 'faculty_id');
    }

    // --- CÁC HÀM LOGIC (THEO YÊU CẦU MVC) ---

    /**
     * Lấy các quy tắc validation cho Faculty.
     * @param int|null $facultyId ID của faculty để bỏ qua (khi update)
     * @return array
     */
    public static function getValidationRules($facultyId = null): array
    {
        $uniqueRule = $facultyId ? Rule::unique('faculties')->ignore($facultyId, 'faculty_id') : 'unique:faculties';

        return [
            'faculty_code' => ['required', 'string', 'max:50', $uniqueRule],
            'faculty_name' => 'required|string|max:100',
            'faculty_description' => 'nullable|string|max:255',
            'faculty_dean' => 'nullable|string|max:100',
            'faculty_email' => 'nullable|email|max:100',
            'faculty_phone' => 'nullable|string|max:20',
            'faculty_address' => 'nullable|string',
            'faculty_established_date' => 'nullable|date',
            'faculty_status' => 'required|integer', // 1 = Active, 0 = Inactive
            'faculty_sequence' => 'nullable|integer',
        ];
    }

    

    /**
     * (Logic) Thêm scope tìm kiếm.
     */
    public function scopeSearch($query, $term)
    {
        if ($term) {
            return $query->where(function($q) use ($term) {
                $q->where('faculty_name', 'like', '%' . $term . '%')
                  ->orWhere('faculty_code', 'like', '%' . $term . '%')
                  ->orWhere('faculty_dean', 'like', '%' . $term . '%');
            });
        }
        return $query;
    }
}
