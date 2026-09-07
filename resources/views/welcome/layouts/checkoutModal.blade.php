<style>
/* Modal Bottom to Top Animation */
.modal.fade .modal-dialog {
    transform: translate(0, 100%);
    transition: transform 0.3s ease-out;
}

.modal.show .modal-dialog {
    transform: translate(0, 0);
}


  /* Base Modal Styling */
  .modal-body {
    background-color: #fdfbf7;
    padding: 25px;
    font-family: Arial, sans-serif;
    color: #333;
    border-radius: 12px;
  }

  /* Two Column Grid Layout */
  .checkout-grid-container {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
  }

  @media (max-width: 768px) {
    .checkout-grid-container {
      grid-template-columns: 1fr;
    }
  }

  /* Section Box Card Styles */
  .card-box {
    background: #ffffff;
    border-radius: 10px;
    padding: 20px;
    margin-bottom: 20px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    border: 1px solid #eaeaea;
  }

  /* Input Styling */
  .modal-body .form-control {
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    padding: 10px 14px;
    font-size: 14px;
    box-shadow: none;
  }

  .modal-body .input-group-text {
    background-color: #f8f9fa;
    border: 1px solid #e0e0e0;
    border-radius: 8px 0 0 8px;
    color: #666;
  }

  .modal-body label.col-form-label {
    font-weight: 600;
    color: #444;
    padding-bottom: 4px;
    font-size: 14px;
  }

  /* Cart List Styles */
  .cartItemsList ul {
    list-style: none;
    padding: 0;
    margin: 0;
  }

  .cartItemsList li {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 12px 0;
    border-bottom: 1px solid #eee;
  }

  .cartItemsList .title {
    font-weight: 600;
    font-size: 14px;
    flex-grow: 1;
    margin-left: 15px;
  }

  .cartItemsList .price {
    font-weight: 700;
    color: #111;
  }

  /* Coupon Section */
  .discountApply .input-group {
    display: flex;
    border-radius: 8px;
    overflow: hidden;
  }

  .discountApply .apply {
    background: #672678 !important;
    font-weight: bold;
    display: flex;
    align-items: center;
  }

  /* Submit Button */
  .orderModal {
    background-color: #672678 ;
    color: #ffffff !important;
    font-weight: bold;
    font-size: 18px;
    width: 100%;
    padding: 14px;
    border-radius: 8px;
    border: none;
    transition: background 0.3s;
  }

  .orderModal:hover {
    background-color: #b07f20 !important;
  }

  .checkout-footer-note {
    font-size: 13px;
    color: #666;
    margin-top: 8px;
  }
  
  
  
  
  
  
  
  
  .delivery-options-container {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.delivery-option {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 12px 16px;
    border: 1px solid #e0e0e0;
    border-radius: 12px;
    background-color: #ffffff;
    cursor: pointer;
    transition: all 0.2s ease-in-out;
}

/* রেডিও বাটন হাইড করে কাস্টম লুক দেওয়া */
.delivery-option input[type="radio"] {
    display: none;
}

.custom-radio {
    width: 16px;
    height: 16px;
    border: 2px solid #ccc;
    border-radius: 50%;
    margin-right: 12px;
    position: relative;
    box-sizing: border-box;
}

/* সিলেক্টেড বর্ডার ও ব্যাকগ্রাউন্ড স্টাইল */
.delivery-option input[type="radio"]:checked + .custom-radio {
    border-color: #1a4d2e;
}

.delivery-option input[type="radio"]:checked + .custom-radio::after {
    content: '';
    width: 10px;
    height: 10px;
    background-color: #1a4d2e;
    border-radius: 50%;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}

.delivery-option:has(input[type="radio"]:checked) {
    border-color: #c9b082;
    background-color: #fcfbf7;
}

.option-title {
    flex-grow: 1;
    font-weight: 600;
    color: #111;
        font-size: 12px;
}

.option-price {
    font-weight: 700;
    color: #1a4d2e;
        font-size: 12px;
}
  
.deleiveryAria {
    background: #ffffff;
    border-radius: 10px;
    padding: 20px;
    margin-bottom: 20px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    border: 1px solid #eaeaea;
}
  
  
  
/* কন্টেইনার কাড */
.cart-card-box {
    background: #ffffff;
    border: 1px solid #ebebeb;
    border-radius: 16px;
    padding: 16px 20px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.02);
    margin-bottom: 20px;
}

