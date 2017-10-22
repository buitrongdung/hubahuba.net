<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use App\Models\Saraly;
use App\Models\SaralyEmployer;
use App\Models\TypeEmployer;
use App\Models\Employer;
use App\Models\ChamCong;
use App\Models\TinhLuong;
use DB;
use Input, Auth;

class SaralyController extends Controller
{
    public function __construct()
    {
        if (!Auth::user()->isSuperAdmin() && !Auth::user()->isNhanVien() && !Auth::user()->isAdminNhanSu()) {
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
        $saraly = Saraly::all();
        return view('admin.saraly.listSaraly', compact('saraly'));
    }

    public function create()
    {
        $typeEmps = TypeEmployer::select('id_employer', 'description')->orderBy('id_employer')->get();
        return view('admin.saraly.addSaraly', compact('typeEmps'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'ngayCongChuan' => 'numeric',
            'luongCoBan' => 'numeric',
            'phuCap' => 'numeric',
            'khoanTru' => 'numeric'
        ], [
            'ngayCongChuan.numeric' => 'Nhập đúng số ngày',
            'luongCoBan.numeric' => 'Nhập đúng số tiền',
            'phuCap' => 'Nhập đúng số tiền',
            'khoanTru' => 'Nhập đúng số tiền'
        ]);
        $saraly = new Saraly();
        $saraly->type_employer_id = $request->typeEmps;
        $saraly->ngay_cong_chuan = $request->ngayCongChuan;
        $saraly->luong_co_ban = $request->luongCoBan;
        $saraly->phu_cap = $request->phuCap;
        $saraly->khoan_tru = $request->khoanTru;
        $saraly->save();
        return redirect()->route('admin.saraly.list');
    }

    public function showEmployer()
    {
        $emps = Employer::orderBy('name', 'ASC')->get();
        return view('admin.saraly.saralyEmployer', compact('emps'));
    }

    public function payroll($id)
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
            ->where('employer.id_employer', $id)
//            ->where('cham_cong.month', 4)
            ->orderBy('cham_cong.year', 'ASC')
            ->orderBy('cham_cong.month', 'ASC')
            ->get();
        $emp = Employer::where('id_employer', $id)->first();
        return view('admin.saraly.payroll', compact('emp', 'saraly'));
    }

    public function editSaraly($id)
    {
        $data = Saraly::select('id', 'luong_co_ban', 'phu_cap', 'ngay_cong_chuan', 'khoan_tru')->where('id', $id)->firstOrFail();
        return view('admin.saraly.editSaraly', compact('data'));
    }

    public function updateSaraly(Request $request, $id)
    {
        try {
            Saraly::where('id', $id)->update($request->except('_method', '_token', 'editSaraly'));
            return redirect()->route('admin.saraly.list');
        } catch (Exception $e) {
            echo 'error:' . $e->getMessage();
        }
    }

    public function destroy($id)
    {
        DB::table('saraly')->where('id', $id)->delete();
        return redirect()->route('admin.saraly.list');
    }

    public function listChamCong()
    {
        $employee = Employer::orderBy('name', 'ASC')->get();
        return view('admin.saraly.listChamCong', compact('employee'));
    }

    public function getChamCong()
    {
        $checkChamCong = ChamCong::where('month', date('m') - 1)->get();
        if (isset($checkChamCong)) {
            echo "Đã chấm công tháng trước";die;
        } else {
            $employer = Employer::orderBy('name', 'ASC')->get();
        }
        return view('admin.saraly.createChamCong', compact('employer'));
    }

    public function ChamCong(Request $request)
    {
        if (isset($_POST['checkValue'])) {
            $listCheck = json_decode($_POST['checkValue']);
            foreach ($listCheck as $list) {
                $date = explode('-', $list);
                $chamCong = new ChamCong();
                $chamCong->employer_id = $date[1];
                $chamCong->month = date('m') - 1;
                $chamCong->year = date('Y');
                $chamCong->ngay_cong = $date[0];
                $chamCong->save();
            }
        }
        return redirect()->route('admin.saraly.listChamCong');
    }

    public function editChamCong($id)
    {
        $data = ChamCong::where('employer_id', $id)->firstOrFail();
        return view('admin.saraly.editChamCong', compact('data'));
    }

    public function updateChamCong(Request $request, $id)
    {
        try {
            ChamCong::where('employer_id', $id)->update($request->except('_method', '_token', 'editChamCong'));
            return redirect()->route('admin.saraly.listChamCong');
        } catch (Exception $e) {
            echo 'error:' . $e->getMessage();
        }
    }

    public function destroyChamCong($id)
    {
        DB::table('cham_cong')->where('employer_id', $id)->delete();
        return redirect()->route('admin.saraly.listChamCong');
    }

    public function showDetailChamCong()
    {
        $currentMonth = '';
        $currentYear = '';
        if (isset($_POST['month'], $_POST['year'])) {
            $currentMonth = $_POST['month'];
            $currentYear = $_POST['year'];
        }
        $employee = Employer::all();
        return view('admin.saraly.listChamCong', compact( 'employee','currentYear', 'currentMonth', 'month', 'year'));
    }

}
