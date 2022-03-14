@extends('layouts.app')
@section('title')
    <title>Danh sách sinh viên</title>
@endsection
@section('content')
    <div>
        <a class="btn btn-success" href="{{route('users.create')}}">Thêm sinh viên</a>
    </div>
    <br>
    @if(session()->has('success'))
        <div class="alert alert-success" id="success-alert">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{session()->get('success')}}
        </div>
    @endif
    <table class="table table-bordered">
        <tr>
            <th>Tên</th>
            <th>Lớp</th>
            <th>Ngày sinh</th>
            <th>Số điện thoại</th>
            <th>Địa chỉ</th>
            <th>Email</th>
            <th>Thao tác</th>
        </tr>
        @foreach($users as $user)
        <tr>
            <td>{{$user->name}}</a></td>
            <td>{{$user->grade}}</td>
            <td>{{date('d-m-Y', strtotime($user->birthday))}}</td>
            <td>{{$user->phone}}</td>
            <td>{{$user->address}}</td>
            <td>{{$user->email}}</td>        
            <td>
                <a class="btn btn-primary" href="{{route('users.edit',$user->id)}}">Sửa</a>
                <a class="btn btn-danger" href="{{route('users.destroy',$user->id)}}">Xóa</a>
                
            </td>
        </tr>
        @endforeach
    </table>
    <div style="display: flex; justify-content: center;">{{$users->links()}}</div>
<script>
    $("#success-alert").fadeTo(1000, 500).slideUp(500, function(){
    $("#success-alert").slideUp(500);
    });

    $("#danger-alert").fadeTo(1000, 500).slideUp(500, function(){
    $("#danger-alert").slideUp(500);
    });
</script>    
@endsection