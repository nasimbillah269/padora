<?php

namespace App\Http\Controllers\Welcome;

use Mail;
use Auth;
use Cookie;
use Hash;
use Validator;
use Session;
use Carbon\Carbon;
use GuzzleHttp\Client;
use App\Models\Cart;
use App\Models\General;
use App\Models\Country;
use App\Models\Order;
use App\Models\User;
use App\Models\Post;
use App\Models\PostExtra;
use App\Models\Transaction;
use App\Models\WishList;
use App\Models\Attribute;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    
    public function __construct(){
        $this->middleware('cart');
    }
    
    public function addToCart(Request $r,$id)
    {

    	$product = Post::where('type',2)->find($id);
    	$qty = $r->quantity ?: 1;    

		$cookie = $r->cookie('carts');
        if($cookie && $product)
    	{
    	
    	    $ct = $r->color?: null;
    	    $st = $r->size?: null;
    	   $sku = null;
    		$oldCart = Cart::where('cookie', $cookie)->where('product_id', $product->id)->where('color', $ct)->where('size', $st)->first();
    		if($oldCart)
    		{
                $oldCart->trans_date = date("Y-m-d");
                $oldCart->user_id = Auth::id();
                $oldCart->quantity += $qty;
                $oldCart->save(); 
    		}
    		else
    		{
    			$cart = new Cart;
                $cart->addedby_id = Auth::id();
                $cart->trans_date = date("Y-m-d");
                $cart->user_id = Auth::id();
                $cart->product_id = $product->id;
                $cart->color =$ct;
                $cart->size =$st;
                $cart->sku_id = $sku ? $sku->id : null;
                if($product->emi_status==true && $r->statusEmi==true){
                $cart->emi = 1;
                }else{
                $cart->emi = 0;
                }
                $cart->quantity = $qty >= $product->min_order_quantity ? $qty : $product->min_order_quantity;
                $cart->cookie = $cookie;
                $cart->save();
    		}
    		
            
    		$carts = Cart::where('cookie', $cookie)->select(['id','product_id', 'quantity'])->latest()->paginate(500);
    		$cartsCount = Cart::where('cookie',$cookie)->sum('quantity');
	    	$cartTotalPrice = 0;
	    	$couponDisc = 0;

	    	foreach ($carts as $cart) 
            {
                if($cart->product){
                        $cartTotalPrice += $cart->subtotal();
                        $cart->product_type =$cart->product->itemType();
                        $cart->save();
                    }else{
                       $cart->delete(); 
                    }

            }
            
            
            // Shipping Charge
            $shippingCharge=general()->defult_shipping_charge?:0;

            
            $cartTax =0;
            
            if(general()->tax_status==1){
              $cartTax =  ($cartTotalPrice*general()->tax)/100;
            }

            $grandTotal = $cartTotalPrice+$shippingCharge+$cartTax - $couponDisc;
            
            $cartItem =view(welcomeTheme().'layouts.cartModal',compact('carts','cartTotalPrice','grandTotal','cartTax','couponDisc','shippingCharge'))->render();
    		$cartItem2 =view(welcomeTheme().'layouts.checkoutModal',compact('carts','cartTotalPrice','grandTotal','cartTax','couponDisc','shippingCharge'))->render();

		    if($r->ajax())
	        {	

		        return Response()->json([
		            'success' => true,
		            'cartCount' => $cartsCount,
		            'cartItem' => $cartItem,
		            'cartItem2' => $cartItem2,
		          ]);
	    	}
        }else{
            
           if($r->ajax())
	        {
            
            return Response()->json([
		            'success' => false,
		          ]);  
		          
	        }else{
	            return redirect()->route('index');
	        }
        }
        
        $nam =$r->orderNow;

        if($nam=='checkout'){
            return redirect()->route('checkout');
        }else{
        	return back()->with('success', 'Product successfully added to cart');
        }

        // return back();
    }


    public function changeToCart(Request $r,$id,$type){

    	if($r->ajax())
        {

        	$cart =Cart::find($id);

	    	$cookie = $r->cookie('carts');

	    	if($cookie && $cart)
	    	{
	    		if($type == 'increment')
		    	{
		    		
		    		$qty = $cart->quantity + 1;

		    		$cart->update(['quantity'=> $qty]);
		    		$s = true; 

		    		// $maxLimit = $cart->product->max_order_quantity ?: $cart->product->quantity;
		    		// if($qty <= $maxLimit){

		    		// 	$cart->update(['quantity'=> $qty]);
		    		// 	$s = true; 

		    		// }else{
		    		// 	$s = false;
		    		// }

		    	}elseif($type == 'decrement'){
		    		
		    		$qty = $cart->quantity - 1;

		    		$minLimit = $cart->product->min_order_quantity ?: 1;

		    		if($qty >= 1 && $qty >= $minLimit)
		    		{
		    			$cart->update(['quantity'=> $qty]);
		    			$s = true;
		    		}else{
		    			$s = false;
		    		}


		    	}elseif($type == 'quantity'){
		    	    
		    	    $qty =$r->qty?:1;
		    	    
		    	    $maxLimit = $cart->product->max_order_quantity ?: $cart->product->quantity;
		    	    $minLimit = $cart->product->min_order_quantity ?: 1;
		    		if($qty <= $maxLimit && $qty >= $minLimit && $qty >= 1){

		    			$cart->update(['quantity'=> $qty]);
		    			$s = true; 

		    		}else{
		    			$s = false;
		    		}
		    	    
		    	}elseif($type == 'delete'){
		    		$cart->delete();
		    		$s = true;
		    	}

		    	$carts = Cart::where('cookie', $cookie)->select(['id','product_id', 'quantity','color','size'])->latest()->paginate(500);

		    	$cartTotalPrice = 0;
		    	$couponDisc = 0;

		    	foreach ($carts as $cart) 
                {
                    if($cart->product){
                        $cartTotalPrice += $cart->subtotal();
                        $cart->product_type =$cart->product->itemType();
                        $cart->save();
                    }else{
                       $cart->delete(); 
                    }
                    
                    

                }

                if ($mci = Session::get('my_coupon_id')) 
                {
                    $mc =Attribute::where('type',13)->where('id',$mci)->first();

                    if($mc)
                    {
                        if($mc->location=='product'){
                            $couponCarProducts =$carts->whereIn('product_id',$mc->couponProductPosts()->pluck('reff_id'));
                            foreach($couponCarProducts as $ctp){
                                $couponDisc += $mc->couponDiscountAmount($ctp->subtotal());
                            }
                        }elseif($mc->location=='category'){
                            
                        }else{
                            $couponDisc = $mc->couponDiscountAmount($cartTotalPrice);
                        }
                      
                    }
                }
                
                
                // Shipping Charge
                $shippingCharge=general()->defult_shipping_charge?:0;

                
                $cartTax =0;
                
                if(general()->tax_status==1){
                  $cartTax =  ($cartTotalPrice*general()->tax)/100;
                }

                $grandTotal = $cartTotalPrice+$shippingCharge+$cartTax - $couponDisc;
                
                $cartsCount=$carts->sum('quantity');
		    	$cartItems =view(welcomeTheme().'carts.includes.cartItems',compact('carts','cartTax','cartTotalPrice','shippingCharge','grandTotal','couponDisc'))->render();
                $cartItem =view(welcomeTheme().'layouts.cartModal',compact('carts','cartTotalPrice','grandTotal','cartTax','couponDisc','shippingCharge'))->render();
    		    $cartItem2 =view(welcomeTheme().'layouts.checkoutModal',compact('carts','cartTotalPrice','grandTotal','cartTax','couponDisc','shippingCharge'))->render();
		    	return Response()->json([
		            'success' => $s,
		            'cartItems' => $cartItems,
		            'cartCount' => $cartsCount,
		            'cartItem' => $cartItem,
		            'cartItem2' => $cartItem2,
		          ]);


		    }else{

		    	return Response()->json([
		            'success' => false,
		          ]);

		    }

        }

    }

    public function couponApply(Request $r)
    {
        $check = $r->validate([
            'coupon_code' => 'required|max:100'
        ]);
    
        $coupon = Attribute::where('name', $r->coupon_code)
            ->where('status', 'active')
            ->whereDate('start_date', '<=', date('Y-m-d'))
            ->whereDate('end_date', '>=', date('Y-m-d'))
            ->first();
    
        $isAjax = $r->ajax();
    
        if (!$coupon) {
            $r->session()->forget(['my_coupon_id']);
            $message = 'Sorry, your coupon is invalid.';
    
            if ($isAjax) {
                return response()->json(['status' => 'error', 'message' => $message]);
            }
    
            return back()->with('info', $message);
        }
    
        $cartTotalPrice = 0;
        $cookie = $r->cookie('carts');
    
        if ($cookie) {
            $carts = Cart::where('cookie', $cookie)->get();
            foreach ($carts as $cart) {
                $cartTotalPrice += $cart->subtotal();
            }
        }
    
        if ($coupon->min_shopping > 0 && $coupon->max_shopping > 0) {
            if (!($cartTotalPrice >= $coupon->min_shopping && $cartTotalPrice <= $coupon->max_shopping)) {
                $r->session()->forget(['my_coupon_id']);
                $message = 'Sorry, you can not use coupon. Minimum: ' . priceFullFormat($coupon->min_shopping) . ', Maximum: ' . priceFullFormat($coupon->max_shopping);
    
                if ($isAjax) {
                    return response()->json(['status' => 'error', 'message' => $message]);
                }
    
                return back()->with('info', $message);
            }
        } elseif ($coupon->min_shopping > 0) {
            if ($cartTotalPrice < $coupon->min_shopping) {
                $r->session()->forget(['my_coupon_id']);
                $message = 'Sorry, you can not use coupon. Minimum shopping required: ' . priceFullFormat($coupon->min_shopping);
    
                if ($isAjax) {
                    return response()->json(['status' => 'error', 'message' => $message]);
                }
    
                return back()->with('info', $message);
            }
        } elseif ($coupon->max_shopping > 0) {
            if ($cartTotalPrice > $coupon->max_shopping) {
                $r->session()->forget(['my_coupon_id']);
                $message = 'Sorry, you can not use coupon. Maximum shopping allowed: ' . priceFullFormat($coupon->max_shopping);
    
                if ($isAjax) {
                    return response()->json(['status' => 'error', 'message' => $message]);
                }
    
                return back()->with('info', $message);
            }
        }
    
        $r->session()->put(['my_coupon_id' => $coupon->id]);
    
        $successMsg = 'Your coupon code is valid and successfully added';
    
        if ($isAjax) {
            $myCarts = myCart($r->cookie('carts'));
            
            
            $isDhaka=null;
            $cartTotalPrice =$myCarts['cartTotalPrice'];
            $shippingCharge =0;
            $couponDisc =$myCarts['couponDisc'];
            if($r->areaId || $r->cityId){

                $aresId =$r->areaId;
    	        if($r->cityId){
    	           $aresId =$r->cityId; 
    	        }
    	        
    	        $datas=Country::where('parent_id',$aresId?:'0000')->orderBy('name')->get();
                
                if($r->areaId && $r->areaId==73 && $r->cityId){
                    $datas = general()->outside_metro_area;
                    $dataArray = array_filter(explode(',', $datas));
                    if(in_array($aresId, $dataArray)){
                        $shippingCharge =general()->outside_metro_charge;
                    }else{
                        $shippingCharge =general()->inside_dhaka_shipping_charge;
    
                        if(general()->minimum_shopping > 0 && $cartTotalPrice >= general()->minimum_shopping){
                            $shippingCharge =0;
                        }
                    }
                    
                    $isDhaka='yes';
                }else{
                   if($aresId==73){
                        $shippingCharge =general()->inside_dhaka_shipping_charge;
                        $isDhaka='yes';
                    }else{
                        $shippingCharge =general()->outside_dhaka_shipping_charge;
                        $isDhaka='no';
                    } 
                }
            
            }
            
            $cartTax =0;
            if(general()->tax_status==1){
              $cartTax =  ($cartTotalPrice*general()->tax)/100;
            }

            $grandTotal = $cartTotalPrice+$shippingCharge+$cartTax - $couponDisc;

            $view2  =View(welcomeTheme().'carts.includes.orderSummery2',compact('grandTotal','cartTax','cartTotalPrice','shippingCharge','couponDisc','isDhaka'))->render();
            
            return response()->json([
                'status' => 'success',
                'message' => $successMsg,
                'view2' => $view2,
            ]);
        }
    
        return back()->with('success', $successMsg);
    }

    public function carts(Request $r){
        
    	return view(welcomeTheme().'carts.cart');
    }
    
    public function incompletedOrder(Request $r){
        $user =Auth::user();
        $token =$r->cookie('carts');
        if($r->ajax() && $token){
            $myCarts = myCart($token);
            
            $couponDisc =0;
            
            $order =Order::where('order_status','temp')->whereNotNull('search_key')->where('search_key',$token)->first();
            if(!$order){
                $order =new Order();
                $order->order_status='temp';
                $order->search_key=$token;
            }
            
            $order->user_id=Auth::check()?$user->id:null;
            $order->name=$r->name;
            $order->mobile=$r->mobile;
            $order->email=$r->email;
            $order->district=$r->district;
            $order->city=$r->city;
            $order->address=$r->address;
            $order->postal_code=$r->postal_code;
            $order->note=$r->note;
            $order->pending_at=Carbon::now();
            $order->pending_by=Auth::check()?$user->id:null;
            $order->created_at=Carbon::now();
            $order->save();
            $order->invoice=$order->created_at->format('Ymd').$order->id;
            $order->save();
            
            foreach($myCarts['carts'] as $cart){
                $item =OrderItem::where('order_id',$order->id)->first();
                if(!$item){
                    $item = new OrderItem;
                    $item->order_id = $order->id;
                }
                $item->user_id = Auth::check()?$user->id:null;
                $item->invoice = $order->invoice;
                $item->product_id = $cart->product_id;
                $item->product_name = $cart->product?$cart->product->name:null;
                $item->color =$cart->color;
                $item->size = $cart->size;
                $item->quantity = $cart->quantity;
                if($product =$cart->product){
                    if($product->variation_status){
                        
                    }else{
                        if($product->quantity > $item->quantity){
                            $product->quantity-=$item->quantity;
                            $product->sell_count+=1;
                            $product->save();
                        }
                    }
                }
                $item->price = $cart->itemprice();
                $item->total_price = $cart->subtotal();
                $item->final_price = $cart->subtotal()-$item->total_deal_discount;
                $item->pending_at = Carbon::now();
                $item->pending_by = Auth::check()?$user->id:null;
                $item->addedby_id = Auth::check()?$user->id:null;
                $item->status=$order->order_status;
                $item->order_status=$order->order_status;
                $item->save();
            }
            
            if($order->district==73){
                $datas = general()->outside_metro_area;
                $dataArray = array_filter(explode(',', $datas));
                if(in_array($order->city?:0, $dataArray)){
                    $shippingCharge =general()->outside_metro_charge;
                }else{
                    $shippingCharge =general()->inside_dhaka_shipping_charge;
                    $cartTotalPrice =$order->items->sum('final_price');
                    if(general()->minimum_shopping > 0 && $cartTotalPrice >= general()->minimum_shopping){
                        $shippingCharge =0;
                    }
                }
                
            }else{
                $shippingCharge =general()->outside_dhaka_shipping_charge;
            }
            
            $order->coupon_discount=$couponDisc;
            $order->shipping_charge =$shippingCharge;
            $order->total_price=$order->items->sum('final_price');
            $order->tax=($order->total_price*general()->tax)/100;
            $order->grand_total =$order->total_price + $order->shipping_charge + $order->tax - $order->coupon_discount;
            $order->paid_amount=0;
            $order->payment_method=$r->payment_option;
            $order->due_amount=$order->grand_total;
            $order->save();
            return $order;
            return response()->json(['status' => 'success']);
        }
        
        return back();
    }

    public function checkout(Request $r){
    	$user =Auth::user();
    	$cookie =$r->cookie('carts');
        $myCarts = myCart($cookie);         
        if(count($myCarts['carts']) ==0)
        {
            return redirect()->route('carts')->with('info', 'Sorry, Your Cart Is empty.');
        }
        
        $carts =$myCarts['carts'];
        
        $couponDisc =0;
        if($mci = Session::get('my_coupon_id')) {
            $mc =Attribute::where('type',13)->where('id',$mci)->first();
            if($mc){
                if($mc->location=='product'){
                    $couponCarProducts =$carts->whereIn('product_id',$mc->couponProductPosts()->pluck('reff_id'));
                    foreach($couponCarProducts as $ctp){
                        $couponDisc += $mc->couponDiscountAmount($ctp->subtotal());
                    }
                }elseif($mc->location=='category'){
                    
                }else{
                    $couponDisc = $mc->couponDiscountAmount($myCarts['cartTotalPrice']);
                }
              
            }
        }

        if($r->isMethod('post')){
            
            $check = $r->validate([
                'name' => 'required|max:100',
                'email' => 'nullable|max:100',
                'mobile' => 'required|max:20',
                'district' => 'nullable|numeric',
                'city' => 'nullable|numeric',
                'address' => 'required|max:500',
                'payment_option' => 'required',
            ]);
           $order =Order::where('order_status','temp')->whereNotNull('search_key')->where('search_key',$cookie)->first();
            if(!$order){
                $order =new Order();
                $order->order_status='temp';
                $order->search_key=$cookie;
            }
            $order->user_id=Auth::check()?$user->id:null;
            $order->name=$r->name;
            $order->mobile=$r->mobile;
            $order->email=$r->email;
            $order->district=$r->district;
            $order->city=$r->city;
            $order->address=$r->address;
            $order->postal_code=$r->postal_code;
            $order->note=$r->note;
            $order->order_status='pending';
            $order->pending_at=Carbon::now();
            $order->pending_by=Auth::check()?$user->id:null;
            $order->created_at=Carbon::now();
            $order->save();
            $order->invoice=$order->created_at->format('Ymd').$order->id;
            $order->save();

            foreach($myCarts['carts'] as $cart){
                $item =OrderItem::where('order_id',$order->id)->where('product_id',$cart->product_id)->first();
                if(!$item){
                    $item = new OrderItem;
                    $item->order_id = $order->id;
                    $item->product_id = $cart->product_id;
                }
                $item->user_id = Auth::check()?$user->id:null;
                $item->invoice = $order->invoice;
                $item->product_name = $cart->product?$cart->product->name:null;
                $item->color = $cart->color;
                $item->size = $cart->size;
                $item->quantity = $cart->quantity;
                if($product =$cart->product){
                    if($product->variation_status){
                        
                    }else{
                        if($product->quantity > $item->quantity){
                            $product->quantity-=$item->quantity;
                            $product->sell_count+=1;
                            $product->save();
                        }
                    }
                }
                $item->price = $cart->itemprice();
                $item->total_price = $cart->subtotal();
                $item->final_price = $cart->subtotal()-$item->total_deal_discount;
                $item->pending_at = Carbon::now();
                $item->pending_by = Auth::check()?$user->id:null;
                $item->addedby_id = Auth::check()?$user->id:null;
                $item->status=$order->order_status;
                $item->order_status=$order->order_status;
                $item->save();

                // $cart->delete();
            }
            
            Cart::where('cookie', $cookie)->delete();

            if($r->filled('shipping_charge') && is_numeric($r->shipping_charge)){
                // Flat-rate delivery option chosen in the checkout modal
                $shippingCharge = (float) $r->shipping_charge;
                $cartTotalPrice = $order->items->sum('final_price');
                if(general()->minimum_shopping > 0 && $cartTotalPrice >= general()->minimum_shopping){
                    $shippingCharge = 0;
                }
            }elseif($order->district==73){
                $datas = general()->outside_metro_area;
                $dataArray = array_filter(explode(',', $datas));
                if(in_array($order->city?:0, $dataArray)){
                    $shippingCharge =general()->outside_metro_charge;
                }else{
                    $shippingCharge =general()->inside_dhaka_shipping_charge;
                    $cartTotalPrice =$order->items->sum('final_price');
                    if(general()->minimum_shopping > 0 && $cartTotalPrice >= general()->minimum_shopping){
                        $shippingCharge =0;
                    }
                }

            }else{
                $shippingCharge =general()->outside_dhaka_shipping_charge;
            }
            
            $order->coupon_discount=$couponDisc;
            Session::forget('my_coupon_id');
            $order->shipping_charge =$shippingCharge;
            $order->total_price=$order->items->sum('final_price');
            $order->tax=($order->total_price*general()->tax)/100;
            $order->grand_total =$order->total_price + $order->shipping_charge + $order->tax - $order->coupon_discount;
            $order->paid_amount=0;
            $order->payment_method=$r->payment_option;
            $order->due_amount=$order->grand_total;
            $order->save();
            
            //**********Send Mail***************//

            if(general()->mail_status && $order->email){
                //Mail Data
                $datas =array('user'=>$order);
                $template ='mails.InvoiceMail';
                $toEmail =$order->email;
                $toName =$order->name;
                $subject ='Success, Order Successfully Submitted' .general()->title;
            
             sendMail($toEmail,$toName,$subject,$datas,$template);
            }
            //**********Send Mail***************//
            // Storing a single value
            session(['purchases' => 'yes']);
            return redirect()->route('invoiceView',$order->invoice)->with('success', 'Order successfully submitted');

        }
        $isDhaka=null;
	    if($r->ajax() && ($r->areaId || $r->cityId)){
	        
	        $aresId =$r->areaId;
	        if($r->cityId){
	           $aresId =$r->cityId; 
	        }
	        
	        $datas=Country::where('parent_id',$aresId?:'0000')->orderBy('name')->get();
            $geoData =View('geofilter',compact('datas'))->render();

            $cartTotalPrice =$myCarts['cartTotalPrice'];
            
            $shippingCharge =0;
            $couponDisc =$myCarts['couponDisc'];
            if($r->areaId && $r->areaId==73 && $r->cityId){
                $datas = general()->outside_metro_area;
                $dataArray = array_filter(explode(',', $datas));
                if(in_array($aresId, $dataArray)){
                    $shippingCharge =general()->outside_metro_charge;
                }else{
                    $shippingCharge =general()->inside_dhaka_shipping_charge;

                    if(general()->minimum_shopping > 0 && $cartTotalPrice >= general()->minimum_shopping){
                        $shippingCharge =0;
                    }
                }
                
                $isDhaka='yes';
            }else{
               if($aresId==73){
                    $shippingCharge =general()->inside_dhaka_shipping_charge;
                    $isDhaka='yes';
                }else{
                    $shippingCharge =general()->outside_dhaka_shipping_charge;
                    $isDhaka='no';
                } 
            }
            
            $cartTax =0;
                
            if(general()->tax_status==1){
              $cartTax =  ($cartTotalPrice*general()->tax)/100;
            }

            $grandTotal = $cartTotalPrice+$shippingCharge+$cartTax - $couponDisc;

	        $view  =View(welcomeTheme().'carts.includes.orderSummery',compact('carts','grandTotal','cartTax','cartTotalPrice','shippingCharge','couponDisc','isDhaka'))->render();
	        $view2  =View(welcomeTheme().'carts.includes.orderSummery2',compact('carts','grandTotal','cartTax','cartTotalPrice','shippingCharge','couponDisc','isDhaka'))->render();
	        return Response()->json([
              'success' => true,
              'view' => $view,
              'view2' => $view2,
              'cartTax' => $cartTax,
              'geoData' => $geoData,
            ]);
	    }

    	return view(welcomeTheme().'carts.checkout',compact('user','isDhaka'));
    }
    
    public function invoiceView($invoice){
        
        $order = Order::where('order_type','customer_order')->where('invoice',$invoice)->first();
        $purchases =session('purchases')?:null;
        Session::forget('purchases');
       return view(welcomeTheme().'carts.cartInvoice',compact('order','purchases'));
    }

    public function orderPayment($id){

        $order =Order::find($id);

        if(!$order){
            Session::flash('error','This Order Invoic Are Not Found');
            return redirect()->route('customer.myOrders');
        }
        $active='';
        $general =General::first();

        if($general->online_payment){
            $active ='handcash_payment';
        }elseif($general->wallet_payment){
            $active ='wallet_payment';
        }else{
            $active ='online_payment';
        }
        
        //Mail Send / SMS Send
        
        //**********Send Mail***************//
        
        if($general->mail_status && $order->email){

            Mail::to($order->email)->send(new orderInvoiceMail($order));
            
        }
        
        //**********Send Mail***************//
        
         //**********Send SMS ***************//
            if($general->sms_status){
        
                //Send SMS User
                if($general->order_place_sms_customer && $order->mobile){
                    
                    $m =$order->mobile;
                    
                    $to =bdMobile($m);
                    
                    if(strlen($to) != 13)
                    {
                        return true;
                    }
                    $msg = urlencode("Your order #{$order->invoice} is Successfully Place in {$general->title}. Total Invoice Cost is {$general->currency} {$order->grand_total}."); //150 characters allowed here
        
                    $url = smsUrl($to,$msg);
                
                    $client = new Client();
                    
                    try {
                            $r = $client->request('GET', $url);
                        } catch (\GuzzleHttp\Exception\ConnectException $e) {
                        } catch (\GuzzleHttp\Exception\ClientException $e) {
                        }
                    
                    
                }
                
                //Send SMS Vendor User
                if($general->order_place_sms_vendor){
                    
                    foreach($order->items as $item){
                        
                        if($item->seller){
                            
                            if($item->seller->user){
                                
                                if($item->seller->user->mobile){
                                    
                                    $m =$item->seller->user->mobile;
                    
                                    $to =bdMobile($m);
                                    
                                    if(strlen($to) != 13)
                                    {
                                        return true;
                                    }
                                    $msg = urlencode("Your Product New order #{$order->invoice} is Successfully Place in {$general->title}. Total Cost is {$general->currency} {$item->seller_paid}."); //150 characters allowed here
                        
                                    $url = smsUrl($to,$msg);
                                
                                    $client = new Client();
                                    
                                    try {
                                            $r = $client->request('GET', $url);
                                        } catch (\GuzzleHttp\Exception\ConnectException $e) {
                                        } catch (\GuzzleHttp\Exception\ClientException $e) {
                                        }
                                    
                                }
                                
                                
                            }
                            
                        }
                        
                    }
                    
                }
                
                //Send SMS Admin
                if($general->order_place_sms_admin && $general->admin_numbers){
                    
                    $to =$general->admin_numbers;

                    $msg = urlencode("New Order in {$general->title}. Invoice: {$order->invoice}, Total Cost: {$order->grand_total}."); //150 characters allowed here
        
                    $url = smsUrl($to,$msg);
                
                    $client = new Client();
                    
                    try {
                            $r = $client->request('GET', $url);
                        } catch (\GuzzleHttp\Exception\ConnectException $e) {
                        } catch (\GuzzleHttp\Exception\ClientException $e) {
                        }
                }
                
                
                
            }
            
        //**********Send SMS ***************//
        

        return view(welcomeTheme().'carts.orderPayment',compact('order','active'));
    }
    
    public function orderPaymentSend($type,$id){
         $order =Order::find($id);

        if(!$order){
            Session::flash('error','This Order Invoic Are Not Found');
            return redirect()->route('customer.myOrders');
        }
        $general =General::first();
        $user =Auth::user();
        
        if($type=='wallet'){
            
            if($order->due_amount > $user->balance){
                Session::flash('error','Your Wallet Balance Are Not available.Please Re-charge.');
                return redirect()->route('customer.myOrders');
            }
            
            $balance =new Transaction();
            $balance->type=0;
            $balance->order_id=$order->id;
            $balance->user_id=$user->id;
            $balance->billing_name=$order->name;
            $balance->billing_mobile=$order->mobile;
            $balance->billing_email=$order->email;
            $balance->billing_address=$order->address;
            $balance->billing_note='Customer pay bill by wallet method.';
            $balance->transection_id=mt_rand(100000,999999).'TSBD'.$order->id;
            $balance->payment_method='wallet';
            $balance->amount=$order->due_amount;
            $balance->currency=$general->currency;
            $balance->status='success';
            $balance->addedby_id=Auth::id();
            $balance->save();

            $general->balance+=$balance->amount;
            $general->save();

            $user->balance -=$balance->amount;
            $user->save();

            $order->paid_amount +=$balance->amount;

            if($order->paid_amount >=$order->grand_total){
            $order->extra_amount=$order->paid_amount - $order->grand_total;
            $order->due_amount=0;
            
            }else{
            $order->extra_amount=0;
            $order->due_amount=$order->grand_total-$order->paid_amount;
            }
            
            if($order->due_amount==0){
            $order->payment_status='paid';
            }elseif($order->due_amount==$order->grand_total){
            $order->payment_status='unpaid';
            }else{
            $order->payment_status='partial';
            }

            $order->payment_method='wallet';
            $order->save();
            
            foreach($order->items as $item){
                $item->payment_status=$order->payment_status;
                $item->save();
            }
            
            //send SMS
            
            //Send Mail
            
            Session::flash('success','You Order Is Successfully Place. Thank You for Shopping!');
            return redirect()->route('customer.orderDetails',$order->id);
             
        }else if($type=='handcash'){
            
            $order->payment_method='Cash On Delivery';
            $order->save();
            
            Session::flash('success','You Order Is Successfully Place. Thank You for Shopping!');
            return redirect()->route('customer.orderDetails',$order->id);
            
        }else{
            
             Session::flash('error','Worng Paydment Method is not Allow');
            return redirect()->route('customer.myOrders');
        }
    }

    public function selectDeliveryArea(Request $r,$id){

    	if($r->ajax())
        {

	    	$cookie = $r->cookie('carts');

	    	if($cookie)
	    	{
    			$general =General::first();
    			$carts = Cart::where('cookie', $cookie)->select(['id','product_id', 'quantity','color','size'])->latest()->paginate(500);
    			
    			$deliveryCharge =0;
        	    $deliveryChargeIn =(int)($general->indhaka_charge?:0);
        	    $deliveryChargeOut =(int)($general->outofdhaka_charge?:0);
        	    $dhaka=0;
        	    
        	    foreach($carts as $cart){
        	        $productShippingIn =$cart->product?$cart->product->shipping_cost:0;
                    $deliveryChargeIn += $cart->quantity*$productShippingIn;
                    
                    $productShippingOut =$cart->product?$cart->product->shipping_cost2:0;
                    $deliveryChargeOut += $cart->quantity*$productShippingOut;
                    
        	    }
        	    
        	    if($id==15){
            		$dhaka =1;
            		$deliveryCharge =$deliveryChargeIn;
            	}elseif($id==0 || $id==null){
            	   $dhaka=0;
            	}else{
            	    $dhaka =2;
            	    $deliveryCharge =$deliveryChargeOut;
            	}
    			
	    		
	    		$datas=Country::where('parent_id',$id)->get();
	    		$geoData = View('geofilter',compact('datas'))->render();


		    	$cartTotalPrice = 0;
		    	$couponDisc = 0;

		    	foreach ($carts as $cart) 
                {
                    
                    $cartTotalPrice += $cart->subtotal();

                }

                if ($mci = Session::get('my_coupon_id')) 
                {
                    $mc = Coupon::where('id',$mci)->first();

                    if($mc)
                    {
                      $couponDisc = $cartTotalPrice * ($mc->discount / 100);
                    }
                }

                $grandTotal = $cartTotalPrice - $couponDisc;

		    	$cartSummery =view(welcomeTheme().'carts.includes.orderSummery',compact('carts','cartTotalPrice','grandTotal','couponDisc','dhaka','deliveryCharge','deliveryChargeIn','deliveryChargeOut'))->render();

    			return Response()->json([
			            'success' => true,
			            'geoData' =>$geoData,
			            'cartSummery' => $cartSummery,
			            'grandTotal' => $grandTotal+$deliveryCharge,
			          ]);

    		}



    	}


    }

    public function wishlistCompareUpdate(Request $r,$id,$action)
	{   
        $product =Post::find($id);
        if(!$product){
            return abort(404);
        }
		$cookie = $r->cookie('carts');
        if(!$cookie){
            return redirect()->route('index');
        }

        if($action=='wishlist'){
            $statusType =0;
            $overCount =48;
        }else{
            $statusType =1;
            $overCount =20;
        }
					
        $oldData = WishList::where('cookie', $cookie)->where('type',$statusType)->where('product_id', $product->id)->first();
        if($oldData){
            $oldData->delete();
            $status =false;
            $alert=false;
        }else{
            $totalCount =WishList::where('cookie',$cookie)->where('type',$statusType)->count();
            if($overCount > $totalCount){
                $data = new WishList;
                $data->user_id = Auth::id();
                $data->product_id = $product->id;
                $data->cookie = $cookie;
                $data->type =$statusType;
                $data->save();
                $status =true;
                $alert=false;
            }else{
                $status =false;
                $alert=true;
            }
        }

        if($action=='wishlist'){
            $wlCount =WishList::where('cookie',$cookie)->where('type',$statusType)->count();
            
            $products = Post::whereHas('wishlists',function($qq)use($cookie){
                $qq->where('cookie',$cookie);
            })->paginate(48);

            $itemsView = view(welcomeTheme().'carts.includes.wishlistItems',compact('products','wlCount'))->render();

        }else{
            
            $cpCount =WishList::where('cookie',$cookie)->where('type',$statusType)->count();

            $products = Post::whereHas('comparelists',function($qq)use($cookie){
                $qq->where('cookie', $cookie);
            })->paginate(20);

            $itemsView = view(welcomeTheme().'carts.includes.compareItems',compact('products','cpCount'))->render();
        }

        if($r->ajax()){

            return Response()->json([
                'success' => true,	
                'status' => $status,
                'alert' => $alert,
                'statusType' => $statusType,
                'count' => WishList::where('cookie',$cookie)->where('type',$statusType)->count(),		        
                'itemsView' => $itemsView,	        
            ]);
            
        }else{

            return back()->with('success', 'Your Action successfully Done');;
        }


		
	}

	public function myWishlist(Request $r){

			$products = Post::whereHas('wishlists',function($qq){
			 		$qq->where('cookie', Cookie::get('carts'));
			 	})->paginate(24);

			return view(welcomeTheme().'carts.myWishlist',compact('products'));
	}

	public function myCompare(Request $r){
        $cookie = $r->cookie('carts');
        if(!$cookie){
            return redirect()->route('index');
        }
        $products =Post::whereHas('comparelists',function($qq)use($cookie){
            $qq->where('cookie', $cookie);
        })->paginate(20);

		return view(welcomeTheme().'carts.myCompare',compact('products'));
	}
	
	public function OrderTrack(Request $r){
	   // return $r;
	   $order =Order::latest()->where('invoice',$r->invoice)->first();
	   
	    return view(welcomeTheme().'carts.orderTrack',compact('r','order'));
	}

    public function orderNow(Request $r,$id){
        $product =Post::find($id);
        if(!$product){
            Session::flash('error','Product Not Found');
            return redirect()->route('index');
        }
        $check = $r->validate([
            'name' => 'required|max:100',
            'email' => 'nullable|max:100',
            'transection' => 'nullable|max:100',
            'payment_method' => 'required|max:100',
            'mobile' => 'required|numeric',
            'address' => 'required|max:500',
        ]);

        if(!$check){
            return back();
        }
        
        $user =Auth::user();
        
        $order =new Order();
       $order->save();
       $order->invoice=$order->created_at->format('ymd').$order->id;
       $order->user_id=$user?$user->id:null;
       $order->name=$r->name;
       $order->mobile=$r->mobile;
       $order->email=$r->email;
       $order->address=$r->address;
      
       $addr =$order->address;

       $order->full_address=$addr;
       
       $order->order_status='pending';
       $order->pending_at=Carbon::now();
       $order->pending_by=$user?$user->id:null;
       $order->save();

            $item = new OrderItem;
      		$item->order_id = $order->id;
            $item->user_id = $user?$user->id:null;
            $item->invoice = $order->invoice;
            $item->seller_id = $product->seller_id;
            $item->product_id = $product->id;
            $item->product_name = $product->title;
            $item->quantity = 1;

            if($product->price_variation){
                
            }else{
                if($product->quantity > $item->quantity){
                    $product->quantity-=$item->quantity;
                    $product->sell_count+=1;
                    $product->save();
                }
            }

            $item->price = $product->final_price;
            $item->total_price = $product->final_price;
        
            $item->final_price = $product->final_price;
            $item->pending_at = Carbon::now();
            $item->pending_by =null;
            $item->addedby_id =null;
            $item->status='pending';
            $item->order_status='pending';
            $item->seller_paid=$item->final_price;
            
            $key =$order->invoice;
            if($order->name){
            $key.=' '.$order->name;
            }
            if($order->mobile){
            $key.=' '.$order->mobile;
      	    }
      	    if($order->email){
            $key.=' '.$order->email;
            }
            $item->seller_paid=$item->final_price;
            $item->search_key=$key;
            $item->save();

        $general =General::first();

        $order->total_price=$item->final_price;
        $order->grand_total =$item->final_price;
        $order->paid_amount=0;
        $order->payment_method=$r->payment_method;
        $order->transection=$r->transection;
        $order->due_amount=$order->grand_total;
        $order->save();
        
        // $order =new ProductSize();
        // $order->product_id=$product->id;
        // $order->title=$r->name;
        // $order->email=$r->email;
        // $order->mobile=$r->mobile;
        // $order->address=$r->address;
        // $order->transection=$r->transection;
        // $order->addedby_id=0;
        // $order->save();
        Session::flash('success','Your Order is Success. We are contact as soon as possible.');
        return redirect()->back();
    }













}
