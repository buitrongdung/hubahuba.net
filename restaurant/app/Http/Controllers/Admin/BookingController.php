<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Faker\Provider\DateTime;
use function GuzzleHttp\Psr7\modify_request;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\ComboDinings;
use App\Models\GroupBooking;
use App\Models\User;
use Auth;
use DB;


class BookingController extends Controller
{
    public function __construct()
    {
        if (!Auth::user()->isSuperAdmin() && !Auth::user()->isAdminKhachHang()) {
            abort(404);
        }
        $this->middleware('auth');
    }

    public function index()
    {
        $bookings = GroupBooking::select('id', 'user_id', 'name', 'soluong', 'time', 'date', 'status', 'created_at', 'rand_number')
            ->orderBy('status', '=', 0)
            ->orderBy('date', 'asc')
            ->get();
        return view('admin.booking.list', compact('bookings'));
    }

    public function edit($id)
    {
        $booking = GroupBooking::where('id', $id)->firstOrFail();
        $users = User::where('id', $booking->user_id)->firstOrFail();
        $dinings = ComboDinings::all();
        return view('admin.booking.edit', compact('booking', 'users', 'dinings'));
    }

    public function update(Request $request, $id)
    {
        try {
            GroupBooking::where('id', $id)->update($request->except('_method', '_token', 'editOrder'));
            return redirect()->route('admin.booking.index');
        } catch (Exception $e) {
            echo 'error:' . $e->getMessage();
        }
    }

    public function destroy($id, $randNumber)
    {
        $checkOrder = DB::select('SELECT o.*, g.*                        
                      FROM orders o join groupbookings g on o.rand_number = g.rand_number
                      WHERE g.rand_number = o.rand_number AND g.id = "' . $id . '" AND g.rand_number = "' . $randNumber . '"');
        if (empty($checkOrder)) {
            DB::table('groupbookings')->where('id', $id)->delete();
        } else {
            DB::table('groupbookings')->where('id', $id)->delete();
            $order = Order::select('id', 'rand_number')->where('rand_number', $randNumber)->first();
            DB::table('order_items')->where('order_id', '=', $order->id)->delete();
            $order->delete();
        }
        flash()->overlay('Xóa đặt bàn thành công!');
        return redirect()->route('admin.booking.index');
    }

    public function unpaid()
    {
        $bookings = GroupBooking::select('id', 'user_id', 'name', 'soluong', 'time', 'date', 'status', 'created_at', 'rand_number')->where('status', '=', 0)->orderBy('date', 'asc')->get();
        return view('admin.booking.list', compact('bookings'));
    }

    public function showDetailOrder()
    {
        $currentDisplay = '';
        $currentFromDay = '';
        $currentToDay = '';
        //xem tat ca
        if (isset($_POST['selectOrder']) && $_POST['selectOrder'] == 0) {
            $bookings = GroupBooking::select('id', 'user_id', 'name', 'soluong', 'time', 'date', 'status', 'created_at', 'rand_number')
                ->orderBy('status', '=', 0)
                ->orderBy('date', 'asc')
                ->get();
            $currentDisplay = 0;
        }
        //xem hoa don chua thanh toan
        if (isset($_POST['selectOrder']) && $_POST['selectOrder'] == 1) {
            $bookings = GroupBooking::select()
                ->where('status', '=', 0)
                ->orderBy('date', 'asc')
                ->get();
            $currentDisplay = 1;
        }
        //xem hoa don da thanh toan
        if (isset($_POST['selectOrder']) && $_POST['selectOrder'] == 2) {
            $bookings = GroupBooking::select()
                ->where('status', '=', 1)
                ->orderBy('date', 'asc')
                ->get();
            $currentDisplay = 2;
        }
        if (isset($_POST['fromDay'], $_POST['toDay'])) {
            $bookings = GroupBooking::where('date', '>=', $_POST['fromDay'])
                ->where('date', '<=', $_POST['toDay'])
                ->orderBy('date', 'ASC')
                ->get();
            $currentFromDay = $_POST['fromDay'];
            $currentToDay = $_POST['toDay'];
        }
        return view('admin.booking.list', compact('bookings', 'currentDisplay', 'currentToDay', 'currentFromDay'));
    }

}
