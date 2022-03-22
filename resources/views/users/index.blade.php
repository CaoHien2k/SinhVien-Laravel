@extends('layouts.app')
@section('title')
    <title>Danh sách sinh viên</title>
@endsection
@section('styles')

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
    <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th>STT</th>
                <th>Họ và Tên</th>
                <th>Email</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
   
   

<script>
    $("#success-alert").fadeTo(1000, 500).slideUp(500, function(){
    $("#success-alert").slideUp(500);
    });

    $("#danger-alert").fadeTo(1000, 500).slideUp(500, function(){
    $("#danger-alert").slideUp(500);
    });

    $(function () {
    
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('users.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
    
    $.ajaxSetup({
    headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('body').on('click','.deleteUser',function(){
        var user_id = $(this).data('id');
        confirm('Bạn có chắc chắn xóa?');
        $.ajax({
            type:"DELETE",
            url:"{{route('users.store')}}" + '/' + user_id,
            success: function(data){
                table.draw();
                alert(success);
            },
            error:function(data){
            console.log('Error:', data);
            }
            
        });
    });
    $('body').on('click','.editUser',function(){
        var user_id = $(this).data('id');
        var url = new URL(window.location);
        url = 'http://localhost/laravel/SinhVien/public/users/'+user_id+'/edit';
        window.location.href = url;
    });
    $('body').on('click','.subjectUser',function(){
        var user_id = $(this).data('id');
        var url = new URL(window.location);
        url = 'http://localhost/laravel/SinhVien/public/users/'+user_id+'/show-subject';
        window.location.href = url;
    });

  });
</script>    
@endsection