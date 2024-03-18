<?php

use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class AttendanceController extends Controller
{
    public function store(Request $request)
    {
        // Giả sử bạn nhận ID của người dùng và sự kiện từ mã QR qua request
        $userId = $request->user_id;
        $eventId = $request->event_id;

        // Lưu thông tin vào bảng attendance
        $attendance = new Attendance();
        $attendance->user_id = $userId;
        $attendance->event_id = $eventId;
        $attendance->save();

        // Trả về phản hồi
        return response()->json(['message' => 'Attendance recorded successfully']);
    }
}
