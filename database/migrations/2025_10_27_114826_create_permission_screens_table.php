<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_permission_screens_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('permission_screens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('permission_id')->constrained()->onDelete('cascade');
            $table->foreignId('screen_id')->constrained()->onDelete('cascade');
            $table->boolean('is_view')->default(false);
            $table->boolean('is_add')->default(false);
            $table->boolean('is_edit')->default(false);
            $table->boolean('is_delete')->default(false);
            $table->boolean('is_scan')->default(false);
            $table->boolean('is_all')->default(false);
            $table->tinyInteger('status')->default(0);
            $table->integer('sequence')->default(0);
            $table->integer('version')->default(1);
            $table->bigInteger('created_user_id')->nullable();
            $table->bigInteger('updated_user_id')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->unique(['permission_id', 'screen_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('permission_screens');
    }
};