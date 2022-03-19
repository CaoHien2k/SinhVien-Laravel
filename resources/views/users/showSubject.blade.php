@extends('layouts.app')
@section('title')
    <title>Danh sách môn học đã đăng ký</title>
@endsection
@section('content')
    <h2>Sinh viên {{$user->name}}</h2>
    <table class="table table-bordered">
        <tr>
            <th>Tên môn học</th>
            <th>Thứ</th>
            <th>Tiết</th>
        </tr>
        @php 
        $count = $user->subjects->count();
        @endphp
        @if($count == 0)
            <td colspan="3">
                <i>Chưa có môn học nào</i>
            </td>  
        @else
            @foreach($user->subjects as $subject)
            <tr>
                <td>{{$subject->name}}</a></td>
                <td>{{$subject->day}}</td>
                <td>{{$subject->lesson}}</td>
            </tr>
            @endforeach
        @endif
    </table>  
@endsection