/* হেডার */
.cart-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-bottom: 12px;
}

.cart-title {
    margin: 0;
    font-size: 18px;
    font-weight: 700;
    color: #1b3b2b; /* স্ক্রিনশটের ডার্ক গ্রিন কালার */
}

.total-badge {
    background-color: #eaf2ed;
    color: #1b3b2b;
    font-weight: 700;
    font-size: 14px;
    padding: 3px 12px;
    border-radius: 20px;
}

/* আইটেম রো */
.cart-body {
    border-top: 1px solid #f2f2f2;
}

.cart-item {
    display: flex;
    align-items: center;
    padding: 16px 0;
    border-bottom: 1px solid #f2f2f2;
}

.product-thumb {
    width: 50px;
    height: 55px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 15px;
}

.product-thumb img {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
}

.product-info {
    flex-grow: 1;
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.product-title {
    margin: 0;
    font-size: 15px;
    font-weight: 700;
    color: #1b3b2b;
}

.product-price {
    font-size: 14px;
    color: #8c8c8c;
    font-weight: 500;
}

/* প্লাস-মাইনাস কন্ট্রোলার */
.quantity-box {
    display: flex;
    align-items: center;
    gap: 12px;
}

.qty-btn {
    width: 32px;
    height: 32px;
    background: #ffffff;
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    color: #757575;
    font-size: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.2s;
}

.qty-btn:hover {
    border-color: #1b3b2b;
    color: #1b3b2b;
}

.qty-count {
    font-size: 15px;
    font-weight: 700;
    color: #1b3b2b;
    min-width: 12px;
    text-align: center;
}

/* ফুটার সাবটোটাল */
.cart-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-top: 16px;
}

.subtotal-title {
    font-size: 15px;
    color: #8c8c8c;
    font-weight: 600;
}

.subtotal-price {
    font-size: 16px;
    font-weight: 700;
    color: #1b3b2b;
}
  
  
  
  
  
  
  @media only screen and (max-width: 767px) {
    .modal-body {
        padding: 10px;
    }
    .modal-title {
        font-size: 15px;
    }
    .product-title {
    margin: 0;
    font-size: 11px;
    }
    .product-thumb {
        min-width: 45px;
        height: 45px;
        margin-right: 10px;
    }
    .quantity-box {
        gap: 6px;
    }
    .card-box h5 {
        font-size: 15px;
    }
    .card-box {
        padding: 14px;
    }
    
    
}
        
      
  
  
  
  
  
  
</style>

@isset($carts)
@if($carts->count() > 0)

<script>
    function beginCheckout(){
        window.dataLayer = window.dataLayer || [];
        dataLayer.push({
            event: "begin_checkout",
            ecommerce: {
                currency: "{{ general()->currency }}",
                value: {{ round($cartTotalPrice)}},
                shipping: {{ round($shippingCharge ?? 0) }},
                discount: {{ round($couponDisc ?? 0) }},
                items: [
                    @foreach($carts as $item)
                    {
                        @if($product =$item->product)
                        item_id: "{{ $item->id }}",
                        item_name: "{{ $product->name }}",
                        item_category: "{!! implode(' - ', $product->productCategories->pluck('name')->toArray()) !!}",
                        item_brand: "{{ $product->brand ? $product->brand->name : '' }}",
                        price: "{{ $product->offerPrice() }}",
                        quantity: "{{ $item->quantity }}",
                    
                        @endif
                    }@if(!$loop->last),@endif
                    @endforeach
                ]
            }
        });
    }
