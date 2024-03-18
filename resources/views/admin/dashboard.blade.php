{{-- resources/views/admin/dashboard.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Trang Admin</h1>
    <div class="row">
        <div class="col-md-6">
            <a href="{{ route('admin.users.index') }}" class="btn btn-primary">Quản lý người dùng</a>
        </div>
        <div class="col-md-6">
            <a href="{{ route('admin.event.index') }}" class="btn btn-success">Quản lý event</a>
        </div>
    </div>
</div>
@endsection
