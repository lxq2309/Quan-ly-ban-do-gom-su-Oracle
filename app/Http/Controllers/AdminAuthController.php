<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\admin\Employee;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login'); // Tạo view đăng nhập cho admin
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');
        $remember = $request->has('remember');
        $admin = Employee::where('USERNAME', $credentials['username'])->first();

        if ($admin && Hash::check($credentials['password'], $admin->password)) {
            Auth::guard('admin')->login($admin, $remember);

            // Lưu thông tin người dùng vào session
            session(['admin_id' => $admin->username, 'admin_name' => $admin->employeename]);
            return redirect()->intended('/');
        }

        return back()->withErrors(['User' => 'Sai thông tin tài khoản hoặc mật khẩu!']);
    }

    public function logout()
    {
        // Xóa thông tin người dùng khỏi session
        session()->forget(['admin_id', 'admin_name']);
        Auth::guard('admin')->logout();
        return redirect('/login');
    }
}
