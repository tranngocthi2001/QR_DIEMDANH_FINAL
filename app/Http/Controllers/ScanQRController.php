<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Attendance;
use Illuminate\Support\Facades\DB;

class ScanQRController extends Controller
{
    public function showScanQRPage($event_id)
    {
        $event = Event::findOrFail($event_id);
        return view('admin.event.scanQR', ['event' => $event, 'eventId' => $event_id]);
    }

    public function processQRScan(Request $request)
{
    $eventId = $request->input('event_id');
    $scannedUsers = $request->input('scanned_users');

    // Kiểm tra xem sự kiện có tồn tại không
    $event = Event::find($eventId);
    if (!$event) {
        return response()->json(['error' => 'Sự kiện không tồn tại.'], 404);
    }

    // Lặp qua danh sách người dùng đã quét và thêm vào cơ sở dữ liệu
    foreach ($scannedUsers as $userData) {
        $user = User::where('email', $userData['email'])->first();
        if ($user) {
            $userId = $user->id;

            // Kiểm tra xem người dùng đã được điểm danh cho sự kiện này chưa
            $attendanceExists = Attendance::where('user_id', $userId)->where('event_id', $eventId)->exists();

            if (!$attendanceExists) {
                // Lưu vào bảng attendance
                $attendance = new Attendance();
                $attendance->user_id = $userId;
                $attendance->event_id = $eventId;
                $attendance->save();
            }
        }
    }

    return response()->json(['success' => 'Đã cập nhật danh sách điểm danh.']);
}

}
