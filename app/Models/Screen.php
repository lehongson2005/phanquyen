<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Screen extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'screen_name',
        'screen_code',
        'screen_description',
        'status',
        'sequence',
        'version',
        'created_user_id',
        'updated_user_id',
    ];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'permission_screens')->withPivot(
            'is_view', 'is_add', 'is_edit', 'is_delete', 'is_scan', 'is_all'
        )->withTimestamps();
    }
}
