<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
    // Hiển thị danh sách người dùng
    public function index()
    {
        $users = User::all();
        return view('admin.user.index', compact('users'));
    }
    public function indexshow()
    {
        $user = Auth::user();
        return view('user.index', compact('user'));
    }
    // Hiển thị form tạo người dùng mới
    public function create()
{
    return view('admin.user.create');
}

public function store(Request $request)
{
    // Validate input
    $validated = $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6',
        'role' => 'required', // Thêm role vào validation rules nếu cần
    ]);

    // Create new user
    $user = User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => Hash::make($validated['password']), // Hash mật khẩu
        'role' => $validated['role'], // Cập nhật role từ form
    ]);

    // Redirect back with success message
    return back()->with('success', 'Tài khoản đã được tạo thành công!');
}


    // Hiển thị form chỉnh sửa người dùng
    public function edit(User $user)
    {
        return view('admin.user.edit', compact('user'));
    }

    // Cập nhật người dùng
    public function update(Request $request, User $user)
{
    $validated = $request->validate([
        'name' => 'required|max:255',
        'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        'password' => 'nullable|min:6',
        'role' => 'required',
    ]);

    // Cập nhật thông tin người dùng
    $user->name = $validated['name'];
    $user->email = $validated['email'];
    $user->role = $validated['role'];

    // Nếu mật khẩu được cung cấp, cập nhật mật khẩu
    if (!empty($validated['password'])) {
        $user->password = Hash::make($validated['password']);
    }

    $user->save();

    return redirect()->route('admin.users.index')->with('success', 'Người dùng đã được cập nhật.');
}


    // Xóa người dùng
    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('success', 'Người dùng đã được xóa.');
    }
    public function generateQRCode()
    {
        // Lấy thông tin người dùng đang đăng nhập từ cơ sở dữ liệu
        $user = auth()->user();

        // Truyền thông tin người dùng vào view
        return view('generate_qr', compact('user'));
    }
    public function usershowQR() {
        // Logic để lấy dữ liệu và hiển thị QR, ví dụ lấy thông tin người dùng đang đăng nhập
        $user = Auth::user();

        // Chuyển thông tin người dùng thành dữ liệu cho mã QR
        $userData = [
            'name' => $user->name,
            'email' => $user->email,
            // Thêm các thông tin khác nếu cần
        ];
    
        // Chuyển dữ liệu thành chuỗi JSON để sử dụng trong mã QR
        $qrData = json_encode($userData);
    
        return view('user.usershowQR', compact('qrData'));
    }
    
   
}
