<?php

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;

// class AdminController extends Controller
// {
//     public function dashboard()
//     {
//         $header = 'Tiêu đề của bạn'; // Định nghĩa biến
//         return view('admin.dashboard', compact('header'));
//     }
// }
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    // Phương thức của controller ở đây
    public function dashboard()
{
    $header = 'trang Admin';
    return view('admin.dashboard');
}

}

