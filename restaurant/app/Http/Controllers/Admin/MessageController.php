<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Message;
use DB, Auth;


class MessageController extends Controller
{   
	public function __construct()
    {
        if(!Auth::user()->isSuperAdmin() && !Auth::user()->isAdminKhachHang()){
            abort(404);
        }
        $this->middleware('auth');
    }
    public function show () {
        $message = Message::select('id', 'name', 'email', 'phone', 'message')->paginate(10);
        return view('admin.user.listmessage', compact('message'));
    }
    public function destroy ($id) {
        DB::table('message')->where('id', $id)->delete();
        return redirect()->route('admin.message.show');
    }
}
