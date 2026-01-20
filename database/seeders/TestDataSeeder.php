<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Student;

class TestDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Admin User
        $admin = User::create([
            'name' => 'Admin User',
            'username' => 'admin',
            'email' => 'admin@cmru.ac.th',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Create Student User 1
        $studentUser1 = User::create([
            'name' => 'Somchai Jaidee',
            'username' => 'student1',
            'email' => 'student1@cmru.ac.th',
            'password' => Hash::make('password'),
            'role' => 'student',
        ]);

        // Create Student Profile 1
        Student::create([
            'user_id' => $studentUser1->id,
            'student_id' => '6501234567',
            'title' => 'นาย',
            'first_name' => 'สมชาย',
            'last_name' => 'ใจดี',
            'phone' => '081-234-5678',
            'section' => '1',
            'registration_status' => 'ลงทะเบียนแล้ว',
            'company_name' => 'บริษัท เทคโนโลยี จำกัด',
            'job_position' => 'Web Developer',
            'job_description' => 'พัฒนาเว็บไซต์และระบบ',
            'company_address' => '123 ถนนเทคโนโลยี กรุงเทพฯ 10100',
            'company_phone' => '02-123-4567',
            'coordinator_name' => 'คุณสมหญิง',
            'coordinator_position' => 'ผู้จัดการฝ่ายทรัพยากรบุคคล',
            'coordinator_phone' => '02-123-4568',
            'authorized_person_name' => 'คุณสมศักดิ์',
            'authorized_person_position' => 'กรรมการผู้จัดการ',
            'total_hours' => 320,
            'absent_days' => 0,
            'late_days' => 1,
            'leave_days' => 2,
        ]);

        // Create Student User 2
        $studentUser2 = User::create([
            'name' => 'Suda Sriwan',
            'username' => 'student2',
            'email' => 'student2@cmru.ac.th',
            'password' => Hash::make('password'),
            'role' => 'student',
        ]);

        // Create Student Profile 2
        Student::create([
            'user_id' => $studentUser2->id,
            'student_id' => '6501234568',
            'title' => 'นางสาว',
            'first_name' => 'สุดา',
            'last_name' => 'ศรีวรรณ',
            'phone' => '081-345-6789',
            'section' => '2',
            'registration_status' => 'รอการอนุมัติ',
            'company_name' => null,
            'job_position' => null,
            'total_hours' => 0,
            'absent_days' => 0,
            'late_days' => 0,
            'leave_days' => 0,
        ]);

        // Create Student User 3
        $studentUser3 = User::create([
            'name' => 'Preecha Maneerat',
            'username' => 'student3',
            'email' => 'student3@cmru.ac.th',
            'password' => Hash::make('password'),
            'role' => 'student',
        ]);

        // Create Student Profile 3
        Student::create([
            'user_id' => $studentUser3->id,
            'student_id' => '6501234569',
            'title' => 'นาย',
            'first_name' => 'ปรีชา',
            'last_name' => 'มณีรัตน์',
            'phone' => '081-456-7890',
            'section' => '1',
            'registration_status' => 'ลงทะเบียนแล้ว',
            'company_name' => 'บริษัท ซอฟต์แวร์ จำกัด',
            'job_position' => 'Mobile Developer',
            'job_description' => 'พัฒนาแอพพลิเคชั่นมือถือ',
            'company_address' => '456 ถนนนวัตกรรม เชียงใหม่ 50000',
            'company_phone' => '053-123-456',
            'coordinator_name' => 'คุณมาลี',
            'coordinator_position' => 'หัวหน้าฝ่ายพัฒนา',
            'coordinator_phone' => '053-123-457',
            'authorized_person_name' => 'คุณวิชัย',
            'authorized_person_position' => 'ผู้อำนวยการ',
            'total_hours' => 280,
            'absent_days' => 1,
            'late_days' => 0,
            'leave_days' => 1,
        ]);

        echo "Test data created successfully!\n";
        echo "Admin - username: admin, password: password\n";
        echo "Student 1 - username: student1, password: password\n";
        echo "Student 2 - username: student2, password: password\n";
        echo "Student 3 - username: student3, password: password\n";
    }
}
