<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Hash;
use App\Models\User;
use DB;
use Input;
use Validator;


class AuthController extends Controller
{
    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
    
    public function getLogin()
    {
        return view('auth/login');
    }
    public function postLogin(Request $request)
    {
        // echo "<pre>";
        // print_r($_GET);
        // echo "</pre>";
        // exit();
        //validation
        $this->validate($request, [
            'username'=>'required',
            'password' =>'required|min:6'
        ], [
            'username.required' => "Vui lòng nhập tên đăng nhập",
            'password.min' => 'Mật khẩu phải tối thiểu 6 kí tự',
            'password.required' => 'Vui lòng nhập password.',
        ]);
        //authentication
        $auth = array(
            'username'=>$request->username,
            // 'password'=>Hash::make($request->password),
            'password'=>$request->password,
            'level' => 0
            
        );
        $remember = isset($request->remember) ? true : false;
        if (Auth::attempt($auth, $remember)) {
            return redirect()->route('getIndexBooking');
        }
        else {         
            flash('Lỗi! Quý khách vui lòng nhập đúng tên đăng nhập hoặc mật khẩu.', 'danger');
            return redirect()->back();      
        }
    }
    public function getLoginAdmin()
    {
        return view('admin.login');
    }
    public function postLoginAdmin(Request $request)
    {
        // echo "<pre>";
        // print_r($_GET);
        // echo "</pre>";
        // exit();
        //validation
        $this->validate($request, [
            'email'=>'email|required',
            'password' =>'required|min:6'
        ], [
            'email.email' => 'Email không đúng định dạng.',
            'email.required' => "Vui lòng nhập email",
            'password.min' => 'Mật khẩu phải tối thiểu 5 kí tự',
            'password.required' => 'Vui lòng nhập password.'
        ]);
        //authentication
        $auth1 = array(
            'email'=>$request->email,
            // 'password'=>Hash::make($request->password),
            'password'=>$request->password,
            'level' => 1
            
        );
        $auth2 = array(
            'email'=>$request->email,
            // 'password'=>Hash::make($request->password),
            'password'=>$request->password,
            'level' => 2
            
        );
        $auth3 = array(
            'email'=>$request->email,
            // 'password'=>Hash::make($request->password),
            'password'=>$request->password,
            'level' => 3
            
        );
        $auth4 = array(
            'email'=>$request->email,
            // 'password'=>Hash::make($request->password),
            'password'=>$request->password,
            'level' => 4
        );
        if (Auth::attempt($auth2)) {
            return redirect()->route('admin.user.list');
        } elseif (Auth::attempt($auth3)) {
            return redirect()->route('admin.employer.list');
        } elseif (Auth::attempt($auth1)) {
            return redirect()->route('admin.home.list');
        } elseif (Auth::attempt($auth4)) {
            return redirect()->route('admin.employer.listEmployer');
        } else {
            flash('Lỗi! Vui lòng nhập đúng email và mật khẩu.', 'danger');
            return redirect()->back();
        }
    }

    public function getSignup()
    {
        return view('auth/signup');
    }
    public function postSignUp(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'username' => 'required',
            'email' =>'required|unique:users,email',
            'password' =>'required|min:6|confirmed',
            'gender'=>'required',
            'phone'=>'required|min:10|max:11|unique:users,phone|regex:/^\+?[0-9]{7,12}$/',
            'address' =>'required'
            ],[
            'name.required' =>'Vui lòng điền họ tên.',
            'email.required' =>'Vui lòng điền email đăng nhập.',
            'email.unique' =>'Email đã tồn tại.',
            'password.required' =>'Vui lòng nhập mật khẩu .',
            'password.min' =>'Mật khẩu phải nhiều hơn 6 ký tự',
            'password.confirmed' =>'Xác nhận mật khẩu không trùng khớp.',
            'gender.required'=>'Vui lòng chọn giới tính.',
            'phone.required'=>'Vui lòng nhập số điện thoại của bạn.',
            'phone.unique'=>'Số điện thoại của bạn đã được sử dụng bởi 1 tài khoản khác.',
            'phone.min.max' => 'Số điện thoại không đúng',
            'phone.regex'=>'Số điện thoại không hợp lệ.',
            'address.required'=>'Vui lòng nhập địa chỉ.'
        ]);
        $user = new User();
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->name = $request->name;
        $user->gender = $request->gender;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->save();
        flash()->overlay('Quý khách đã đăng ký thành công!');
        return redirect(url('auth/login'));
    }
    public function getUpdate()
    {
        $customers = DB::table('customers')->select('name')->get();
        return view('auth/information', compact('customers'));
    }

}
