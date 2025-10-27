<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_role_permissions_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('role_permissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('role_id')->constrained()->onDelete('cascade');
            $table->foreignId('permission_id')->constrained()->onDelete('cascade');
            $table->tinyInteger('status')->default(0);
            $table->integer('sequence')->default(0);
            $table->integer('version')->default(1);
            $table->bigInteger('created_user_id')->nullable();
            $table->bigInteger('updated_user_id')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->unique(['role_id', 'permission_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('role_permissions');
    }
};