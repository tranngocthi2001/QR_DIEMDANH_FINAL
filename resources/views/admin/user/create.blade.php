@extends('layouts.app')

@section('content')
<div class="container">
<div class="col-md-6">
            <a href="{{ route('admin.event.index') }}" class="btn btn-success">Quản lý event</a>
        </div>
    <h2>Thêm người dùng mới</h2>

    {{-- Hiển thị thông báo lỗi nếu có --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form thêm người dùng --}}
    <form action="{{ route('admin.user.store') }}" method="POST">
        @csrf

        {{-- Field tên --}}
        <div class="mb-3">
            <label for="name" class="form-label">Tên</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
        </div>

        {{-- Field email --}}
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
        </div>

        {{-- Field mật khẩu --}}
        <div class="mb-3">
            <label for="password" class="form-label">Mật khẩu</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>

        {{-- Field role --}}
        <div class="mb-3">
            <label for="role" class="form-label">Vai trò</label>
            <select class="form-select" id="role" name="role" required>
                <option value="user">Người dùng</option>
                <option value="admin">Quản trị viên</option>
            </select>
        </div>

        {{-- Nút submit --}}
        <button type="submit" class="btn btn-primary">Thêm người dùng</button>
    </form>
</div>
@endsection
