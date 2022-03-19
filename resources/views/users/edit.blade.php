@extends('layouts.app')
@section('title')
    <title>Thêm sinh viên</title>
@endsection
@section('content')
<div class="container">
  <form action="{{route('users.update',$user->id)}}" method="POST" enctype="multipart/form-data">
  @method('PUT')
  @csrf
    <div class="form-group" >
        <label>Họ và tên<i style="color:red">*</i></label>
        <input type="text"  name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
    </div>
    <div class="form-group" >
        <label>Mã sinh viên<i style="color:red">*</i></label>
        <input type="text"  name="code" class="form-control" value="{{ old('code', $user->profile->code) }}" required>
    </div>
    <div class="form-group" >
        <label>Lớp sinh hoạt</label>
        <input type="text"  name="grade" class="form-control" value="{{ old('grade', $user->profile->grade) }}" required>
    </div>
    <div class="form-group" >
        <label>Ngày sinh</label>
        <input type="date"  name="birthday" class="form-control" value="{{ old('birthday', $user->profile->birthday) }}" >
    </div>
    <div class="form-group" >
        <label>Số điện thoại</label>
        <input type="text"  name="phone" class="form-control" value="{{ old('phone', $user->profile->phone) }}" required>
    </div>
    <div class="form-group" >
        <label>Địa chỉ<i style="color:red">*</i></label>
        <input type="text"  name="address" class="form-control" value="{{ old('address', $user->profile->address) }}" required>
    </div>
    <div class="form-group" >
        <label>Email<i style="color:red">*</i></label>
        <input type="text"  name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
    </div>
    <div class="form-group" >
        <label>Mật khẩu<i style="color:red">*</i></label>
        <input type="password"  name="password" class="form-control" value="{{ old('password', '') }}" >
    </div>
    <div class="form-group" >
        <label>Ảnh<i style="color:red">*</i></label>
        <input type="file"  name="image" class="form-control" value="{{ old('image', '') }}" required>
        @if($user->profile->image == null)
            <i>Không có ảnh</i>
        @else
            <img src="{{asset('/images/'.$user->profile->image)}}"  width="100px" height="100px">
        @endif
    </div>
    <button type="submit" class="btn btn-primary">Cập nhật</button>
  </form>
</div>
@endsection