</script>


<!-- Modal -->
{{--<div class="modal fade" id="exampleModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" style="width:100%;text-align: center;">
           Place Order Cash on Delivery
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p style="font-size:22px;text-align:center;">
            Billing Details
        </p>
        <form class="checkout-form2" action="{{route('checkout')}}" method="post">
        @csrf
        <div class="">
            <div class="row">
                <label for="staticEmail" class="col-md-12 col-12 col-form-label">
                    Your name
                </label>
                <div class="col-md-12 col-12">
                    <div class="input-group mb-3">
                      <span class="input-group-text" >
                          <i class="fa fa-user"></i>
                      </span>
                      <input type="text" class="form-control valuecheck3" 
                      
                      value="{{ optional(Auth::user())->name ?? '' }}"
                      
                      name="name" 
                      required=""
                      placeholder="Your name"
                      >
                    </div>
                </div>
            </div>
            <div class="row">
                <label for="staticEmail" class="col-md-12 col-12 col-form-label">
                    Your Mobile
                </label>
                <div class="col-md-12 col-12">
                    <div class="input-group mb-3">
                      <span class="input-group-text" >
                          <i class="fa fa-phone"></i>
                      </span>
                      <input type="text" class="form-control valuecheck3 mobileNumberInput2" 
                      value="{{ optional(Auth::user())->mobile ?? '' }}" 
                      name="mobile" 
                      required=""
                      placeholder="Mobile number"
                      >
                    </div>
                </div>
            </div>
            <div class="row">
                <label for="staticEmail" class="col-md-12 col-12 col-form-label" >
                    District/City
                </label>
                <div class="col-md-12 col-12">
                    <div class="input-group mb-3">
                      <span class="input-group-text" >
                          <i class="fa fa-map"></i>
                      </span>
                      <select class="form-control" name="district" id="district2" required>
                            <option value="">Select District</option>
                            @foreach(geoData(3) as $data)
                            <option value="{{$data->id}}" >{{$data->name}}</option>
                            @endforeach
                      </select>
                      <select class="form-control" name="city" id="city2" required>
                          <option value="">Select City</option>
                      </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <label for="staticEmail" class="col-md-12 col-12 col-form-label">
                    Address
                </label>
                <div class="col-md-12 col-12">
                    <div class="input-group mb-3">
                      <span class="input-group-text">
                          <i class="fa fa-map"></i>
                      </span>
                      <input type="text" class="form-control valuecheck3"  name="address" 
                      value="{{ optional(Auth::user())->address_line1 ?? '' }}"
                      required=""
                      placeholder="Address"
                      >
                    </div>
                    <input type="hidden" name="payment_option" value="handCash">
                </div>
            </div>
            <div class="row">
                <label for="staticEmail" class="col-md-12 col-12  col-form-label">
                    Order Note
                </label>
                <div class="col-md-12 col-12">
                    <div class="input-group mb-3">
                      <span class="input-group-text">
                          <i class="fa fa-edit"></i>
                      </span>
                      <input type="text" class="form-control valuecheck3"  name="note" 
                      value=""
                      placeholder="Order Note"
                      >
                    </div>
                </div>
            </div>
        </div>
        <div class="discountApply" style="margin-bottom:10px;">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Enter Coupon Code">
                <span class="apply" style="background: #F44336;padding: 10px 20px;color: white;cursor: pointer;">Apply</span>
            </div>
            <span class="couponErro"></span>
        </div>
        <h5 style="margin-bottom:10px;">
            Cart Item
        </h5>
        
        <div class="cartItemsList">
            <ul>
                @foreach($carts as $cart)
                <li>
                    @if($product=$cart->product)
                    <div style="position:relative;">
                        <img src="{{asset($product->image())}}" alt="{{$product->name}}">
                        <span style="position: absolute;width: 22px;height: 22px;background: #666;top: -10px;right: -10px;border-radius: 100%;text-align: center;color: white;font-size: 12px;display: flex;justify-content: center;align-items: center;">{{$cart->quantity}}</span>
                    </div>
                    <span class="title">{{$product->name}}</span>
                    @endif
                    <span class="price">{{priceFullFormat($cart->subtotal())}}</span>
                </li>
                @endforeach

            </ul>
        </div>
        <br>
        @php
        $isDhaka='yes';
        @endphp
        <div class="cartItemsTotal">
            @include(general()->theme.'.carts.includes.orderSummery2')
        </div>
        <div style="text-align:center;">

        <button class="btn orderModal" type="submit" >
           <i class="fa fa-shopping-cart"></i>
           Submit Your Order Confirm
       </button>
        
           @include(general()->theme.'.layouts.banglaNote')
        
        </div>
        </form>
      </div>



      
    </div>
  </div>
</div>--}}


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1">
  <!-- Large Modal class (modal-lg) added here -->
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" style="width:100%;text-align: left; font-weight:bold;">
           অর্ডার করুন - ক্যাশ অন ডেলিভারিতে
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <form class="checkout-form2" action="{{route('checkout')}}" method="post">
        @csrf

        <div class="checkout-grid-container">
            
            <!-- বাম পাশের কলাম: পণ্য, কুপন ও মোট হিসাব -->
            <div class="left-column">
                <!-- কার্ট আইটেম -->
                {{--<div class="card-box">
                    <h5 style="margin-bottom:15px; font-weight:bold; color:#222;">
                        আপনার পণ্য
                    </h5>
                    
                    <div class="cartItemsList">
                        <ul>
                            @foreach($carts as $cart)
                            <li>
                                @if($product=$cart->product)
                                <div style="position:relative;">
                                    <img src="{{asset($product->image())}}" alt="{{$product->name}}" style="width: 45px; height: 45px; border-radius: 6px; object-fit: cover;">
                                    <span style="position: absolute;width: 20px;height: 20px;background: #666;top: -6px;right: -6px;border-radius: 100%;text-align: center;color: white;font-size: 11px;display: flex;justify-content: center;align-items: center;">{{$cart->quantity}}</span>
                                </div>
                                <span class="title">{{$product->name}}</span>
                                @endif
                                <span class="price">{{priceFullFormat($cart->subtotal())}}</span>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>--}}
                
                <div class="cart-card-box">
    <!-- হেডার -->
    <div class="cart-header">
        <h5 class="cart-title">আপনার পণ্য</h5>
        <span class="total-badge">{{ $carts->sum('quantity') }} টি</span>
    </div>

    <!-- কার্ট আইটেম তালিকা -->
    <div class="cart-body">
        @foreach($carts as $cart)
            @if($product = $cart->product)
            <div class="cart-item">
                <div class="product-thumb">
                    <img src="{{ asset($product->image()) }}" alt="{{ $product->name }}">
                </div>
                
                <div class="product-info">
                    <h6 class="product-title">{{ $product->name }}</h6>
                    <span class="product-price">{{ priceFullFormat($cart->itemprice()) }}</span>
                </div>

                <div class="quantity-box">
                    <button type="button" class="qty-btn modalQtyBtn" data-url="{{ route('changeToCart', [$cart, 'decrement']) }}">-</button>
                    <span class="qty-count">{{ $cart->quantity }}</span>
                    <button type="button" class="qty-btn modalQtyBtn" data-url="{{ route('changeToCart', [$cart, 'increment']) }}">+</button>
                </div>
            </div>
            @endif
        @endforeach
    </div>

    <!-- সাবটোটাল ফুটার -->
    <div class="cart-footer">
        <span class="subtotal-title">পণ্যের সাবটোটাল</span>
        <span class="subtotal-price">{{ priceFullFormat($carts->sum(function($item){ return $item->subtotal(); })) }} </span>
    </div>
