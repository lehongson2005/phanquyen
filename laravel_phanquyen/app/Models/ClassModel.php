<?php
// app/Models/ClassModel.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ClassModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'class_id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $table = 'classes';

    protected $fillable = [
        'class_code',
        'class_name',
        'class_description',
        'class_faculty_id',
        'class_major',
        'class_course_year',
        'class_total_students',
        'class_max_students',
        'class_teacher_in_charge',
        'class_monitor',
        'class_vice_monitor',
        'class_note',
        'class_status',
        'class_sequence',
        'class_version',
        'class_created_user_id',
        'class_updated_user_id'
    ];

    // --- CÁC QUAN HỆ ---

    /**
     * Quan hệ nhiều-một với Faculty
     */
    public function faculty(): BelongsTo
    {
        return $this->belongsTo(Faculty::class, 'class_faculty_id', 'faculty_id');
    }

    /**
     * Quan hệ một-nhiều với User
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'user_class_id', 'class_id');
    }

    // --- CÁC HÀM LOGIC (THEO YÊU CẦU MVC) ---

    /**
     * Lấy các quy tắc validation cho Class.
     * @param int|null $classId ID của class để bỏ qua (khi update)
     * @return array
     */
    public static function getValidationRules($classId = null): array
    {
        $uniqueRule = $classId ? Rule::unique('classes')->ignore($classId, 'class_id') : 'unique:classes';

        return [
            'class_code' => ['required', 'string', 'max:50', $uniqueRule],
            'class_name' => 'required|string|max:100',
            'class_description' => 'nullable|string|max:255',
            'class_faculty_id' => 'required|exists:faculties,faculty_id', // Bắt buộc phải thuộc về 1 Khoa
            'class_major' => 'nullable|string|max:100',
            'class_course_year' => 'required|integer|digits:4',
            'class_max_students' => 'nullable|integer|min:1',
            'class_teacher_in_charge' => 'nullable|string|max:100',
            'class_status' => 'required|integer', // 1 = Active, 0 = Inactive
            'class_sequence' => 'nullable|integer',
        ];
    }

   

   
    public function scopeSearch($query, $term)
    {
        if ($term) {
            return $query->where(function($q) use ($term) {
                $q->where('class_name', 'like', '%' . $term . '%')
                  ->orWhere('class_code', 'like', '%' . $term . '%')
                  ->orWhere('class_major', 'like', '%' . $term . '%');
            });
        }
        return $query;
    }
}
