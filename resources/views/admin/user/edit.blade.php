@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Chỉnh sửa thông tin người dùng</h2>

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

    {{-- Form sửa người dùng --}}
    <form action="{{ route('admin.user.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT') {{-- Sử dụng phương thức PUT để cập nhật thông tin --}}

        {{-- Field tên người dùng --}}
        <div class="mb-3">
            <label for="name" class="form-label">Tên</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
        </div>

        {{-- Field email --}}
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
        </div>

        {{-- Field role --}}
        <div class="mb-3">
            <label for="role" class="form-label">Vai trò</label>
            <select class="form-select" id="role" name="role" required>
                <option value="admin" @if($user->role === 'admin') selected @endif>Admin</option>
                <option value="user" @if($user->role === 'user') selected @endif>User</option>
            </select>
        </div>

        {{-- Nút submit form --}}
        <button type="submit" class="btn btn-primary">Cập nhật</button>
    </form>
</div>
@endsection
