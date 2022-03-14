@extends('layouts.app')
@section('title')
    <title>Thêm sinh viên</title>
@endsection
@section('content')
<div class="container">
  <form action="{{route('users.store')}}" method="post">
  @csrf
    <div class="form-group" >
        <label>Họ và tên<i style="color:red">*</i></label>
        <input type="text"  name="name" class="form-control" value="{{ old('name', '') }}" required>
    </div>
    <div class="form-group" >
        <label>Lớp sinh hoạt</label>
        <input type="text"  name="grade" class="form-control" value="{{ old('grade', '') }}" required>
    </div>
    <div class="form-group" >
        <label>Ngày sinh</label>
        <input type="date"  name="birthday" class="form-control" value="{{ old('birthday', '') }}" required>
    </div>
    <div class="form-group" >
        <label>Số điện thoại</label>
        <input type="text"  name="phone" class="form-control" value="{{ old('phone', '') }}" required>
    </div>
    <div class="form-group" >
        <label>Địa chỉ<i style="color:red">*</i></label>
        <input type="text"  name="address" class="form-control" value="{{ old('address', '') }}" required>
    </div>
    <div class="form-group" >
        <label>Email<i style="color:red">*</i></label>
        <input type="text"  name="email" class="form-control" value="{{ old('email', '') }}" required>
    </div>
    <div class="form-group" >
        <label>Mật khẩu<i style="color:red">*</i></label>
        <input type="password"  name="password" class="form-control" value="{{ old('password', '') }}" required>
    </div>
    <button type="submit" class="btn btn-primary">Thêm</button>
  </form>
</div>
@endsection