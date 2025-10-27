<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
       Schema::create('faculties', function (Blueprint $table) {
    $table->engine = 'InnoDB';
    $table->charset = 'utf8mb4';
    $table->collation = 'utf8mb4_unicode_ci';

    $table->id('faculty_id');
    $table->string('faculty_code', 50)->unique();
    $table->string('faculty_name', 100);
    $table->string('faculty_description', 255)->nullable();
    $table->string('faculty_dean', 100)->nullable();
    $table->string('faculty_email', 100)->nullable();
    $table->string('faculty_phone', 20)->nullable();
    $table->text('faculty_address')->nullable();
    $table->integer('faculty_total_students')->default(0);
    $table->integer('faculty_total_teachers')->default(0);
    $table->date('faculty_established_date')->nullable();
    $table->tinyInteger('faculty_status')->default(1);
    $table->integer('faculty_sequence')->default(0);
    $table->integer('faculty_version')->default(1);
    $table->bigInteger('faculty_created_user_id')->nullable();
    $table->bigInteger('faculty_updated_user_id')->nullable();
    $table->softDeletes();
    $table->timestamps();
});

    
    }

    public function down()
    {
        Schema::dropIfExists('faculties');
    }
};