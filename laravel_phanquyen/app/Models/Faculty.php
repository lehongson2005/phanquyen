<?php
// app/Models/Faculty.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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

    // Quan hệ một-nhiều với Class
    public function classes()
    {
        return $this->hasMany(ClassModel::class, 'class_faculty_id', 'faculty_id');
    }

    // Quan hệ một-nhiều với User
    public function users()
    {
        return $this->hasMany(User::class, 'user_faculty_id', 'faculty_id');
    }
}