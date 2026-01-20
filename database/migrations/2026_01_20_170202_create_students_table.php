<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // ข้อมูลนักศึกษา (Student Bio)
            $table->string('student_id')->unique()->comment('รหัสนักศึกษา');
            $table->string('title')->comment('คำนำหน้าชื่อ');
            $table->string('first_name')->comment('ชื่อ');
            $table->string('last_name')->comment('นามสกุล');
            $table->string('phone')->comment('หมายเลขโทรศัพท์ที่ติดต่อได้');
            $table->string('section')->nullable()->comment('หมู่เรียน');
            $table->string('registration_status')->nullable()->comment('สถานะการลงทะเบียนเรียน');

            // ข้อมูลหน่วยงาน (Company/Internship Information)
            $table->string('company_name')->nullable()->comment('ชื่อหน่วยงาน');
            $table->string('job_position')->nullable()->comment('ตำแหน่งงานที่ให้ฝึกฯ');
            $table->text('job_description')->nullable()->comment('รายละเอียดของงาน/หน้าที่ที่ต้องปฏิบัติ');
            $table->text('company_address')->nullable()->comment('ที่อยู่ของหน่วยงาน');
            $table->string('company_phone')->nullable()->comment('หมายเลขโทรศัพท์ของหน่วยงาน');

            // ข้อมูลผู้ประสานงาน (Coordinator)
            $table->string('coordinator_name')->nullable()->comment('ชื่อ-นามสกุล ของผู้ประสานงาน');
            $table->string('coordinator_position')->nullable()->comment('ตำแหน่งงานของผู้ประสานงาน');
            $table->string('coordinator_phone')->nullable()->comment('หมายเลขโทรศัพท์ของผู้ประสานงาน');

            // ข้อมูลผู้มีอำนาจ (Authorized Person)
            $table->string('authorized_person_name')->nullable()->comment('ชื่อ-นามสกุล ของผู้มีอำนาจในการตัดสินใจ');
            $table->string('authorized_person_position')->nullable()->comment('ตำแหน่งงานของผู้มีอำนาจ');

            // ข้อมูลสถานที่ (Location)
            $table->string('google_map_coords')->nullable()->comment('พิกัด google map สถานที่ฝึกประสบการณ์');
            $table->string('photo_path')->nullable()->comment('รูปถ่ายนักศึกษากับสถานที่ฝึกประสบการณ์');

            // หลักฐานตรวจสอบเกณฑ์การออกฝึกประสบการณ์ (Criteria Evidence)
            $table->integer('major_subjects_passed')->nullable()->comment('จำนวนวิชาเอกที่สอบผ่าน');
            $table->string('pre_internship_grade')->nullable()->comment('เกรดวิชาเตรียมฝึกประสบการณ์วิชาชีพ');
            $table->string('criteria_evidence_file')->nullable()->comment('ไฟล์หลักฐานตรวจสอบเกณฑ์');

            // หลักฐานตรวจสอบชั่วโมงฝึกประสบการณ์ (Hours Evidence)
            $table->integer('absent_days')->default(0)->comment('จำนวนวันที่ขาดงาน');
            $table->integer('late_days')->default(0)->comment('จำนวนวันที่มาสาย');
            $table->integer('leave_days')->default(0)->comment('จำนวนวันที่ลากิจ ลาป่วย');
            $table->integer('total_hours')->default(0)->comment('จำนวนชั่วโมงฝึก');
            $table->string('hours_evidence_file')->nullable()->comment('ไฟล์หลักฐานตรวจสอบชั่วโมงฝึก');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
