<?php

namespace App\Http\Controllers\Admin;

use App\Models\GroupBooking;
use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Auth;
use DB;

class OrderController extends Controller
{
    public function __construct()
    {
        if(!Auth::user()->isSuperAdmin() && !Auth::user()->isAdminKhachHang()){
            abort(404);
        }
        $this->middleware('auth');
    }
    public function index ()
    {
        //1 sản phẩm thì thuộc về 1 chủ đề
        // $cate_orders = CateOrder::select('id','name','alias');
        $orders = Order::select()->orderBy('created_at','DESC')->get();
        //thêm 3 trường : khách hàng | tổng tiền
        foreach($orders as $k => $order){
            $user = $order->user()->first();
            $orders[$k]->username = $user->name;
            //->lấy được tổng sp đã mua
            // $orderItems = DB::table('order_items')
            //                      ->select(DB::raw('sum(amount) as total_amount,order_id'))
            //                      ->where('order_id', $order->id)
            //                      ->groupBy('order_id')
            //                      ->get();
            //lấy ra tổng tiền mỗi hóa đơn
            $total_price = DB::table('order_items')
                                ->select(DB::raw('sum(order_items.amount * menu.price) as total_price'),'order_id')
                                ->join('menu','order_items.menu_id','=','menu.id')
                                ->where('order_items.order_id',$order->id)
                                ->groupBy('order_items.order_id')
                                ->first();
            $orders[$k]->total_price=isset($total_price->total_price )? $total_price->total_price :0;
        }
        
        return view('admin.order.list',compact('orders'));
    }

    public function edit ($id, $randNumber)
    {
        $order = Order::select('id', 'note', 'user_id', 'order_no', 'status', 'created_at', 'rand_number')->where('user_id', '=', $id)->first();
        $user = User::select('id', 'name', 'phone', 'email', 'address', 'created_at')->where('id', '=', $order->user_id)->first();
        $combos = DB::select('SELECT o.id, o.order_no, o.status, o.user_id, o.rand_number, o.created_at, 
                              od.order_id, od.menu_id, od.amount, od.id, 
                              g.rand_number, 
                              m.image, m.name, m.price
                      FROM order_items od join orders o on od.order_id = o.id join groupbookings g on o.rand_number = g.rand_number join menu m on m.id = od.menu_id
                      HAVING g.rand_number = o.rand_number AND o.rand_number = "'. $randNumber .'"');
        if (empty($combos)) {
            echo "Không có thực đơn";
            die;
        }
        return view('admin.order.edit', compact('combos','order', 'user'));
    }
    
    public function update (Request $request , $id) {
        $this->validate($request,
        [
            'status' => 'required'
        ], [
            'status.required' => 'Chọn tình trạng hóa đơn.'
        ]);
        $order = Order::find($id);
        $order->ad_note = $request->ad_note;
        $order->status = $request->status;
        $order->save();
        return redirect()->route('admin.booking.index');
    }

    public function destroy ($id) {
        DB::table('orders')->where('id', $id)->delete();
        return redirect()->route('admin.order.index');
    }

    public function unpaid () {
        $orders = Order::select()->where('status', '=', 0)->orderBy('created_at','asc')->get();
        foreach($orders as $k => $order){
            $user = $order->user()->first();
            $orders[$k]->username = $user->name;
            $total_price = DB::table('order_items')
                            ->select(DB::raw('sum(order_items.amount * menu.price) as total_price'),'order_id')
                            ->join('menu','order_items.menu_id','=','menu.id')
                            ->where('order_items.order_id',$order->id)
                            ->groupBy('order_items.order_id')
                            ->first();
            $orders[$k]->total_price=isset($total_price->total_price )? $total_price->total_price :0;
        }
        return view('admin.order.list',compact('orders'));
    }

    public function printOrder ($id, $randNumber)
    {
        $order = DB::table('orders')
            ->select('orders.id', 'orders.note', 'orders.user_id', 'orders.order_no', 'orders.status', 'orders.created_at', 'orders.rand_number',
                        'users.name', 'users.phone', 'users.email')
            ->join( 'users', 'users.id', '=', 'orders.user_id')
            ->where('users.id', $id)->first();
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
        return view('admin/order/printOrder', compact('combos', 'order', 'bookings'));
    }

}