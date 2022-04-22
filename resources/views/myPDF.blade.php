<!DOCTYPE html>
<html>
<head>
	<title>Hi</title>
</head>
<body>
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            
        </tr>
		@foreach ($users as $user)
        <tr>
            <td>{{$user->id}}</td>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>

		@endforeach	
    </table>  
</body>
</html>