@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Danh sách điểm danh cho sự kiện: {{ $event->name }}</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên Người Dùng</th>
                    <th>Email</th>
                    <th>Thời Gian Điểm Danh</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($attendances as $attendance)
                    <tr>
                        <td>{{ $attendance->user->id }}</td>
                        <td>{{ $attendance->user->name }}</td>
                        <td>{{ $attendance->user->email }}</td>
                        <td>{{ $attendance->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
