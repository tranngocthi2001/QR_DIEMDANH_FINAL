<?php
use App\Http\Controllers\QRController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\ScanQRController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\AdminController;
Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');
require __DIR__.'/auth.php';
Route::get('/admin/dashboard', function () {
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
//Đăng nhâp với role là user
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user/dashboard', function () {
        return view('user.dashboard');
    });
    Route::get('/user/usershowQR', [UserController::class, 'usershowQR'])->name('user.usershowQR');
});
// Giả sử bạn đã có middleware 'admin' để kiểm tra người dùng có phải là admin không

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        return view('admin.dashboard');
    })->name('admin.dashboard');
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
        Route::get('/events', [EventController::class, 'index'])->name('admin.event.index');
        Route::get('/events/{event}/edit', [EventController::class, 'edit'])->name('admin.events.edit');
        Route::delete('/event/{event}', [EventController::class, 'destroy'])->name('admin.events.destroy');
        Route::put('/events/{event}', [EventController::class, 'update'])->name('admin.events.update');
        Route::post('/admin/events/scanQR/{event_id}', [EventController::class, 'scanQR'])->name('admin.events.scanQR.post');
        //---------------------------------------
        // Hiển thị trang quét QR cho sự kiện cụ thể
        Route::get('/admin/events/{event_id}/scan-qr', [App\Http\Controllers\ScanQRController::class, 'showScanQRPage'])->name('admin.events.scanQR');
        // Xử lý dữ liệu quét QR được gửi lên từ form, bây giờ xử lý một danh sách các người dùng quét
        Route::post('/admin/events/process-qr', [App\Http\Controllers\ScanQRController::class, 'processQRScan'])->name('admin.events.processQR');
        // Kiểm tra thông tin người dùng dựa trên dữ liệu quét, có thể không cần thiết nếu logic kiểm tra được thực hiện trực tiếp trong processQRScan
        Route::post('/admin/events/check-user', [App\Http\Controllers\ScanQRController::class, 'checkUser'])->name('admin.events.checkUser');
        //ds điểm danh
        Route::get('/admin/events/{event_id}/attendances', [App\Http\Controllers\Admin\EventController::class, 'showAttendances'])->name('admin.events.attendances');
});





