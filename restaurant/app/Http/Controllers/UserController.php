<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\GroupBooking;
use App\Models\Menu;
use App\Models\ComboDinings;
use DB, Auth;


class UserController extends Controller
{

    public function __construct()
    {

    }

    public function informationUser()
    {
        $bookings = GroupBooking::select('id', 'user_id', 'name', 'soluong', 'time', 'date', 'status')->get();
        return view('users.information', compact('bookings'));
    }

    public function getShowOrder($id)
    {
        $booking = GroupBooking::where('user_id', '=', Auth::user()->id)->orderBy('date', 'desc')->get();
        $dinings = ComboDinings::all();
        return view('users.inforOrders', compact('booking', 'dinings'));
    }

    public function editUser()
    {

//        dd($checkUser->email);
        return view('users.edituser');
    }

    public function updateUser(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required|min:10|max:11|regex:/^\+?[0-9]{7,12}$/',
            'address' => 'required'
        ], [
            'name.required' => 'Vui lòng điền họ tên.',
            'email.required' => 'Vui lòng điền email đăng nhập.',
            'phone.required' => 'Vui lòng nhập số điện thoại của bạn.',
            'phone.min.max' => 'Số điện thoại không đúng',
            'phone.regex' => 'Số điện thoại không hợp lệ.',
            'address.required' => 'Vui lòng nhập địa chỉ.'
        ]);
        $checkEmail = User::where('id', '<>', Auth::user()->id)
            ->where('email', $_POST['email'])->first();
        $checkPhone = User::where('id', '<>', Auth::user()->id)
            ->where('phone', $_POST['phone'])->first();
        if (empty($checkPhone) && empty($checkEmail)) {
            User::where('id', $id)->update($request->except('_method', '_token', 'editEmp'));
            return redirect()->route('getinformation');
        } elseif (!empty($checkEmail)) {
            flash()->error('Email bị trùng với tài khoản khác');
            return redirect()->back();
        } elseif (!empty($checkPhone)) {
            flash()->error('Số điện thoại bị trùng với tài khoản khác');
            return redirect()->back();
        }
    }

    public function getOrderMenu($id, $randNumber)
    {
        $order = Order::select('id', 'note', 'user_id', 'order_no', 'status', 'created_at')->where('user_id', '=', Auth::user()->id)->first();
        $combos = DB::select('SELECT o.id, o.order_no, o.status, o.user_id, o.rand_number, o.created_at, 
                              od.order_id, od.menu_id, od.amount, od.id, 
                              g.rand_number, 
                              m.image, m.name, m.price
                      FROM order_items od join orders o on od.order_id = o.id join groupbookings g on o.rand_number = g.rand_number join menu m on m.id = od.menu_id
                      HAVING g.rand_number = o.rand_number AND o.rand_number = "' . $randNumber . '"');
        return view('users.infoMenu', compact('order', 'combos'));
    }

    public function deleteBooking($id, $randNumber)
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
        return redirect()->back();
    }

    public function deleteOrderMenu($id)
    {
        if (OrderItem::select('id')->where('id', $id)->first() != NULL) {
            $orderItem = OrderItem::findOrFail($id);
            $orderItem->delete();
            return redirect()->route('getOrderMenu');
        }
        return redirect()->back();
    }

    public function editBooking()
    {
        $dinings = ComboDinings::all();
        $booking = GroupBooking::where('user_id', '=', Auth::user()->id)->firstOrFail();
        return view('booking.editBooking', compact('booking', 'dinings'));
    }

    public function updateBooking(Request $request, $id)
    {
        $currentDate = date("Y-m-d");
        if ($currentDate < $request->date) {
            GroupBooking::where('id', $id)->update($request->except('_method', '_token', 'editBooking'));
            return redirect()->route('getShowOrder');
        } else {
            flash('Lỗi! Quý khách vui lòng nhập đúng ngày đặt bàn.', 'danger');
            return redirect()->back();
        }
    }

    public function printMenu($id, $randNumber)
    {
        $order = Order::select('id', 'note', 'user_id', 'order_no', 'status', 'created_at')->where('user_id', '=', Auth::user()->id)->first();
        $bookings = DB::select('SELECT o.id, o.order_no, o.status, o.user_id, o.rand_number, o.created_at,                          
                              g.rand_number, g.time, g.date, g.name, g.soluong                        
                      FROM orders o join groupbookings g on o.rand_number = g.rand_number
                      WHERE g.rand_number = o.rand_number AND g.user_id = "' . $id . '" AND g.rand_number = "' . $randNumber . '"');
        $combos = DB::select('SELECT o.id, o.order_no, o.status, o.user_id, o.rand_number, o.created_at, 
                              od.order_id, od.menu_id, od.amount, od.id, 
                              g.rand_number, 
                              m.image, m.name, m.price
                      FROM order_items od join orders o on od.order_id = o.id join groupbookings g on o.rand_number = g.rand_number join menu m on m.id = od.menu_id
                      HAVING g.rand_number = o.rand_number AND o.rand_number = "' . $randNumber . '"');
        return view('users.printMenu', compact('combos', 'order', 'bookings'));
    }
}
