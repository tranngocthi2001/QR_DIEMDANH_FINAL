<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class QRController extends Controller
{
    public function profile()
    {
        $user = auth()->user();
        return view('user.profile', compact('user'));
    }
    public function showQR()
    {
        // Lấy thông tin người dùng đã đăng nhập
        $user = auth()->user();

        // Truyền thông tin người dùng đến view
        return view('user.index', ['userData' => $user]);
    }
    //use App\Models\User; // Đảm bảo bạn đã import model User

    public function showUserProfile()
    {
        // Lấy thông tin của người dùng đã đăng nhập
        $user = Auth::user();
    
        // Truyền thông tin người dùng qua view
        //return view('user.index', ['user' => $user]);
        return view('user.index', ['user' => Auth::user()]);

    }
    
}
