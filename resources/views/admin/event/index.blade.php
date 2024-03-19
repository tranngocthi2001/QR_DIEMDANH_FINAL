<!-- admin/events/index.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
    <div class="col-md-6">
            <a href="{{ route('admin.users.index') }}" class="btn btn-primary">Quản lý người dùng</a>
        </div>
        <h1>Danh sách sự kiện</h1>
        <a href="{{ route('admin.events.create') }}" class="btn btn-primary">Thêm Event Mới</a>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên sự kiện</th>
                    
                    <th>Giờ bắt đầu</th>
                    <th>Giờ kết thúc</th>
                    <th>Địa điểm</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($events as $event)
                    <tr>
                        <td>{{ $event->id }}</td>
                        <td>{{ $event->name }}</td>
                        <td>{{ $event->start_time }}</td>
                        <td>{{ $event->end_time }}</td>
                        <td>{{ $event->location }}</td>
                        <td>
                            <a href="{{ route('admin.events.edit', $event) }}" class="btn btn-primary">Sửa</a>
                            <form action="{{ route('admin.events.destroy', $event) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa sự kiện này?')">Xóa</button>
                            </form>
                            <!-- Ví dụ với tham số query -->
                            <a href="{{ route('admin.events.scanQR', ['event_id' => $event->id]) }}" class="btn btn-info">Quét QR</a>
                            <a href="{{ route('admin.events.attendances', ['event_id' => $event->id]) }}" class="btn btn-info">Danh sách điểm danh</a>



                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
