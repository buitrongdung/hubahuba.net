<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Message;
use Auth;
use DB;


class UserController extends Controller
{
    public function __construct()
    {
        if(!Auth::user()->isAdminKhachHang()){
            abort(404);
        }
        $this->middleware('auth');
    }
    public function index () {
        $users = User::select('id', 'username', 'password', 'name', 'gender', 'email', 'phone', 'address')->where('level', '=', 0)->get();
        return view('admin/user/listuser', compact('users'));
    }
    public function show ($id) {
        $user = User::where('id', $id)->firstOrFail();
        return view('admin.user.inforuser', compact('user'));
    }
    public function destroy ($id) {
        DB::table('users')->where('id', $id)->delete();
        return redirect()->route('admin.user.list');
    }   
}
