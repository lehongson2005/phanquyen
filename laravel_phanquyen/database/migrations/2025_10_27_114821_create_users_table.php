<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            // ===== Khóa chính =====
            $table->id('user_id');

            // ===== Thông tin cá nhân =====
            $table->string('user_student_code', 50)->unique();
            $table->string('user_full_name', 100);
            $table->string('user_first_name', 50)->nullable();
            $table->string('user_last_name', 50)->nullable();
            $table->enum('user_gender', ['Nam', 'Nữ'])->nullable();
            $table->date('user_date_of_birth')->nullable();
            $table->string('user_avatar')->nullable();

            // ===== Thông tin liên hệ =====
            $table->string('user_email')->unique();
            $table->string('user_phone_number', 20)->nullable();
            $table->text('user_address')->nullable();
            $table->string('user_city', 100)->nullable();
            $table->string('user_country', 100)->default('Vietnam');

            // ===== Thông tin học vụ =====
            $table->string('user_student_id_card', 50)->nullable();
            $table->unsignedBigInteger('user_faculty_id')->nullable(); // Liên kết khoa
            $table->unsignedBigInteger('user_class_id')->nullable();   // Liên kết lớp
            $table->string('user_major', 100);
            $table->year('user_course_year');
            $table->enum('user_status', ['Đang học', 'Bỏ Học', 'Tạm nghỉ'])->default('Đang học');

            // ===== Thông tin đăng nhập =====
            $table->string('user_username', 50)->unique();
            $table->string('user_password');
            $table->timestamp('user_email_verified_at')->nullable();
            $table->timestamp('user_last_login_at')->nullable();
            $table->string('user_remember_token', 100)->nullable();
            $table->boolean('user_is_active')->default(true);

            // ===== Thông tin bổ sung =====
            $table->string('user_social_id')->nullable();
            $table->string('user_emergency_contact_name')->nullable();
            $table->string('user_emergency_contact_phone', 20)->nullable();
            $table->text('user_note')->nullable();

            // ===== Trường quản lý hệ thống =====
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
        Schema::dropIfExists('users');
    }
};
