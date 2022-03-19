@extends('layouts.app')
@section('title')
    <title>Danh sách môn học đã đăng ký</title>
@endsection
@section('content')
    <h2>Sinh viên {{$user->name}}</h2>
    <table class="table table-bordered">
        <tr>
            <th>Mã sinh viên</th>
            <th>Lớp</th>
            <th>Ngày sinh</th>
            <th>Số điện thoại</th>
            <th>Địa chỉ</th>
            <th>Ảnh</th>
        </tr>
        <tr>
            <td>{{$user->profile->code}}</td>
            <td>{{$user->profile->grade}}</td>
            <td>{{date('d-m-Y', strtotime($user->profile->birthday))}}</td>
            <td>{{$user->profile->phone}}</td>
            <td>{{$user->profile->address}}</td>
            <td>
                @if($user->profile->image == null)
                    <i>Không có ảnh</i>
                @else
                    <img src="{{asset('/images/'.$user->profile->image)}}"  width="100px" height="100px">
                @endif
            </td> 

    </table>  
@endsection