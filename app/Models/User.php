<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $primaryKey = 'user_id';

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
        'user_status',
        'user_username',
        'user_password',
        'user_email_verified_at',
        'user_last_login_at',
        'user_is_active',
        'user_social_id',
        'user_emergency_contact_name',
        'user_emergency_contact_phone',
        'user_note',
        'status',
        'sequence',
        'version',
        'created_user_id',
        'updated_user_id',
    ];

    protected $hidden = [
        'user_password',
        'user_remember_token',
    ];

    protected $casts = [
        'user_email_verified_at' => 'datetime',
        'user_last_login_at' => 'datetime',
        'user_date_of_birth' => 'date',
        'user_is_active' => 'boolean',
        'user_password' => 'hashed',
    ];

    public function faculty()
    {
        return $this->belongsTo(Faculty::class, 'user_faculty_id', 'faculty_id');
    }

    public function class()
    {
        return $this->belongsTo(ClassModel::class, 'user_class_id', 'class_id');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_roles', 'user_id', 'role_id')->withTimestamps();
    }
}
