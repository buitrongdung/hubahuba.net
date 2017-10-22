<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Models\ComboDinings;
use App\Models\Combo;
use App\Models\Bookings;
use DB,Auth;
use App\Models\GroupBooking;
class BookingController extends Controller
{
    public function getIndex() {
        $introduce = DB::table('introduce')->select('name', 'description')->get();
        return view('booking/index',compact('introduce'));
    }
    
    public function getIndexBooking() {
        return view('booking/start');
    }
    
    public function postStart(Request $request) {
        $this->validate($request,[
                'agree'=>'accepted',
        ], ['agree.accepted' => "Vui lòng đồng ý với điều khoản của nhà hàng."]);
        if($request->get('agree-group') === '') {
            return redirect()->route('getGroup');
        } else {
            flash('Lỗi! Quý khách vui lòng nhập đúng ngày đặt bàn.', 'danger');
            return redirect()->back();
        }
    }
  
    public function getGroup() {
        $dinings=ComboDinings::all();
        $combos=Combo::all();
        return view('booking/group',['dinings'=>$dinings,'combos'=>$combos]);
    }

    public function postGroup(Request $request) {
        $this->validate($request,['named'=>'required','soluong'=>'required','time'=>'required','date'=>'required']);
        $currentDate = date("Y-m-d");
        $today = substr($currentDate, 8, 2);

        $selectedDate = $today + 30;
        $selectDay = substr($request->date, 8, 2);

        $hour = $request->time;
        $selectHour = substr($hour, 0, 2);
        if ($currentDate > $request->date) {
            flash('Lỗi! Quý khách phải nhập đúng ngày đặt bàn.', 'danger');
            return redirect()->back();
        } else if ($selectDay > $selectedDate) {
            flash('Lỗi! Quý khách vui lòng chỉ đặt bàn trước 1 tháng.', 'danger');
            return redirect()->back();
        }else if ($selectHour >= 07 && $selectHour <= 21) {
            Session::put('named',$request->get('named'));
            Session::put('soluong',$request->get('soluong'));
            Session::put('time',$request->get('time'));
            Session::put('date',$request->get('date'));
            $groupbooking = new GroupBooking();
            $groupbooking->user_id = Auth::user()->id;
            $groupbooking->name = $request->get('named');
            $groupbooking->soluong = $request->get('soluong');
            $groupbooking->time = $request->get('time');
            $groupbooking->date = $request->get('date');
            $groupbooking->status = 0;
            $randNumber = rand();
            $groupbooking->rand_number = $randNumber;
            \session()->put('randNumber', $randNumber);
            $groupbooking->save();
            return redirect()->route('indexCart', [10, 'combo.html']);

        } else {
            flash('Lỗi! Quý khách vui lòng đặt đúng giờ sau 8h sáng và trước 21h tối.', 'danger');
            return redirect()->back();
        }

    }
   
}
