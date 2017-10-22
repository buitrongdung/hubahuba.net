<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use App\Models\Employer;
use App\Models\TypeEmployer;
use App\Models\Saraly;
use App\Models\Calendar;
use App\Models\CaLamViec;
use DB, File;
use Input, Auth;

class EmployerController extends Controller
{
    public function __construct()
    {
        if (!Auth::user()->isSuperAdmin() && !Auth::user()->isAdminNhanSu()) {
            abort(404);
        }
        $this->middleware('auth');
    }

    public function getIndex()
    {
        return view('admin.home');
    }

    public function index()
    {
        $emps = Employer::select('id_employer', 'image', 'name', 'phone', 'type_employer')->get();
        return view('admin.employer.listemployer', compact('emps'));
    }

    public function create()
    {
        $typeEmps = TypeEmployer::select('id_employer', 'description')->orderBy('id_employer')->get();
        return view('admin.employer.addemployer', compact('typeEmps'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:employer,email',
            'phone' => 'required|numeric|unique:employer',
            'cmnd' => 'required|numeric|unique:employer',
            'birthday' => 'required',
            'religion' => 'required',
            'ethnic' => 'required',
            'country' => 'required',
            'address' => 'required',
        ], [
            'name.required' => 'Nhập tên',
            'email' => 'Nhập email',
            'email.email' => 'Nhập đúng email',
            'email.unique' => 'Email đã tồn tại',
            'phone.required' => 'Nhập số điện thoại',
            'phone.numeric' => 'Số điện thoại nhập không đúng',
            'phone.unique' => 'Số điện thoại đã tồn tại',
            'cmnd.numeric' => 'Chứng minh nhân dân nhập không đúng',
            'cmnd.required' => 'Nhập chứng minh nhân dân',
            'cmnd.unique' => 'Chứng minh nhân dân đã tồn tại',
            'birthday.required' => 'Nhập ngày sinh',
            'religion.required' => 'Nhập tôn giáo',
            'ethnic.required' => 'Nhập dân tộc',
            'country.required' => 'Nhập quốc tịch'
        ]);
        $logo = $request->file('image');
        $upload = 'images/employer';
        $filename = $logo->getClientOriginalName();
        $success = $logo->move($upload, $filename);

        $table = new Employer();
        $table->type_employer = $request->typeEmps = implode(',', Input::get('typeEmps'));
        $table->image = $filename;
        $table->name = $request->name;
        $table->account = 0;
        $table->level = 4;
        $table->cmnd = $request->cmnd;
        $table->birthday = $request->birthday;
        $table->gender = $request->gender;
        $table->email = $request->email;
        $table->phone = $request->phone;
        $table->religion = $request->religion;
        $table->ethnic = $request->ethnic;
        $table->country = $request->country;
        $table->diploma = $request->diploma;
        $table->address = trim($request->address);
        $table->save();
        return redirect()->route('admin.employer.list');
    }

    public function show($id)
    {
        $emp = Employer::where('id_employer', $id)->firstOrFail();
        return view('admin.employer.inforemployer', compact('emp'));
    }

    public function edit($id)
    {
        $emp = Employer::where('id_employer', $id)->firstOrFail();
        $types = TypeEmployer::all();
        return view('admin.employer.editemployer', ['emp' => $emp, 'types' => $types]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
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
            return redirect()->route('admin.employer.list');
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

    public function destroy($id)
    {
        $employerImg = Employer::find($id);
        File::delete('images/employer/' . $employerImg['image']);
        DB::table('employer')->where('id_employer', $id)->delete();
        return redirect()->route('admin.employer.list');
    }

    public function lichLamViec()
    {
        $employee = Employer::all();
        return view('admin.employer.calendar', compact('employee'));
    }

    public function getCalendar()
    {
        $employer = Employer::select('id_employer', 'type_employer', 'name')->orderBy('name', 'ASC')->get();
        $cals = CaLamViec::orderBy('id')->get();
        return view('admin.employer.createCalendar', compact('employer', 'cals'));
    }

    public function postCalendar(Request $request)
    {
        if (isset($_POST['listCheckbox'], $_POST['month'], $_POST['year'])) {
            $listCheck = json_decode($_POST['listCheckbox']);
            foreach ($listCheck as $item) {
                $calendar = new Calendar();
                $calendar->month = $_POST['month'];
                $calendar->year = $_POST['year'];
                $date = explode('-', $item);
                $calendar->employer_id = $date[2];
                $calendar->ngay_lam = $date[0];
                $calendar->ca_lam_viec = $date[1];
                $calendar->save();
            }
            echo 'Tạo lịch làm việc thành công!';
        } else {
            echo "Cảnh báo! Chưa chọn ca làm việc";
        }
    }

    public function editCalendar($id)
    {
        $cals = CaLamViec::select('id', 'name')->orderBy('id')->get();
        return view('admin.employer.editCalendar', compact('cals'));
    }

    public function updateCalendar(Request $request, $id)
    {
        try {
            Calendar::where('employer_id', $id)->update($request->except('_method', '_token', 'update'));
            return redirect()->route('admin.employer.lichLamViec');
        } catch (Exception $e) {
            echo 'error:' . $e->getMessage();
        }
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
        $employee = Employer::all();
        return view('admin.employer.calendar', compact('calendar', 'employee', 'currentMonth', 'currentYear'));
    }
}
