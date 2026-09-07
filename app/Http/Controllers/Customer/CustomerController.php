<?php

namespace App\Http\Controllers\Customer;

use Auth;
use Hash;
use PDF;
use Session;
use Response;
use Cookie;
use Str;
use File;
use Carbon\Carbon;
use GuzzleHttp\Client;
use App\Models\Country;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Media;
use App\Models\General;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderReturnItem;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    
      
    public function __construct(){
        $this->middleware('cart');
    }

    public function dashboard(Request $request){
        
        $user =Auth::user();
        
        return view(welcomeTheme().'customer.dashboard',compact('user'));
    }

    public function profile(Request $r){
        $user =Auth::user();
        if($r->isMethod('post')){
            $check = $r->validate([
                'name' => 'required|max:100',
                'email' => 'required|max:100|unique:users,email,'.$user->id,
                'mobile' => 'nullable|max:20|unique:users,mobile,'.$user->id,
                'district' => 'nullable|numeric',
                'city' => 'nullable|numeric',
                'postal_code' => 'nullable|max:20',
                'address' => 'nullable|max:200',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $user->name =$r->name;
            $user->mobile =$r->mobile;
            $user->email =$r->email;
            $user->district =$r->prefecture;
            $user->city =$r->city;
            $user->address_line1 =$r->address;
            $user->postal_code =$r->postal_code;
            
            ///////Image Upload Start////////////
            if($r->hasFile('image')){
                $file =$r->image;
                $src  =$user->id;
                $srcType  =6;
                $fileUse  =1;
                $author=$user->id;
                uploadFile($file,$src,$srcType,$fileUse,$author);
            }
            ///////Image Upload End////////////
            $user->save();
            
            Session::flash('success','Your Are Successfully Done');
            return redirect()->back();
            
        }
      return view(welcomeTheme().'customer.profile',compact('user'));
    }
    

    public function changePassword(Request $r){
        $user = Auth::user();
        if($r->isMethod('post')){
            $check = $r->validate([
                'current_password' => 'required|string|min:8',
                'password' => 'required|string|min:8|confirmed|different:current_password',
            ]);

            if(Hash::check($r->current_password, $user->password)){
                $user->password_show=$r->password;
                $user->password=Hash::make($r->password);
                $user->save();
                Session()->flash('success','Your Are Successfully Done');
                return redirect()->back();
            }else{
                Session()->flash('error','Current Password Are Not Match');
                return redirect()->back();
            }

        }

      return view(welcomeTheme().'customer.changePassword');
    }

    public function myOrders(Request $r){
        $user =Auth::user();
        $orders = $user->orders()->where('order_type','customer_order')->paginate(5);
        return view(welcomeTheme().'customer.myOrders',compact('orders'));
    }

    public function orderDetails($invoice){

        $order = Order::where('order_type','customer_order')->where('invoice',$invoice)->first();

        if(!$order){
            Session::flash('error','This Order Invoice Are Not Found');
            return back();
        }
         if(general()->mail_status && $order->email){
            //Mail Data
            $datas =array('order'=>$order);
            $template ='mails.InvoiceMail';
            $toEmail =$order->email;
            $toName =$order->name;
            $subject ='Success, Order Successfully Submitted' .general()->title;
        
            sendMail($toEmail,$toName,$subject,$datas,$template);
        }
        

        return view(welcomeTheme().'customer.invoice',compact('order'));
    }
    
    public function orderDetailsPDf($id){
        $order =Order::find($id);

        if(!$order){
            Session::flash('error','This Order Invoice Are Not Found');
            return back();
        }

        return $pdf->download('invoice.pdf');
        
    }
    
    
    public function orderCancel(Request $r,$id){
        
        $order =Order::find($id);
        
        if(!$order){
            Session::flash('error','This Order Invoice Are Not Found');
            return back();
        }

        if($order->order_status=='pending' && $order->payment_status=='unpaid'){
            return view(welcomeTheme().'customer.orderCancel',compact('order'));

        }else{
            Session::flash('error','You Can Not Cancel Order.this order Monitoring by Author.');
            return redirect()->route('customer.orderDetails',$order->id);
        }



        
    }
    
    public function orderCancelPost(Request $r,$id){
        
        $order =Order::find($id);
        
        if(!$order){
            Session::flash('error','This Order Invoice Are Not Found');
            return back();
        }
        
        $check = $r->validate([
            'reason' => 'required|max:100',
            'message' => 'required|max:500',
        ]);

        if(!$check){
            Session::flash('error','Need To Validation');
            return redirect()->back();
        }

        if(!$order->order_status=='pending'){
            Session::flash('error','You Can Not Cancel Order.this order Monitoring by Author.');
            return redirect()->back();
        }

    foreach($order->items as $item){
        $item->status='cancelled';
        $item->cancelled_at=Carbon::now();
        $item->cancelled_by=Auth::id();
        $item->total_return=$item->quantity;
        
        if($item->product){
                $product =$item->product;
                if($product->price_variation){
                    
                }else{
                    
                    $product->quantity+=$item->quantity;
                    if($product->sell_count > 0){
                    $product->sell_count-=1;
                    }
                    $product->save();
                }
            }
        
        $item->save();

        $cancelItem =OrderReturnItem::where('order_item_id',$item->id)->first();
        if(!$cancelItem){
          $cancelItem =new OrderReturnItem();
          $cancelItem->user_id=$item->user_id;
          $cancelItem->order_id=$item->order_id;
          $cancelItem->order_item_id=$item->id;
          $cancelItem->product_id=$item->product_id;
          $cancelItem->seller_id=$item->seller_id;
          $cancelItem->return_quantity=$item->quantity;
          $cancelItem->sold_quantity=$item->sold_quantity;
          $cancelItem->sold_price=$item->final_price;
          $cancelItem->return_price=$item->final_price;
          $cancelItem->reasion=$r->reason;
          $cancelItem->description=$r->message;
          $cancelItem->status='confirmed';
          $cancelItem->accepted=true;
          $cancelItem->search_key=$item->search_key;
          $cancelItem->confirmed_at=Carbon::now();
          $cancelItem->confirmed_by=Auth::id();
          $cancelItem->save();



        }
        
        //Cancel Order SMS Send Seller
    }

    $order->order_status='cancelled';
    $order->cancel_at=Carbon::now();
    $order->cancel_by=Auth::id();
    $order->cancel_reason=$r->reason;
    $order->cancel_msg=$r->message;
    $order->save();

    //Cancel Order SMS Send Admin

    //Cancel Order SMS Send User

    $user =Auth::user();
    
    if($order->payment_status=='paid'){
        $transection =new Transaction();
        $transection->order_id=$order->id;
        $transection->user_id=$order->user_id;
        $transection->type=2;
        $transection->payment_method='wallet';
        $transection->amount= $order->due_amount;
        $transection->currency='BDT';
        $transection->status='success';
        $transection->save();
            
        $user->balance +=$transection->amount;
        $user->save();

        $general =General::first();
        $general->balacne-=$transection->amount;
        $general->save();
        //Cancel Order Refund Balance To Wallet SMS Send Users

    }

    Session::flash('success','Your Order Is Successfully  Cancelled.');
    return redirect()->route('customer.orderDetails',$order->id);
    }
    
    public function orderReturn(Request $r,$id){
        
        $item =OrderItem::find($id);
        
        if(!$item){
            Session::flash('error','This Order Item Are Not Found');
            return back();
        }

        $order =$item->order;
        if($order->order_status=='delivered' && $order->delivered_at > Carbon::now()->subDays(7)){
            return view(welcomeTheme().'customer.orderReturn',compact('order','item'));
        }else{
            Session::flash('error','This Order Cannot Returned');
            return back();
        }
        
        
    }
    
    
    public function orderReturnPost(Request $r,$id){
        
        $item =OrderItem::find($id);
        
        if(!$item){
            Session::flash('error','This Order Item Are Not Found');
            return redirect()->route('customer.myOrders');
        }
        
        $check = $r->validate([
            'qty' => 'required|numeric',
            'returntype' => 'required|max:100',
            'message' => 'required|max:500',
        ]);
        
        if($r->qty > $item->quantity){
         $qty =$item->quantity;
        }else{
        $qty =  $r->qty;  
        }

        if(!$check){
            Session::flash('selectError','Please Select item and confirm Return Items');
            return redirect()->back();
        }
        
        $order =$item->order;
        
        if($order->order_status=='delivered' && $order->delivered_at > Carbon::now()->subDays(7)){

              $returnItem = new OrderReturnItem();
              $returnItem->user_id=$item->user_id;
              $returnItem->order_id=$item->order_id;
              $returnItem->order_item_id=$item->id;
              $returnItem->product_id=$item->product_id;
              $returnItem->seller_id=$item->seller_id;
              $returnItem->return_quantity=$qty;
              $returnItem->sold_quantity=$item->quantity;
              $returnItem->sold_price=$item->total_price;
              $returnItem->return_price=$qty*$item->price;
              $returnItem->reasion=$r->returntype;
              $returnItem->description=$r->message;
              $returnItem->status='pending';
              $returnItem->accepted=false;
              $returnItem->return_type=true;
              $returnItem->search_key=$item->search_key;
              $returnItem->pending_at=Carbon::now();
              $returnItem->pending_by=Auth::id();
              $returnItem->save();
              
              $item->total_return+=$qty;
              $item->save();
              
            Session::flash('success','Your return Is Successfully  Done.Wait for Approved.');
            return redirect()->back();

        }else{
            Session::flash('error','This Order Cannot Returned');
            return redirect()->route('customer.myOrders');
        }
        
        
        return $r;
        
    }
    

    public function returnCancellations(Request $r){

      $orderItems = OrderReturnItem::latest()->where('user_id',Auth::id())->paginate(20);

      return view(welcomeTheme().'customer.returnCancellations',compact('orderItems'));
    }


    public function myReviews(){
        
        $reviews = Auth::user()->reviews()->has('post')->latest()->paginate(20);
        
       return view(welcomeTheme().'customer.myReviews',compact('reviews'));
    }
    
    public function orderReview($id){
        
        $item = OrderItem::find($id);
        
        if(!$item){
            Session::flash('error','This Order Item Are Not Found');
            return back();
        }
        
        $review =ProductReview::where('item_id',$item->id)->first();
        
        
        
        return view(welcomeTheme().'customer.orderReview',compact('item'));
    }
    
    public function orderReviewPost(Request $r,$id){
        
        $item = OrderItem::find($id);
        
        if(!$item){
            Session::flash('error','This Order Item Are Not Found');
            return back();
        }
        
        $check = $r->validate([
            'star' => 'required|numeric|between:1,5',
            'review' => 'required|max:500',
        ]);

        if(!$check){
            Session::flash('error','Need To validation');
            return redirect()->back();
        }
        
        $review =ProductReview::where('user_id',Auth::id())->where('item_id',$item->id)->first();
        
        if(!$review){
          $review =new ProductReview();
          $review->item_id=$item->id;
          $review->user_id=Auth::id();
          $review->seller_id=$item->seller_id;
          $review->product_id=$item->product?$item->product->id:0;
          $review->save();
        }
        $review->seller_id=$item->seller_id;
        $review->rating=$r->star;
        $review->comment=$r->review;
        $review->save();

        Session()->flash('success','Your Are Successfully Review');
        return redirect()->back();
    }
    

    public function myBalance(){

       return view(welcomeTheme().'customer.myBalance');
    }
    
    public function addBalanceToWallet(request $r){
        return 'online payment not active';
    }




    



}
