<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');
        
        // กำหนด Role ที่อนุญาต
        $allowedRoles = ['admin', 'sale','account','approver'];

        $user = User::where('username', $username)->first();

        if (!$user || !Hash::check($password, $user->password)) {
            return response()->json([
                'status' => '400',
                'message' => 'Login failed: Invalid credentials',
            ], 400);
        }

        if (!in_array($user->role, $allowedRoles)) {
            return response()->json([
                'status' => '403',
                'message' => 'Access denied: You do not have permission.',
            ], 403);
        }

        return response()->json([
            'status' => '200',
            'message' => 'You token CreateComplete',
            'role' => $user->role,
            'token' => $user->createToken(Str::random(16))->plainTextToken
        ]);
    }

    public function logout(Request $request)
    {
        // ลบ Token ปัจจุบันที่ใช้อยู่
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'status' => '200',
            'message' => 'Logged out successfully'
        ]);
    }
}