</div>
                
                

                <!-- কুপন কোড -->
                {{--<div class="card-box">
                    <div class="discountApply">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="কুপন কোড দিন">
                            <span class="apply" style="padding: 10px 20px; color: white; cursor: pointer;">আবেদন করুন</span>
                        </div>
                        <span class="couponErro"></span>
                    </div>
                </div>--}}
                
                <div class="deleiveryAria">
                <div class="row">
                <label class="col-md-12 col-12 col-form-label fw-bold mb-2">
                    ডেলিভারি
                </label>
                <div class="col-md-12 col-12">
                    <div class="delivery-options-container">
                        
                        <label class="delivery-option">
                            <input type="radio" name="shipping_charge" value="50" checked>
                            <span class="custom-radio"></span>
                            <span class="option-title">ঢাকা সিটির ভেতরে</span>
                            <span class="option-price">50 TK</span>
                        </label>
            
                        <label class="delivery-option">
                            <input type="radio" name="shipping_charge" value="80">
                            <span class="custom-radio"></span>
                            <span class="option-title">ঢাকা সিটির বাহিরে</span>
                            <span class="option-price">80 TK</span>
                        </label>
            
                        <label class="delivery-option">
                            <input type="radio" name="shipping_charge" value="100">
                            <span class="custom-radio"></span>
                            <span class="option-title">ঢাকা জেলার বাহিরে</span>
                            <span class="option-price">100 TK</span>
                        </label>
            
                    </div>
                </div>
            </div>
            </div>
                

             
            </div>

            <!-- ডান পাশের কলাম: কাস্টমার তথ্য ও ইনপুট ফর্ম -->
            <div class="right-column">
                <div class="card-box">
                    <h5 style="margin-bottom:15px; font-weight:bold; color:#222;">অর্ডার করতে নিচের তথ্যগুলি দিন</h5>
                    
                    <div class="row">
                        <label for="staticEmail" class="col-md-12 col-12 col-form-label">
                            আপনার নাম
                        </label>
                        <div class="col-md-12 col-12">
                            <div class="input-group mb-3">
                              <span class="input-group-text">
                                  <i class="fa fa-user"></i>
                              </span>
                              <input type="text" class="form-control valuecheck3" 
                              value="{{ optional(Auth::user())->name ?? '' }}"
                              name="name" 
                              required=""
                              placeholder="আপনার নাম"
                              >
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <label for="staticEmail" class="col-md-12 col-12 col-form-label">
                            মোবাইল নাম্বার
                        </label>
                        <div class="col-md-12 col-12">
                            <div class="input-group mb-3">
                              <span class="input-group-text">
                                  <i class="fa fa-phone"></i>
                              </span>
                              <input type="text" class="form-control valuecheck3 mobileNumberInput2" 
                              value="{{ optional(Auth::user())->mobile ?? '' }}" 
                              name="mobile" 
                              required=""
                              placeholder="১১ ডিজিট মোবাইল নাম্বার"
                              >
                            </div>
                        </div>
                    </div>

                    {{--<div class="row">
                        <label for="staticEmail" class="col-md-12 col-12 col-form-label">
                            জেলা / সিটি
                        </label>
                        <div class="col-md-12 col-12">
                            <div class="input-group mb-3">
                              <span class="input-group-text">
                                  <i class="fa fa-map"></i>
                              </span>
                              <select class="form-control" name="district" id="district2" required>
                                    <option value="">জেলা নির্বাচন করুন</option>
                                    @foreach(geoData(3) as $data)
                                    <option value="{{$data->id}}">{{$data->name}}</option>
                                    @endforeach
                              </select>
                              <select class="form-control" name="city" id="city2" required>
                                  <option value="">সিটি নির্বাচন করুন</option>
                              </select>
                            </div>
                        </div>
                    </div>--}}

                    <div class="row">
                        <label for="staticEmail" class="col-md-12 col-12 col-form-label">
                            সম্পূর্ণ ঠিকানা
                        </label>
                        <div class="col-md-12 col-12">
                            <div class="input-group mb-3">
                              <span class="input-group-text">
                                  <i class="fa fa-map"></i>
                              </span>
                              <input type="text" class="form-control valuecheck3" name="address" 
                              value="{{ optional(Auth::user())->address_line1 ?? '' }}"
                              required=""
                              placeholder="বাসা নম্বর, গ্রাম/মহল্লা, উপজেলা, জেলা"
                              >
                            </div>
                            <input type="hidden" name="payment_option" value="handCash">
                        </div>
                    </div>

                    <div class="row">
                        <label for="staticEmail" class="col-md-12 col-12 col-form-label">
                            অর্ডার নোট (অপশনাল)
                        </label>
                        <div class="col-md-12 col-12">
                            <div class="input-group mb-3">
                              <span class="input-group-text">
                                  <i class="fa fa-edit"></i>
                              </span>
                              <input type="text" class="form-control valuecheck3" name="note" 
                              value=""
                              placeholder="স্পেশাল কিছু বলতে চাইলে লিখুন"
                              >
                            </div>
                        </div>
                    </div>
                    
                       <!-- মোট খরচ বিবরণ -->
                <div class="card-box">
                    <h5 style="margin-bottom:15px; font-weight:bold; color:#222;">মূল্য বিবরণ</h5>
                    @php
                    $isDhaka='yes';
                    @endphp
                    <div class="cartItemsTotal">
                        @include(general()->theme.'.carts.includes.orderSummery2')
                    </div>
                </div>
                    

              

                </div>
            </div>
            
                 

        </div>
         <!-- সাবমিট বাটন কাস্টমার ফর্মে যুক্ত করা হলো -->
                    <div style="text-align:center; margin-top:10px; ">
                        <button class="btn orderModal" type="submit">
                           <i class="fa fa-shopping-cart"></i>
                           অর্ডার কনফার্ম করুন
                        </button>
                        <p class="checkout-footer-note">আমাদের একজন কাস্টমার প্রতিনিধি আপনাকে কল করে অর্ডার নিশ্চিত করবেন</p>
                    </div>
        </form>
      </div>      
    </div>
  </div>
