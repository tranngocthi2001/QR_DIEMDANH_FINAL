@extends('layouts.app')

@section('content')
<div class="col-md-6">
            <a href="{{ route('admin.event.index') }}" class="btn btn-success">Quản lý event</a>
        </div>
<h1>Danh sách người dùng</h1></br>
<a href="{{ route('admin.users.create') }}" class="btn btn-success mb-2">Thêm mới</a>
    <table class="table">
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <!-- Thêm các cột khác nếu cần -->
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-primary btn-sm">Sửa</a>
                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc muốn xóa người dùng này?')">Xóa</button>
                        </form>
                    </td>
                <!-- Thêm các cột khác nếu cần -->
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
