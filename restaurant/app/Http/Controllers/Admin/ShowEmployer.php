<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Employer;
use App\Models\ChamCong;
use App\Models\Saraly;
use App\Models\Calendar;
use App\Models\CaLamViec;
use DB, Hash;
use Input, Auth;

class ShowEmployer extends Controller
{
    public function __construct()
    {
        if (!Auth::user()->isNhanVien()) {
            abort(404);
        }
        $this->middleware('auth');
    }

    public function listEmployer()
    {
        $emps = Employer::select('id_employer', 'type_employer', 'name', 'account', 'level', 'image', 'birthday', 'cmnd', 'gender', 'phone', 'email', 'ethnic', 'religion', 'country', 'diploma', 'address')->where('email', '=', Auth::user()->email)->get();
        return view('admin.employer.detail.detail', compact('emps'));
    }

    public function show()
    {
        return view('admin.employer.infor.add');
    }

    public function saraly()
    {
        $saraly = DB::table('saraly')
            ->select('cham_cong.employer_id', 'cham_cong.month', 'cham_cong.year', DB::raw('count(ngay_cong) as ngayCong'),
                'saraly.type_employer_id', 'saraly.luong_co_ban', 'saraly.phu_cap', 'saraly.ngay_cong_chuan', 'saraly.khoan_tru',
                'employer.id_employer', 'employer.type_employer',
                'type_employer.id_employer')
            ->join('type_employer', 'type_employer.id_employer', '=', 'saraly.type_employer_id')
            ->join('employer', 'employer.type_employer', '=', 'type_employer.id_employer')
            ->join('cham_cong', 'cham_cong.employer_id', '=', 'employer.id_employer')
            ->groupBy('employer.id_employer')
            ->groupBy('cham_cong.month')
            ->groupBy('cham_cong.year')
            ->where('cham_cong.employer_id', '=', Auth::user()->employer_id)
            ->orderBy('cham_cong.year', 'ASC')
            ->orderBy('cham_cong.month', 'ASC')
            ->get();
        $emp = Employer::where('id_employer', Auth::user()->employer_id)->first();
        return view('admin.employer.detail.saraly', compact('emp', 'saraly'));
    }

    public function editDetail($id)
    {


        $emp = Employer::where('id_employer', $id)->firstOrFail();
        return view('admin.employer.detail.edit', ['emp' => $emp]);
    }

    public function updateDetail(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'cmnd' => 'required|numeric',
            'birthday' => 'required',
            'religion' => 'required',
            'ethnic' => 'required',
            'country' => 'required',
            'address' => 'required',
        ], [
            'name.required' => 'Nhập tên',
            'email' => 'Nhập email',
            'email.email' => 'Nhập đúng email',
            'phone.required' => 'Nhập số điện thoại',
            'phone.numeric' => 'Số điện thoại nhập không đúng',
            'cmnd.numeric' => 'Chứng minh nhân dân nhập không đúng',
            'cmnd.required' => 'Nhập chứng minh nhân dân',
            'birthday.required' => 'Nhập ngày sinh',
            'religion.required' => 'Nhập tôn giáo',
            'ethnic.required' => 'Nhập dân tộc',
            'country.required' => 'Nhập quốc tịch'
        ]);

        $checkEmail = Employer::where('id_employer', '<>', $id)
            ->where('email', $_POST['email'])->first();
        $checkPhone = Employer::where('id_employer', '<>', $id)
            ->where('phone', $_POST['phone'])->first();
        $checkCMND = Employer::where('id_employer', '<>', $id)
            ->where('cmnd', $_POST['cmnd'])->first();
        if (empty($checkEmail) && empty($checkPhone) && empty($checkCMND)) {
            Employer::where('id_employer', $id)->update($request->except('_method', '_token', 'editEmp'));
            return redirect()->route('admin.employer.listEmployer');
        } elseif (!empty($checkEmail)) {
            flash()->error("Email đã tồn tại");
            return redirect()->back();
        } elseif (!empty($checkPhone)) {
            flash()->error("Số điện thoại đã tồn tại");
            return redirect()->back();
        } elseif (!empty($checkCMND)) {
            flash()->error("Chứng minh nhân dân đã tồn tại");
            return redirect()->back();
        }
    }

    public function getPassword()
    {

        return view('admin.employer.detail.changePass');
    }

    public function postPassword(Request $request)
    {
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
            flash()->overlay('Bạn đã thay đổi mật khẩu thành công!');
            return redirect()->route('admin.employer.getpassword');
        } else {
            return redirect()->back();
        }
    }

    public function calendar()
    {
        $employee = Employer::where('id_employer', Auth::user()->employer_id)->get();
        return view('admin.employer.detail.calendar', compact('employee'));
    }

    public function showCalendar()
    {
        $currentMonth = '';
        $currentYear = '';
        if (isset($_POST['month'], $_POST['year'])) {
            $calendar = Calendar::where('month', $_POST['month'])->where('year', $_POST['year'])->get();
            $currentMonth = $_POST['month'];
            $currentYear = $_POST['year'];

        }
        $employee = Employer::where('id_employer', Auth::user()->employer_id)->get();
        return view('admin.employer.detail.calendar', compact('calendar', 'employee', 'currentMonth', 'currentYear'));
    }

    public function chamCong()
    {
        $employee = Employer::where('id_employer', Auth::user()->employer_id)->get();
        return view('admin.employer.bangCong', compact('employee'));
    }

    public function showChamCong()
    {
        $currentMonth = '';
        $currentYear = '';
        if (isset($_POST['month'], $_POST['year'])) {
            $currentMonth = $_POST['month'];
            $currentYear = $_POST['year'];
        }
        $employee = Employer::where('id_employer', Auth::user()->employer_id)->get();
        return view('admin.employer.bangCong', compact( 'employee','currentYear', 'currentMonth'));
    }
}
