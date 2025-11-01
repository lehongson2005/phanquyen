<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClassModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'classes';
    protected $primaryKey = 'class_id';

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
        'class_updated_user_id',
    ];

    public function faculty()
    {
        return $this->belongsTo(Faculty::class, 'class_faculty_id', 'faculty_id');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'user_class_id', 'class_id');
    }
}
