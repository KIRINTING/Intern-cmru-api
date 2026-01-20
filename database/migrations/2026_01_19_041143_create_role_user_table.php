<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('role_user', function (Blueprint $table) {
            $table->id();
            
            // เชื่อมกับตาราง users
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // เชื่อมกับตาราง roles
            $table->foreignId('role_id')->constrained()->onDelete('cascade');
            
            $table->timestamps();

            // ป้องกันการระบุ Role ซ้ำให้ User คนเดิม
            $table->unique(['user_id', 'role_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('role_user');
    }
};