<?php

namespace App\Http\Controllers;

use App\Models\NL_CheckOutV3;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use DB,Cart;
use Auth;
use Mail;
use App\Models\User;
use App\Models\Menu;
use App\Models\Combo;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\NganLuong;

class CartController extends Controller
{
	 public function __construct()
     {

     }
	public function index($id)
	{
		$menus = Menu::select('id','name', 'image', 'content', 'price', 'id_type')->where('id_type', $id)->paginate(8);
		return view('order/index', compact('menus'));
	}

	public function getAddCombo($id)
	{
		$combo_buy = Menu::where('id', $id)->first();
		Cart::add([
			'id' => $id,
			'name' => $combo_buy->name,
			'qty' => 1,
			'price' => $combo_buy->price,
			'options' => ['img' => $combo_buy->image, 'id_type' => $combo_buy->id_type]
		]);

		Cart::content();
		return redirect()->route('postOrder');
	}
	public function postOrder()
    {
		$content = Cart::content();
//		echo "<pre>";
//		print_r($content);
//		echo "</pre>";
		$total = Cart::total();
		return view('order.list', compact('content', 'total'));
	}
	public function delete($id)
	{
		Cart::remove($id);
		return redirect()->route('postOrder');
	}
	// public function ajaxMuaHang(Request $request){
 //        if($request->ajax()){
 //            session(['qty'=>$request->qty, 'id'=>$request->id]);

 //            //var_dump($request->qty);die;
 //            echo "oke";
 //        }   
 //    }
	public function ajaxMuaHang(Request $request) {
		if ($request->ajax()) {
			Cart::update($request->id, $request->qty);
			echo "oke";
		}
	}
	public function xacNhanMuaHang() 
	{
		$total = Cart::total();
		if ($total == 0) {
			return redirect('/');
		}
		$content = Cart::content();
		if( session('orderNo') =='' ){
            session(['orderNo'=>uniqid(Auth::user()->phone.'-')]);
        }
		return view('order.information', compact('total', 'content'));
	}
	public function postXacNhanMuaHang (Request $request) {
		$order = new Order;
		$order->order_no = session('orderNo');
		$order->status = 0;
		$order->user_id = Auth::User()->id;
		$order->note = $request->buyer_note;
		$order->rand_number = Session('randNumber');
		$order->save();
        Session::pull('randNumber');
		$products = Cart::content();
        foreach ($products as $key => $product) {
            $orderItem = new OrderItem;
            $orderItem->order_id = $order->id;
            $orderItem->menu_id = $product->id;
            $orderItem->amount = $product->qty;
            $orderItem->save();
        }
        Cart::destroy();
        $order = Order::select('order_no', 'user_id')->where('user_id', '=', Auth::user()->id)->orderBy('created_at','DESC')->first();
        Mail::send('order.infoMenu', ['name' => Auth::user()->name, 'order' => $order->order_no], function ($mail) {
            $mail->from('buitrongdung0895@gmail.com', 'Hubahuba Restaurant');
            $mail->to($email = Auth::user()->email, $name = Auth::user()->name)->subject("Phản hồi từ Hubahuba Restaurant");
        });
        return redirect()->route('getHome');
	}
    public function postThanhToanNganLuong (Request $request)
    {
         if(@$_POST['nlpayment']) {
             $nlcheckout = new NL_CheckOutV3(MERCHANT_ID, MERCHANT_PASS, RECEIVER, URL_API);
             $total_amount = $_POST['total_amount'];
             $array_items[0] = array('item_name1' => 'Product name',
                 'item_quantity1' => 1,
                 'item_amount1' => $total_amount,
                 'item_url1' => 'http://nganluong.vn/');
             $array_items = array();
             $payment_method = $_GET['option_payment'];
             $order_code = session('orderNo');
             $payment_type = 1;
             $order_description = $_GET['buyer_note'];
             $return_url = "{{route('getXacNhanThanhCong')}}";
             $cancel_url = urlencode("{{route('getXacNhanThanhCong')}}" . "?orderid=" . $order_code);

             $buyer_fullname = $_GET['buyer_fullname'];
             $buyer_email = $_GET['buyer_email'];
             $buyer_mobile = $_GET['buyer_mobile'];


             if ($payment_method != '' && $buyer_email != "" && $buyer_mobile != "" && $buyer_fullname != "" && filter_var($buyer_email, FILTER_VALIDATE_EMAIL)) {
                 if ($payment_method == "NL") {
                     $nl_result = $nlcheckout->NLCheckout($order_code, $total_amount, $payment_type, $order_description, $return_url, $cancel_url, $buyer_fullname, $buyer_email, $buyer_mobile, $array_items);
                     $order = new Order;
                     $order->order_no = session('orderNo');
                     $order->status = 0;
                     $order->user_id = Auth::User()->id;
                     $order->note = $request->note;
                     $order->save();
                     $products = Cart::content();
                     foreach ($products as $key => $product) {
                         $orderItem = new OrderItem;
                         $orderItem->order_id = $order->id;
                         $orderItem->menu_id = $product->id;
                         $orderItem->amount = $product->qty;
                         $orderItem->save();
                     }
                     $order = Order::select('order_no', 'user_id')->where('user_id', '=', Auth::user()->id)->orderBy('created_at','DESC')->first();
                     Mail::send('order.infoMenu', ['name' => Auth::user()->name, 'order' => $order->order_no], function ($mail) {
                         $mail->from('buitrongdung0895@gmail.com', 'Hubahuba Restaurant');
                         $mail->to($email = Auth::user()->email, $name = Auth::user()->name)->subject("Phản hồi từ Hubahuba Restaurant");
                     });
                 }
                 //var_dump($nl_result); die;
                 if ($nl_result->error_code == '00') {
                     //Cập nhât order với token  $nl_result->token để sử dụng check hoàn thành sau này
                     ?>
                     <script type="text/javascript">
                         <!--
                         window.location = "<?php echo (string)$nl_result->checkout_url; // .'&lang=en' chuyển mặc định tiếng anh  ?>"
                         //-->
                     </script>
                     <?PHP
                 } else {
                     echo $nl_result->error_message;
                 }
             }
         }
    }
    public function getXacNhanThanhCong ()
    {
        return view('order.paymentSuccess');
    }
}