</div>


<script>
    // Quantity +/- inside the checkout modal.
    // Bound once on document; the checkout partial can be re-injected via AJAX,
    // so guard against binding the delegated handler multiple times.
    if (!window.__modalQtyBound) {
        window.__modalQtyBound = true;

        $(document).on('click', '#exampleModal .modalQtyBtn', function () {
            var $btn = $(this);
            var url = $btn.attr('data-url');
            if (!url || $btn.prop('disabled')) { return; }

            var $modal = $('#exampleModal');
            $modal.find('.modalQtyBtn').prop('disabled', true);

            $.ajax({ url: url, method: 'GET' })
                .done(function (data) {
                    // global cart badge + right-side cart drawer
                    $('.cart-count').empty().append(data.cartCount);
                    $('.cartAreaSection').empty().append(data.cartItem);

                    // surgically refresh only the modal's dynamic parts so the
                    // open modal itself is never removed from the DOM
                    var $fresh = $('<div></div>').html(data.cartItem2 || '');
                    var $box = $fresh.find('.cart-card-box');
                    var $total = $fresh.find('.cartItemsTotal');

                    if ($box.length) {
                        $modal.find('.cart-card-box').replaceWith($box);
                    }
                    if ($total.length) {
                        $modal.find('.cartItemsTotal').replaceWith($total);
                    }
                })
                .always(function () {
                    $('#exampleModal .modalQtyBtn').prop('disabled', false);
                });
        });
    }
</script>

@endif
@endisset