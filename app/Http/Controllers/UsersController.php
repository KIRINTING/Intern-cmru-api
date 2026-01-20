<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // เรียกใช้ Model User (ปกติ Laravel มีให้อยู่แล้ว)
use Illuminate\Support\Facades\Hash; // สำคัญ! สำหรับเข้ารหัส Password
use Illuminate\Validation\Rule;

class UsersController extends Controller
{
    // GET: api/users
    public function index(Request $request)
    {
        $query = User::query();

        // ระบบค้นหา (Search)
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('username', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%");
            });
        }

        // เรียงลำดับเอาคนล่าสุดขึ้นก่อน
        $users = $query->orderBy('created_at', 'desc')->get();

        return response()->json($users);
    }

    // POST: api/users
    public function store(Request $request)
    {
        // 1. ตรวจสอบข้อมูล (Validation)
        $validatedData = $request->validate([
            'name'      => 'required|string|max:255',
            'username'  => 'required|string|max:255|unique:users',
            'email'     => 'required|email|unique:users',
            'password'  => 'required|string|min:6', // บังคับใส่รหัสผ่านตอนสร้าง
            'role'      => 'required|string'
        ]);

        // 2. เข้ารหัส Password ก่อนบันทึก
        $validatedData['password'] = Hash::make($request->password);

        // 3. บันทึก
        $user = User::create($validatedData);

        return response()->json([
            'message' => 'User created successfully',
            'data' => $user
        ], 201);
    }

    // GET: api/users/{id}
    public function show($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return response()->json($user);
    }

    // PUT: api/users/{id}
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // 1. Validate (ต้องระวังเรื่อง Unique ไม่ให้ชนกับตัวเอง)
        $validatedData = $request->validate([
            'name'      => 'required|string|max:255',
            'username'  => 'required|string|max:255|unique:users,username,'.$id,
            'email'     => 'required|email|unique:users,email,'.$id,
            'role'      => 'required|string',
            'password'  => 'nullable|string|min:6' // รหัสผ่านเป็น Optional (ไม่กรอก=ไม่เปลี่ยน)
        ]);

        // 2. อัปเดตข้อมูลทั่วไป
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->role = $request->role;

        // 3. ตรวจสอบว่ามีการส่งรหัสผ่านใหม่มาหรือไม่
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return response()->json([
            'message' => 'User updated successfully',
            'data' => $user
        ]);
    }

    // DELETE: api/users/{id}
    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->delete();

        return response()->json(['message' => 'User deleted successfully']);
    }
}