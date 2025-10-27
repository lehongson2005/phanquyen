<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_screens_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('screens', function (Blueprint $table) {
            $table->id();
            $table->string('screen_name', 100);
            $table->string('screen_code', 100)->unique();
            $table->string('screen_description', 255)->nullable();
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
        Schema::dropIfExists('screens');
    }
};