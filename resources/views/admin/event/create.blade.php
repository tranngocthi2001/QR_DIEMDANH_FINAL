@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Thêm Event Mới</h2>

    <form action="{{ route('admin.events.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Tên Event</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>

        <div class="mb-3">
            <label for="location" class="form-label">Địa điểm</label>
            <textarea class="form-control" id="location" name="location"></textarea>
        </div>

        <div class="mb-3">
            <label for="start_time" class="form-label">Thời Gian Bắt Đầu</label>
            <input type="datetime-local" class="form-control" id="start_time" name="start_time" required>
        </div>

        <div class="mb-3">
            <label for="end_time" class="form-label">Thời Gian Kết Thúc</label>
            <input type="datetime-local" class="form-control" id="end_time" name="end_time" required>
        </div>

        <button type="submit" class="btn btn-primary">Thêm Event</button>
    </form>
</div>
@endsection
