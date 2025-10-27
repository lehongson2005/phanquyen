<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('user_roles', function (Blueprint $table) {
            $table->engine = 'InnoDB'; // Chuẩn hóa engine

            // Cột dữ liệu
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('role_id');

            // Các cột quản lý hệ thống
            $table->tinyInteger('status')->default(0);
            $table->integer('sequence')->default(0);
            $table->integer('version')->default(1);
            $table->bigInteger('created_user_id')->nullable();
            $table->bigInteger('updated_user_id')->nullable();
            $table->softDeletes();
            $table->timestamps();

            // Tránh duplicate user-role
            $table->unique(['user_id', 'role_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_roles');
    }
};
