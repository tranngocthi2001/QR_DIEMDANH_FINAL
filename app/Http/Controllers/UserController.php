<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
    public function showQRPage()
{
    $user = auth()->user(); // Lấy thông tin người dùng đang đăng nhập
    return view('user.dashboard', compact('user'));
}
public function showDashboard()
{
    $user = Auth::user(); // Lấy thông tin người dùng đã đăng nhập
    //return view('user.dashboard', compact('user')); // Truyền biến $user tới view
    return view('user.dashboard', ['user' => $user]);

}
public function usershowQR() {
    // Logic để lấy dữ liệu và hiển thị QR, ví dụ lấy thông tin người dùng đang đăng nhập
    $user = auth()->user();

    // Trả về view với dữ liệu người dùng, đảm bảo bạn có file view tương ứng
    return view('user.userShowQR', compact('user'));
}
// public function usershowQR() {
//     // Logic để hiển thị mã QR code
//     return view('user.userShowQR'); // Trả về view để hiển thị mã QR code
// }

}
