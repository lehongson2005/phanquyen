<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('classes', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            
            // KHÓA CHÍNH - Sửa thành id()
            $table->id('class_id'); // ✅ ĐÚNG
            
            $table->string('class_code', 50)->unique();
            $table->string('class_name', 100);
            $table->string('class_description', 255)->nullable();
            
            // KHÓA NGOẠI - Sửa thành foreignId()
            $table->foreignId('class_faculty_id') // ✅ ĐÚNG
                  ->nullable()
                  ->constrained('faculties', 'faculty_id')
                  ->onDelete('set null');
            
            $table->string('class_major', 100)->nullable();
            $table->year('class_course_year');
            $table->integer('class_total_students')->default(0);
            $table->integer('class_max_students')->default(50);
            $table->string('class_teacher_in_charge', 100)->nullable();
            $table->string('class_monitor', 100)->nullable();
            $table->string('class_vice_monitor', 100)->nullable();
            $table->text('class_note')->nullable();
            $table->tinyInteger('class_status')->default(1);
            $table->integer('class_sequence')->default(0);
            $table->integer('class_version')->default(1);
            $table->bigInteger('class_created_user_id')->nullable();
            $table->bigInteger('class_updated_user_id')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('classes');
    }
};