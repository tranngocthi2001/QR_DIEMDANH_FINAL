<?php

namespace App\Http\Controllers;
use App\Models\Event;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Attendance;
use Illuminate\Support\Facades\DB;

class ScanQRController extends Controller
{
    public function processQRScan(Request $request)
    {
        // Giả định rằng dữ liệu QR chứa 'name' và 'email', và bạn đã gửi 'event_id' cùng với request
        $name = $request->input('name');
        $email = $request->input('email');
        $eventId = $request->input('event_id');

        // Tìm người dùng trong database
        $user = User::where('name', $name)->where('email', $email)->first();

        if (!$user) {
            return response()->json(['error' => 'Người dùng không tồn tại.'], 404);
        }

        // Kiểm tra xem người dùng đã được điểm danh cho sự kiện này chưa
        $attendanceExists = Attendance::where('user_id', $user->id)->where('event_id', $eventId)->exists();

        if ($attendanceExists) {
            return response()->json(['error' => 'Người dùng này đã được điểm danh cho sự kiện.'], 409);
        }

        // Lưu vào bảng attendance
        $attendance = new Attendance();
        $attendance->user_id = $user->id;
        $attendance->event_id = $eventId;
        $attendance->save();

        return response()->json(['success' => 'Điểm danh thành công.']);
    }
    public function checkUser(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);

        $user = User::where('email', $data['email'])->first();

        if ($user) {
            return response()->json(['user_id' => $user->id]);
        } else {
            return response()->json(['message' => 'User not found'], 404);
        }
    }
public function processQR(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'event_id' => 'required|exists:events,id',
        ]);
        // Lấy thông tin từ request
        $name = $request->input('name');
        $email = $request->input('email');
        $event_id = $request->input('event_id');

        // Kiểm tra người dùng
        $user = User::where('email', $email)->first();

        if (!$user) {
            // Xử lý trường hợp không tìm thấy người dùng
            return response()->json(['error' => 'Người dùng không tồn tại'], 404);
        }

        // Kiểm tra sự kiện
        $event = Event::find($event_id);
        if (!$event) {
            // Xử lý trường hợp không tìm thấy sự kiện
            return response()->json(['error' => 'Sự kiện không tồn tại'], 404);
        }

        // Kiểm tra xem người dùng đã tham gia sự kiện này chưa
        $attendanceCheck = Attendance::where('user_id', $user->id)->where('event_id', $event_id)->first();
        if ($attendanceCheck) {
            // Người dùng đã tham gia sự kiện này
            return response()->json(['message' => 'Người dùng đã tham gia sự kiện này'], 422);
        }

        // Lưu sự kiện tham dự
        $attendance = new Attendance();
        $attendance->user_id = $user->id;
        $attendance->event_id = $event_id;
        $attendance->save();

        // Trả về response thành công
        return back()->with('success', 'Điểm danh thành công!');
    
    }
}
