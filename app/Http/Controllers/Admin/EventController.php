<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\User;
use App\Models\Attendance;
use Illuminate\Support\Facades\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;
class EventController extends Controller
{
    public function index()
    {
        $events = Event::all();
        return view('admin.event.index', compact('events'));
    }
    public function create()
{
    return view('admin.event.create');
}
    public function store(Request $request)
    {
        $event = new Event;
        $event->name = $request->name;
        $event->location = $request->location;
        $event->start_time = $request->start_time;
        $event->end_time = $request->end_time;
        $event->save();
    
        return redirect()->route('admin.event.index')->with('success', 'Event đã được thêm.');
    }


    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('admin.event.index')->with('success', 'Sự kiện đã được xóa thành công.');
    }
    public function edit($id)
{
    $event = Event::findOrFail($id);
    return view('admin.event.edit', compact('event'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'location' => 'required|string|max:255',
        'start_time' => 'required|date',
        'end_time' => 'required|date|after:start_time',
        // Thêm các quy tắc validation khác tùy thuộc vào cấu trúc của bảng events của bạn
    ]);

    $event = Event::findOrFail($id);
    $event->update([
        'name' => $request->name,
        'location' => $request->location,
        'start_time' => $request->start_time,
        'end_time' => $request->end_time,
        // Cập nhật các trường khác nếu có
    ]);

    return redirect()->route('admin.event.index')->with('success', 'Sự kiện đã được cập nhật thành công.');
    
}
public function scanQR($event_id)
{
    $event = Event::findOrFail($event_id);
    return view('admin.event.scanQR', compact('event'));
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
    
    public function showAttendances($event_id)
    {
        $event = Event::findOrFail($event_id);
        $attendances = Attendance::with('user')->where('event_id', $event_id)->get();

        return view('admin.event.attendances', compact('event', 'attendances'));
    }
}