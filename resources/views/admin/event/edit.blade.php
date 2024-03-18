@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Chỉnh sửa sự kiện</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.events.update', $event->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Tên sự kiện</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $event->name }}" required>
        </div>

        <div class="mb-3">
            <label for="location" class="form-label">Địa điểm</label>
            <input type="text" class="form-control" id="location" name="location" value="{{ $event->location }}" required>
        </div>

        {{-- Sửa đổi start_time --}}
<div class="mb-3">
    <label for="start_time" class="form-label">Thời gian bắt đầu</label>
    <input type="datetime-local" class="form-control" id="start_time" name="start_time" value="{{ \Carbon\Carbon::parse($event->start_time)->format('Y-m-d\TH:i') }}" required>
</div>

{{-- Sửa đổi end_time --}}
<div class="mb-3">
    <label for="end_time" class="form-label">Thời gian kết thúc</label>
    <input type="datetime-local" class="form-control" id="end_time" name="end_time" value="{{ \Carbon\Carbon::parse($event->end_time)->format('Y-m-d\TH:i') }}" required>
</div>

        <button type="submit" class="btn btn-primary">Cập nhật</button>
    </form>
</div>
@endsection
