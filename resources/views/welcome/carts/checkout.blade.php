@extends(welcomeTheme().'layouts.app') 
@section('title')
<title>{{websiteTitle('Checkout')}}</title>
@endsection 
@section('SEO')
<meta name="title" property="og:title" content="{{websiteTitle('Checkout')}}" />
<meta name="description" property="og:description" content="{!!general()->meta_description!!}" />
<meta name="keyword" property="og:keyword" content="{{general()->meta_keyword}}" />
<meta name="image" property="og:image" content="{{asset(general()->logo())}}" />
<meta name="url" property="og:url" content="{{route('checkout')}}" />
<link rel="canonical" href="{{route('checkout')}}">
@endsection 
@push('css')
<style>
.page-content {
    padding: 50px 0;
}
.order_review {
    padding: 20px;
    background-color: #cfd8d624;
}
.checkOut {
    padding: 30px;
    background-color: #f8f9f9;
    border: 1px solid lightgray;
}
.checkOut .form-control {
    border-radius: 0;
    margin: 10px 0 20px;
}
.text-right {
    text-align: right !important;
    padding: 5px;
}
.btn.disabled, .btn:disabled, fieldset:disabled .btn {
    border: 1px solid #ccc;
}
.heading_s1 {
    margin-bottom: 10px;
}
.order_review button {
    background-color: #118ec9;
    border: none;
    display: inline-block;
    margin-top: 20px;
    color: #fff;
    font-weight: bold;
    padding: 8px 33px;
}
.order_review button:hover {
    background-color: #0a577c;
    color: #fff;
}
.checkOut .form-control:focus {
    box-shadow: none;
}
</style>

<script>
    window.dataLayer = window.dataLayer || [];
    dataLayer.push({
        event: "page_view",
        page_category: "page",
        page_title: "Check Out",
        page_url: "{{route('checkout')}}"
    });
</script>

@endpush 

@section('contents')

<!-- Start of Page Header -->
<div class="page-header">
    <div class="overlayPageHeaderNew">
        <div class="container">
            <h1 class="page-title mb-0">Checkout</h1>
        </div>
    </div>
</div>
<!-- End of Page Header -->

<!-- START SECTION SHOP -->
<div class="page-content">
    <div class="container">
    @isset($carts)
    @if($carts->count() > 0)
    
    
    <script>
        window.dataLayer = window.dataLayer || [];
        dataLayer.push({
            event: "begin_checkout",
            ecommerce: {
                currency: "{{ general()->currency }}",
                value: {{round($cartTotalPrice)}},
                shipping: {{ round($shippingCharge ?? 0)}},
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
    </script>
    
    
    <form class="checkout-form" action="{{route('checkout')}}" method="post">
        @csrf
        <div class="row">
            <div class="col-lg-7 mb-4">
                <div class="checkOut">
                    <div class="heading_s1">
                        <h4 class="">Billing Details</h4>
                    </div>
                    <div class="form-group mb-3">
                        <label>Name</label>
                        <input type="text" required class="form-control valuecheck valuecheck2" name="name" placeholder="Enter Your name *">
                    </div>
                    <div class="form-group mb-3">
                        <label>Email</label>
                        <input class="form-control valuecheck valuecheck2" required type="text" name="email" placeholder="Email address *">
                    </div>
                    <div class="form-group mb-3">
                        <label>Phone</label>
                        <input class="form-control valuecheck valuecheck2 mobileNumberInput" required type="text" name="mobile" placeholder="Phone *">
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <div class="custom_select">
                                <select name="district" id="district" class="form-control valuecheck" required>
                                    <option value="">Select District*</option>
                                    @foreach(geoData(3) as $data)
                                    <option value="{{$data->id}}" >{{$data->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 form-group">
                            <div class="custom_select">
                                <select name="city" id="city" class="form-control valuecheck" required>
                                    <option value="">Select City*</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label>Address</label>
                        <input class="form-control valuecheck valuecheck2" required type="text" name="address" placeholder="Address line*">
                    </div>
                    <div class="heading_s1">
                        <h4>Additional information</h4>
                    </div>
                    <div class="form-group mb-0">
                        <textarea rows="5" class="form-control valuecheck2" name="note" placeholder="Order notes"></textarea>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 mb-4 sticky-sidebar-wrapper">
                <div class="order_review">
                    <div class="heading_s1">
                        <h4 class="">Your Orders</h4>
                    </div>
                    <div class="orderSummryTable">
                        @include(welcomeTheme().'carts.includes.orderSummery')
                    </div>
                    <button type="submit" id="placeOrderBtn" onclick="beginCheckout()" class="btn btn-fill-out btn-block" disabled >Place Order</button>
                </div>
            </div>
        </div>
    </form>
    </div>
    @else
    <div class="cart_empty">
        <i class="linearicons-cart"></i>
        <h4>Empty Cart</h4>
        <a href="{{route('index')}}" class="btn btn-fill-line rounded-0 view-cart">Shopping</a>
    </div>
    @endif
    @endisset
</div>
<!-- END SECTION SHOP -->


@endsection 

@push('js') 

<script>

    $(document).ready(function() {
      // Function to check if all input fields are filled
      function checkFields() {
        let allFilled = true;
        
        $('.valuecheck').each(function() {
          if ($(this).val() === '') {
            allFilled = false;
          }
        });
    
        // Enable or disable the button based on all fields being filled
        if (allFilled) {
          $('#placeOrderBtn').prop('disabled', false);
        } else {
          $('#placeOrderBtn').prop('disabled', true);
        }
      }
    
      // Check the fields on keyup event
      $('.valuecheck').on('keyup change', function() {
        checkFields();
      });
    
      // Initial check when the page loads
      checkFields();
    });

    $(document).ready(function(){
        
        $('.selectDateDelivery').change(function(date){
            var dateV =$(this).val();
            var lastDay =3;
            $( "#datepicker" ).datepicker({
            	minDate: +lastDay,
       			maxDate: "+30D"
            });
                
            if(dateV!=''){
                alert(dateV);
            }
                
        });
        
        $("#district").on("change", function(){
                var id = $(this).val();
              if(id==''){
               $('#city').empty().append('<option value="">No City</option>');
              }else{
                  var url = '{{url("/checkout")}}?areaId='+id;
                  $.get(url,function(data){
                    $('#city').empty().append(data.geoData);
                    $('.orderSummryTable').empty().append(data.view);
                  });  
              }
        });
        
        $("#city").on("change", function(){
                var area = $('#district').val();
                var id = $(this).val();
              if(id=='' || area==''){
              //$('#city').empty().append('<option value="">No City</option>');
              }else{
                  var url = '{{url("/checkout")}}?areaId='+area+'&cityId='+id;
                  $.get(url,function(data){
                    $('.orderSummryTable').empty().append(data.view);
                  });  
              }
        });
        
        let typingTimer;
        $(document).on('keyup','.valuecheck2',function(){
            clearTimeout(typingTimer);
            var url ="{{route('incompletedOrder')}}";
            var mobile =$('.mobileNumberInput').val();
            mobile = mobile.replace(/^\+88/, '');
            mobile = mobile.replace(/^88/, '');
            if(mobile.length ==11){
                typingTimer = setTimeout(function () {
                    var data =$(".checkout-form").serialize();
                    $.ajax({
                        url: url,
                        method: "GET",
                        data: data,
                        success: function (res) {
                            console.log(res);
                        }
                    });
                    
                }, 1000);
            }
        });
        
        
        
    });
</script>

@endpush