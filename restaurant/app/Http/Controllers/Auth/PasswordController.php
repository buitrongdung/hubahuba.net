<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Input;
use Auth, Hash;
use App\Models\User;


class PasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Create a new password controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('guest');
    // }
    public function getEmail () {
        return view('password.email');
    }
    public function postEmail () {
        //
    }
    public function getReset () {
        return view('password.reset');
    }
    public function postReset () {
        //
    }
    public function getChangePassword () {
        return view('auth.password.changePassword');
    }
    public function postChangePassword (Request $request) {
        $this->validate($request, [
            'oldPass' => 'required|min:6',
            'password' => 'required|min:6|confirmed'
            ], [
            'password.required' => 'Vui lòng nhập mật khẩu mới.',
            'oldPass.required' => 'Vui lòng nhập mật khẩu cũ.',
            'password.confirmed' => 'Vui lòng nhập đúng mật khẩu mới.',
            
            'oldPass.password' => 'Vui lòng nhập mật khẩu khác mật khẩu cũ.',
            'oldPass.min' => 'Vui lòng nhập mật khẩu cũ tối thiểu 6 kí tự.',
            'password.min' => 'Vui lòng nhập mật khẩu mới tối thiểu 6 kí tự.'
        ]);
            $oldPass = Input::get('oldPass');
            $currentPass = Auth::user()->password;
            $a = Hash::make(Input::get('password'));
        if (Hash::check($oldPass, $currentPass)) {
            User::where('id', '=', Auth::user()->id)->update(['password' => $a]);
            flash()->overlay('Quý khách đã thay đổi mật khẩu thành công!');
            return redirect()->route('getinformation');

        } else {
            return redirect()->back();
        }
    }
}
