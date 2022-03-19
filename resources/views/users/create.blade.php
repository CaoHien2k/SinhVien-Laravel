@extends('layouts.app')
@section('title')
    <title>Thêm sinh viên</title>
@endsection
@section('styles')
@endsection
@section('content')
<div class="alert alert-danger print-error-msg" style="display:none">
    <ul></ul>
</div>
<div class="container">
  <form action="{{route('users.store')}}" method="post"  enctype="multipart/form-data">
  @csrf
    <div class="form-group" >
        <label>Họ và tên<i style="color:red">*</i></label>
        <input type="text"  name="name" class="form-control" value="{{ old('name', '') }}" required>
        @if ($errors->has('name'))
            <span class="text-danger">{{ $errors->first('name') }}</span>
        @endif
    </div>
    <div class="form-group" >
        <label>Mã sinh viên</label>
        <input type="text"  name="code" class="form-control" value="{{ old('code', '') }}" required>
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
        @if ($errors->has('phone'))
            <span class="text-danger">{{ $errors->first('phone') }}</span>
        @endif
    </div>
    <div class="form-group" >
        <label>Địa chỉ<i style="color:red">*</i></label>
        <input type="text"  name="address" class="form-control" value="{{ old('address', '') }}" required>
    </div>
    <div class="form-group" >
        <label>Email<i style="color:red">*</i></label>
        <input type="text"  name="email" class="form-control" value="{{ old('email', '') }}" required>
        @if ($errors->has('email'))
            <span class="text-danger">{{ $errors->first('email') }}</span>
        @endif
    </div>
    <div class="form-group" >
        <label>Mật khẩu<i style="color:red">*</i></label>
        <input type="password"  name="password" class="form-control" value="{{ old('password', '') }}" required>
        @if ($errors->has('password'))
            <span class="text-danger">{{ $errors->first('password') }}</span>
        @endif
    </div>
    <div class="form-group" >
        <label>Ảnh<i style="color:red">*</i></label>
        <input type="file"  name="image" class="form-control" value="{{ old('image', '') }}" required>
        @if ($errors->has('image'))
            <span class="text-danger">{{ $errors->first('image') }}</span>
        @endif
    </div>
    <button type="submit" class="btn btn-primary btn-submit">Thêm</button>
  </form>
</div>
@endsection


@section('scripts')
    <!-- <script src="{{ asset('js/jquery-3.5.0.min.js') }}"></script> -->
    <!-- <script type="text/javascript">
        $(document).ready(function(){
            $(".btn-submit").click(function(e){
                e.preventDefault();
                var _token = $("input[name='_token']").val();
                var name = $("input[name='name']").val();
                var grate = $("input[name='grate']").val();
                var birthday = $("input[name='birthday ']").val();
                var address = $("input[name=address']").val();
                var email = $("input[name=email']").val();
                var password = $("input[name=password']").val();

                $.ajax({
                    url: "{{ route('users.store')}}",
                    type: "POST",
                    data:{
                        _token:_token,
                        name:name,
                        birthday:birthday,
                        phone:phone,
                        address:address,
                        email:email,
                        password:password
                    },
                    // beforeSend: function(){
                    //     $(document).find('span.error').text('');
                    // }
                    // success: function(data){
                    //     if(data.error == 0){
                    //         $.each(data.errors,function(prefix,val){
                    //             $('span.'+prefix+'_error').text(val[0]);
                    //         });
                    //     }else{
                    //         alert(data.success);
                    //     }
                    // }
                    success: function(data){
                        if($.isEmptyObject(data.error)){
                            alert('thêm sinh viên thành công');
                        }else{
                            printErrorMsg(data.error);
                        }
                    }
                });
            });
            function printErrorMsg(msg){
                $(".print-error-msg").find("ul").html('');
                $(".print-error-msg").css('display','block');
                $.each(msg,function(key,value){
                    $(".print-error-msg").find("ul").append('<li>'+value+'</li>');

                });
            }
        });
    </script> -->
@endsection