<?php

use App\Http\Controllers\QRController;
use Illuminate\Support\Facades\Route;
//use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\ScanQRController;
//use App\Http\Controllers\ScanQRController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
Route::get('/admin/dashboard', function () {
    //
})->middleware('role:admin');

// Hiển thị form đăng nhập
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login')->middleware('guest');

// Xử lý thông tin đăng nhập
Route::post('/login', [AuthController::class, 'login']);

// Đăng xuất
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [RegisteredUserController::class, 'create'])->name('register')->middleware('guest');

// Xử lý thông tin đăng ký
Route::post('/register', [RegisteredUserController::class, 'register']);

// Đăng xuất (Giữ nguyên)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
     ->middleware('guest')
     ->name('password.request');

// Xử lý yêu cầu đặt lại mật khẩu
Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
     ->middleware('guest')
     ->name('password.email');

// Route cho admin dashboard
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        // Logic cho trang dashboard của admin
    });
});
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user/dashboard', function () {
        // Logic cho trang dashboard của 
    });
});
// Thay thế 'yourMethod' bằng tên phương thức thực tế bạn sử dụng
Route::post('/scan-qr', [ScanQRController::class, 'processQRScan'])->name('scan-qr.process');
// Trong file routes/web.php
Route::get('/admin/events/scan-qr', [ScanQRController::class, 'processQRScan'])->name('admin.events.scanQR');

// Trong file routes/web.php
Route::get('/scan-qr', function () {
    // Lấy event ID từ request hoặc bất kỳ cách nào phù hợp với ứng dụng của bạn
    $eventId = request('event_id');
    return view('scanQR', ['eventId' => $eventId]);
})->name('scan-qr.page');


// Giả sử bạn đã có middleware 'admin' để kiểm tra người dùng có phải là admin không
use App\Http\Controllers\AdminController;
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        

        return view('admin.dashboard');
    })->name('admin.dashboard');



    Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    
        // Quản lý người dùng
        Route::get('/users', [UserController::class, 'index'])->name('admin.user.index');
        Route::get('/users/create', [UserController::class, 'create'])->name('admin.users.create');
        Route::post('/users', [UserController::class, 'store'])->name('admin.users.store');
       
        Route::delete('/users/{users}', [UserController::class, 'destroy'])->name('admin.users.destroy');
        
        Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
        Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
        Route::put('/user/{user}', [UserController::class, 'update'])->name('admin.user.update');
        Route::get('/user/create', [UserController::class, 'create'])->name('admin.user.create');
        Route::post('/user/store', [UserController::class, 'store'])->name('admin.user.store');
        Route::get('/user', [UserController::class, 'index'])->name('admin.user.index');


        // Quản lý sự kiện
        Route::get('/events/create', [EventController::class, 'create'])->name('admin.events.create');
        Route::post('/events', [EventController::class, 'store'])->name('admin.events.store');
        

        //Route::get('/event', [EventController::class, 'index'])->name('admin.events.index');
        Route::get('/events', [EventController::class, 'index'])->name('admin.event.index');

        Route::get('/events/{event}/edit', [EventController::class, 'edit'])->name('admin.events.edit');
        Route::delete('/event/{event}', [EventController::class, 'destroy'])->name('admin.events.destroy');
        // Hiển thị form sửa sự kiện
        //Route::get('/events/{event}/edit', 'Admin\EventController@edit')->name('admin.events.edit');

        // Cập nhật thông tin sự kiện
        Route::put('/events/{event}', [EventController::class, 'update'])->name('admin.events.update');

        //Route::post('/scan-qr', [ScanQRController::class, 'scan'])->name('scan.qr');
        //Route::post('/admin/events/scanQR', [AttendanceController::class, 'store']);
        //Route::get('/admin/events/scanQR', [AttendanceController::class, 'store'])->name('admin.events.scanQR');

        

// Thay thế 'yourMethod' bằng tên phương thức thực tế bạn sử dụng



    });
    
});
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user/dashboard', function () {
        // Đảm bảo bạn có view 'user.dashboard' được tạo ra và không gặp lỗi nào
        
      
    
        return view('user.dashboard');
    });
    
});
//use App\Http\Controllers\UserController;

Route::middleware(['auth'])->group(function () {
    Route::get('/user/usershowQR', [UserController::class, 'usershowQR'])->name('user.usershowQR');
});

