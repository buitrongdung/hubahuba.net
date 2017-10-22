<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Employer;
use App\Models\News;
use DB, Hash;
use Input, Auth;

class ShowController extends Controller
{
    public function __construct()
    {
        if(!Auth::user()->isSuperAdmin()){
            abort(404);
        }
        $this->middleware('auth');
    }
    public function listAdmin()
    {
        $users = User::select('id', 'username', 'level', 'name', 'email', 'phone')->where('level', '!=', 0)->where('level', '!=', 4)->get();
        return view('admin.employer.infor.list', compact('users'));
    }
    public function create ()
    {
        return view('admin.employer.infor.add');
    }
    public function store(Request $request)
    {
       $this->validate($request,[
            'email' =>'required|unique:users,email',
            'password' =>'required|min:6|confirmed',
            'phone'=>'required|unique:users,phone|regex:/^\+?[0-9]{7,12}$/',
            'address' =>'required'
            ],[
            'email.required' =>'Vui lòng điền email đăng nhập.',
            'email.unique' =>'Email đã tồn tại.',
            'password.required' =>'Vui lòng nhập mật khẩu .',
            'password.min' =>'Mật khẩu phải nhiều hơn 6 ký tự',
            'password.confirmed' =>'Xác nhận mật khẩu không trùng khớp.',
            'phone.required'=>'Vui lòng nhập số điện thoại của bạn.',
            'phone.unique'=>'Số điện thoại của bạn đã được sử dụng bởi 1 tài khoản khác.',
            'phone.regex'=>'Số điện thoại không hợp lệ.',
            'address.required'=>'Vui lòng nhập địa chỉ.'
        ]);
        $user = new User();
        $user->password = Hash::make($request->password);
        $user->name = "admin";
        $user->level = $request->level;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->save();
        return redirect()->route('admin.show.listAdmin');

    }
    public function editAdmin ($id) {
        $user = User::where('id', $id)->firstOrFail();
        return view('admin.employer.infor.edit', compact('user'));
    }   
    public function update (Request $request, $id) {
        try {
            User::where('id', $id)->update($request->except('_method', '_token', 'edit'));
            return redirect()->route('admin.show.listAdmin');
        } catch (Exception $e) {
            echo 'error:' . $e->getMessage();
        }
    } 
    public function destroy ($id) {
        DB::table('users')->where('id', $id)->delete();
        return redirect()->route('admin.show.listAdmin');
    }
//tạo tài khoản cho nhân viên
    public function listAccount () {
        $emps = Employer::select('id_employer', 'name', 'account', 'email', 'level')->get();
        return view('admin.employer.account.list', compact('emps'));
    }
    public function nonAccount () {
        $emps = DB::table('employer')->select('employer.name', 'employer.email', 'employer.phone', 'users.name', 'users.email')
                ->leftJoin ('users', 'employer.email', '=', 'users.email')
                ->where ('users.password', '=', 0)
                ->get();
        return view('admin.employer.account.list', compact('emps'));
    }
    public function createAccount ($id) {
        $emp = Employer::where('id_employer', $id)->firstOrFail();
        return view('admin.employer.account.create', compact('emp'));
    }
    public function storeAccount (Request $request) {
        $this->validate($request,[
            'email' =>'required|unique:users,email',
            'password' =>'required|min:6|confirmed'
            ],[
            'email.required' =>'Vui lòng điền email đăng nhập.',
            'email.unique' =>'Email đã tồn tại.',
            'password.required' =>'Vui lòng nhập mật khẩu .',
            'password.min' =>'Mật khẩu phải nhiều hơn 6 ký tự',
            'password.confirmed' =>'Xác nhận mật khẩu không trùng khớp.'
        ]);
        $user = new User();
        $user->employer_id = $request->idEmployer;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->level = 4;
        $user->save();
        return redirect()->route('admin.account.listAccount');
    }
}
