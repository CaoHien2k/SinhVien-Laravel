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
            <th>Email</th>
            <th>Mật khẩu</th>
            <th>Thao tác</th>
        </tr>
        @foreach($users as $user)
        <tr>
            <td><a href="{{route('users.showProfile',$user->id)}}">{{$user->name}}</a></td>            
            <td>{{$user->email}}</td>
            <td>{{$user->password}}</td>
                   
            <td>
                <a class="btn btn-primary" href="{{route('users.edit',$user->id)}}">Sửa</a>
                <form action="{{route('users.destroy',$user->id)}}" method="POST" onsubmit="return confirm('Bạn có chắc chắn xóa');" style="display: inline-block;">
                    @csrf
                    <input type="submit" class="btn btn-danger" value="Xóa">
                </form>  
                <a class="btn btn-info" href="{{route('users.showSubject',$user->id)}}">Môn học</a>            
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