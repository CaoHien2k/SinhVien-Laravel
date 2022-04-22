<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile;
use Validator;
use App\DataTables\UserDataTable;
use App\Exports\UsersExport;
use App\Imports\UsersImport;
use App\Notifications\ImportHasFailedNotification;
use DataTables;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Notifications\MyFirstNotification;
use Barryvdh\DomPDF\PDF;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index(Request $request)
    // {
    //     // $users = User::paginate(3);

    //     // return view('users.index',compact('users'));
    //     // return $dataTable->render('users.index');

    //     // $data = DB::table('users')->select('users.*')                               
    //     //                           ->where(DB::raw("(DATE_FORMAT(created_at,'%Y-%m'))"),"2022-03")
    //     //                           ->orderBy('users.created_at')
    //     //                           ->get();

    //     //so sánh 2 column bằng nhau
    //     // $data = DB::table('users')
    //     //         ->whereColumn('updated_at','created_at')
    //     //         ->get();
    //     // dd($data);

    //     if ($request->ajax()) {
    //         $data = User::latest()->get();
    //         return Datatables::of($data)
    //                 ->addIndexColumn()
    //                 ->addColumn('action', function($row){
    //                        $btn = '<a href="javascript:void(0)"  data-id="' . $row->id . '" class="btn btn-primary editUser">Sửa</a> ';    
    //                        $btn .= '<a href="javascript:void(0)"  data-id="' . $row->id . '" class="btn btn-danger deleteUser">Xóa</a> ';
    //                        $btn .= '<a href="javascript:void(0)"  data-id="' . $row->id . '" class="btn btn-success subjectUser">Môn học</a>';
     
    //                         return $btn;
    //                 })
    //                 ->rawColumns(['action'])
    //                 ->make(true);
    //     }
      
    //     return view('users.index');

    // }

    public function index(UserDataTable $dataTable)
    {
        // dd($dataTable);
        return $dataTable->render('users.index');
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
            'email' =>'email|required|unique:users',
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
        return response()->json(['success'=> 'Xóa thành công']);
        // return redirect()->route('users.index')->with('success','xóa sinh viên thành công');
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

    
    public function importExportView()
    {
       return view('import');
    }
   
    /**
    * @return \Illuminate\Support\Collection
    */
    public function export() 
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }
   
    /**
    * @return \Illuminate\Support\Collection
    */
    public function import() 
    {
        // Excel::import(new UsersImport,request()->file('file'));
        // Excel::queueImport(new UsersImport,request()->file('file'));   
        $user = User::first();
        $import = new UsersImport($user);
        $import->import(request()->file('file'));

        // dd($import->errors());
        return back();
    }

    public function sendNotification()
    {
        $user = User::first();
  
        $details = [
            'greeting' => 'Hi Artisan',
            'body' => 'This is my first notification from ItSolutionStuff.com',
            'thanks' => 'Thank you for using ItSolutionStuff.com tuto!',
            'actionText' => 'View My Site',
            'actionURL' => url('/'),
            'order_id' => 101
        ];
  
        $user->notify(new MyFirstNotification($details));
        
        dd('done');
    }

     public function generatePDF(PDF $pdf)
    {
        $users = User::all();    
        $bill = $pdf->loadView('myPDF', compact('users'));
        return $pdf->download('users.pdf');
    }
}
