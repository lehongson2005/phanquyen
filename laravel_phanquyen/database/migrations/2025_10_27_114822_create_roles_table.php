<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_roles_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('role_name', 50);
            $table->string('role_code', 50)->unique();
            $table->string('role_description', 255)->nullable();
            $table->tinyInteger('status')->default(0);
            $table->integer('sequence')->default(0);
            $table->integer('version')->default(1);
            $table->bigInteger('created_user_id')->nullable();
            $table->bigInteger('updated_user_id')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('roles');
    }
};