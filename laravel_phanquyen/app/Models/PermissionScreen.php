<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class PermissionScreen extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'permission_screens';
    protected $primaryKey = 'id';
    public $incrementing = true;

    protected $fillable = [
        'permission_id',
        'screen_id',
        'is_view',
        'is_add',
        'is_edit',
        'is_delete',
        'is_scan',
        'is_all',
        'status',
        'sequence',
        'version',
        'created_user_id',
        'updated_user_id'
    ];

    public function permission()
    {
        return $this->belongsTo(Permission::class, 'permission_id');
    }

    public function screen()
    {
        return $this->belongsTo(Screen::class, 'screen_id');
    }

    // --- LOGIC CRUD ---
    public static function createPermissionScreen(array $data): self
    {
        $data['created_user_id'] = Auth::id();
        $data['version'] = $data['version'] ?? 1;
        return self::create($data);
    }

    public function updatePermissionScreen(array $data): bool
    {
        $data['updated_user_id'] = Auth::id();
        $data['version'] = ($this->version ?? 1) + 1;
        return $this->update($data);
    }

    public function deletePermissionScreen(): bool
    {
        return $this->delete();
    }
}
