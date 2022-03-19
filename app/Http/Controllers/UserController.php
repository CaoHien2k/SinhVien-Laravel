<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile;
use Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(3);
        return view('users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' =>'required',
            // 'phone' =>'numeric|unique:users|min:10',
            'email' =>'email|required',
            'password' =>'min:3|max:10'
        ],[
            'name.required' => 'bắt buộc nhập tên',
            // 'phone.number' =>'số điện thoại phải là số',
            // 'phone.unique' =>'số điện thoại này đã tồn tại',
            // 'phone.min' =>'số điện thoại phải >= 10 số',
            // 'phone.max' =>'số điện thoại phải <= 11 số',
            'email.required' =>'bắt buộc nhập email',
            'email.email' => 'hãy nhập đúng cú pháp email',
            'password.min' =>'mật khẩu phải lớn hơn 3 ký tự',
            'password.max' =>'mật khẩu phải nhỏ hơn 10 ký tự',

        ]);
        // $validator = Validator::make($request->all(),[
        //     'name' =>'required',
        //     'phone' =>'numeric|unique:users|min:10',
        //     'email' =>'email|required',
        //     'password' =>'min:3|max:10',
        //     'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        // ],[
        //     'name.required' => 'bắt buộc nhập tên',
        //     'phone.number' =>'số điện thoại phải là số',
        //     'phone.unique' =>'số điện thoại này đã tồn tại',
        //     'phone.min' =>'số điện thoại phải >= 10 số',
        //     'phone.max' =>'số điện thoại phải <= 11 số',
        //     'email.required' =>'bắt buộc nhập email',
        //     'email.email' => 'hãy nhập đúng cú pháp email',
        //     'password.min' =>'mật khẩu phải lớn hơn 3 ký tự',
        //     'password.max' =>'mật khẩu phải nhỏ hơn 10 ký tự',
        // ]);

        // if($validator->passes()){
        //     $data = $request->all();
        //     $data['password'] = bcrypt($data['password']);
        //     User::create($data);
        //     return response()->json(['success','thêm sinh viên thành công']);
        // }
        // return response()->json(['error'=> $validator->errors()->toArray()]);

        // $user = $request->only('name','email','password');
        // $user['password'] = bcrypt($user['password']);   
        // User::create($user); 
        
        
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        
        $profile = new Profile();
        $profile->code = $request->code;
        $profile->grade = $request->grade;
        $profile->birthday = $request->birthday;
        $profile->phone = $request->phone;
        $profile->address = $request->address;
        $profile->user_id = $user->id;       
        if($request->hasFile("image")){
            $file = $request->file("image");
            $file_name= $file->getClientOriginalName();
            $file->move(public_path('/images'),$file_name);//insert file vào thư mục
            $profile->image = $file_name;
                
        }       
        $profile->save();
        
        
        return redirect()->route('users.index')->with('success','thêm sinh viên thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $user = User::findOrFail($id);
        // $data = $request->all();
        // $data['password'] = bcrypt($data['password']);
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['password'] = bcrypt($request->password);
        $user->update($data);

        $profile = Profile::where('user_id',$id);
        $pro['code'] = $request->code;
        $pro['grade'] = $request->grade;
        $pro['birthday'] = $request->birthday;
        $pro['phone'] = $request->phone;
        $pro['address'] = $request->address;
        $pro['user_id'] = $user->id;  
        if($request->hasFile("image")){
            $file = $request->file("image");
            $file_name= $file->getClientOriginalName();
            $file->move(public_path('/images'),$file_name);//insert file vào thư mục
            $pro['image'] = $file_name;
                
        }
        $profile->update($pro);
        return redirect()->route('users.index')->with('success','cập nhật sinh viên thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->route('users.index')->with('success','xóa sinh viên thành công');
    }
    public function showSubject($id)
    {
        $user = User::with('subjects')->findOrFail($id);
        return view('users.showSubject', compact('user'));
    }
    public function showProfile($id)
    {
        $user = User::with('profile')->findOrFail($id);
        return view('users.showProfile', compact('user'));
        
    }
}
