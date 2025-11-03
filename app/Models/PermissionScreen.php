<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class PermissionScreen extends Pivot
{
    protected $table = 'permission_screens';
}