Route::prefix('user')->middleware(['auth', 'user'])->group(function () {
    Route::middleware(['auth', 'role:user'])->group(function () {
        Route::get('/user/index', function () {
            // Logic cho trang dashboard của admin
            //Route::get('/profile', [UserController::class, 'profile'])->middleware('auth')->name('profile');
        });
    });
    
    //Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    //Route::get('/generate-qr', [UserController::class, 'generateQRCode'])->name('generate.qr')->middleware('auth');
    // Route::get('/index', [QRController::class, 'index'])->name('user.index')->middleware('auth');
    // Route::get('/index', [QRController::class, 'showQR']);

    // Route::middleware(['auth'])->group(function () {
    //     Route::get('/user/index', [UserController::class, 'indexshow'])->name('user.index');
    // });
    // Các route và logic chỉ dành cho người dùng có vai trò là 'user' ở đây
});

// web.php
Route::post('/admin/events/scanQR/{event_id}', [EventController::class, 'scanQR'])->name('admin.events.scanQR.post');

// web.php
//Route::post('/admin/events/processQR', [EventController::class, 'processQR'])->name('admin.events.processQR');
// Route::post('/admin/events/scanQR/{event_id}', [EventController::class, 'processQR'])->name('admin.events.processQR');
// Route::post('/admin/events/scan-qr', [EventController::class, 'processQR'])->name('admin.events.processQR');
//use App\Http\Controllers\Admin\ScanQRController;



// Route definitions


// Route::get('/admin/events/scan-qr', [ScanQRController::class, 'showScanPage'])->name('admin.events.scanQR');

// Route::post('/admin/events/scan-qr', [ScanQRController::class, 'processQR'])->name('admin.events.processQR');
//---------------------------
// Định nghĩa route cho trang hiển thị form quét QR
// Route::get('/admin/events/{event_id}/scan-qr', [App\Http\Controllers\ScanQRController::class, 'showScanQRPage'])->name('admin.events.scanQR');

// // Định nghĩa route cho xử lý kết quả quét QR
// Route::post('/admin/events/process-qr', [App\Http\Controllers\ScanQRController::class, 'processQRScan'])->name('admin.events.processQR');

// // Định nghĩa route cho checkUser, nếu cần
// Route::post('/admin/events/check-user', [App\Http\Controllers\ScanQRController::class, 'checkUser'])->name('admin.events.checkUser');


//---------------------------------------
// Hiển thị trang quét QR cho sự kiện cụ thể
Route::get('/admin/events/{event_id}/scan-qr', [App\Http\Controllers\ScanQRController::class, 'showScanQRPage'])->name('admin.events.scanQR');

// Xử lý dữ liệu quét QR được gửi lên từ form, bây giờ xử lý một danh sách các người dùng quét
Route::post('/admin/events/process-qr', [App\Http\Controllers\ScanQRController::class, 'processQRScan'])->name('admin.events.processQR');

// Kiểm tra thông tin người dùng dựa trên dữ liệu quét, có thể không cần thiết nếu logic kiểm tra được thực hiện trực tiếp trong processQRScan
Route::post('/admin/events/check-user', [App\Http\Controllers\ScanQRController::class, 'checkUser'])->name('admin.events.checkUser');

//ds điểm danh
// Thêm route này vào web.php
//Route::get('/admin/events/{event_id}/attendances', [App\Http\Controllers\Admin\EventController::class, 'showAttendances'])->name('admin.events.arrayUsQr');
Route::get('/admin/events/{event_id}/attendances', [App\Http\Controllers\Admin\EventController::class, 'showAttendances'])->name('admin.events.attendances');

// Route::middleware(['user'])->group(function () {
//     // Các route chỉ dành cho người dùng có vai trò là 'user' ở đây
//     Route::get('/user/dashboard', function () {
//         // Logic cho trang dashboard của user
        

// //Route::get('/generate-qr', [QRController::class, 'generateQR'])->name('generate.qr');
// Route::get('/dashboard', [UserController::class, 'dashboard'])->middleware('auth');

//     });
// });
// Route::middleware(['auth'])->group(function () {
//     // Nhóm route cho người dùng có role là `user`
//     Route::middleware(['checkRole:user'])->group(function () {
//         Route::get('/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
        
//         // Địa điểm để người dùng xem và tạo QR code
//         //Route::get('/qr-code', [UserController::class, 'generateQRCode'])->name('user.qr-code');
        
//         // Các route khác phù hợp với người dùng có role là `user`
//         // ...
//     });
// });