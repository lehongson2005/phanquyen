<?php
// app/Models/UserRole.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserRole extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'user_roles';

    protected $fillable = [
        'user_id',
        'role_id',
        'status',
        'sequence',
        'version',
        'created_user_id',
        'updated_user_id'
    ];

    // Quan hệ với User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Quan hệ với Role
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }
}