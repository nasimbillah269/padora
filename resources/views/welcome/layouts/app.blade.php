<!DOCTYPE html>
<html lang="en">
    <head>
        
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{csrf_token()}}" />
        <meta name="google-site-verification" content="J83tCwnluEL14Isb7yJlJT1VxKft8ZZmOO0ULHidFFA" />
        <meta name="facebook-domain-verification" content="2n23ndpkt8jdx0lrekp35jp7vsozcp" />
        @yield('title')
        <!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="{{asset(general()->favicon())}}" />
        @yield('SEO')
        
        <!-- Google Font CDN-->
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
        <style>
            :root { --pf-font: 'Hind Siliguri', ui-sans-serif, system-ui, -apple-system, 'Segoe UI', Roboto, 'Noto Sans Bengali', Arial, sans-serif; }
            body, p, a, span, li, div, td, th, label, blockquote, figcaption,
            h1, h2, h3, h4, h5, h6,
            input, select, textarea, button, .btn, .form-control {
                font-family: var(--pf-font);
            }
            body { -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale; }
        </style>
        <!-- Bootstrap CS CDN -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" />

        <!-- Font Awesome CSS CDN-->
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <!-- Slick Slider CSS CDN-->
        <link rel="stylesheet" type="text/css" href="{{asset('welcome/css/slick.css')}}" />
        <link rel="stylesheet" type="text/css" href="{{asset('welcome/css/slick-theme.css')}}" />
        <link rel="stylesheet" type="text/css" href="{{asset('welcome/css/jquery.fancybox.css')}}" />
        
        <!-- Start WOWSlider.com HEAD section -->
        <link rel="stylesheet" type="text/css" href="{{asset('welcome/wow/style.css')}}" />
        <script type="text/javascript" src="{{asset('welcome/wow/jquery.js')}}"></script>
        <!-- End WOWSlider.com HEAD section -->
        
        <!-- Matis Menus CSS -->
        <link rel="stylesheet" href="{{asset('welcome/css/metisMenu.css')}}" />
        
        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css" />
        <!-- Custom Css for this Design -->
        <link rel="stylesheet" href="{{asset('welcome/css/style-v1.1.css')}}" />
        <link rel="stylesheet" href="{{asset('welcome/css/pandoraStyle.css')}}" />
        
        <!-- Google Tag Manager -->
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-KRT53QGM');</script>
        <!-- End Google Tag Manager -->
        
        <noscript><img height="1" width="1" style="display:none"
        src="https://www.facebook.com/tr?id=1703670447056577&ev=PageView&noscript=1"
        /></noscript>
        <!-- End Meta Pixel Code -->
        

        <style>
            .load-more-overlay {
                width: 20px;
                height: 20px;
                border: 2px solid #2d5;
                border-bottom-color: transparent;
                border-radius: 50%;
                box-sizing: border-box;
                animation: rotation 1s linear infinite;
                display: none;
                position: absolute;
                left: 8px;
            }
            
            .load-more-overlay.loading {
                display:block;   
            }
        
            @keyframes rotation {
                0% {
                    transform: rotate(0deg);
                }
                100% {
                    transform: rotate(360deg);
                }
            } 
            
            .btn-cart {
                position: relative;
            }
            /*.ms a i {*/
            /*    background-color: #fff !important;*/
            /*    color: #000 !important;*/
            /*    font-size: 28px;*/
            /*}*/
            .ws_images {
                overflow: hidden !important;
            }





.floating-chat-wrapper {
        position: fixed;
        bottom: 25px;
        left: 25px;
        z-index: 9999;
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .chat-btn {
        position: relative;
        width: 55px;
        height: 55px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ffffff !important;
        font-size: 28px;
        text-decoration: none;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    /* WhatsApp Branding & Pulse Color */
    .whatsapp-btn {
        background-color: #25d366;
    }

    /* Messenger Branding & Gradient */
    .messenger-btn {
        background: radial-gradient(circle at 30% 107%, #fdf497 0%, #fdf497 5%, #ff53d4 45%, #6200ee 60%, #0084ff 90%);
    }

    /* Hover Scale Effect */
    .chat-btn:hover {
        transform: scale(1.12);
        color: #ffffff;
    }

    /* Continuous Pulse Animation */
    .btn-ripple {
        position: absolute;
        width: 100%;
        height: 100%;
        border-radius: 50%;
        top: 0;
        left: 0;
        z-index: -1;
        animation: chatPulse 2s infinite ease-out;
    }

    .whatsapp-btn .btn-ripple {
        background-color: rgba(37, 211, 102, 0.6);
    }

    .messenger-btn .btn-ripple {
        background-color: rgba(0, 132, 255, 0.6);
    }

    @keyframes chatPulse {
        0% {
            transform: scale(1);
            opacity: 0.8;
        }
        100% {
            transform: scale(1.6);
            opacity: 0;
        }
    }

    /* Mobile Responsive Adjustments */
    @media (max-width: 576px) {
        .floating-chat-wrapper {
            bottom: 135px;
            right: 15px;
            gap: 10px;
        }
        .chat-btn {
            width: 48px;
            height: 48px;
            font-size: 24px;
        }
        .logoDiv a img {
            max-height: 40px;
        }
        .category-title {
            font-size: 15px;
        }
        .headerAccount ul li a .cart-count {
        position: absolute;
        top: 14px;
        right: 46px;
        background: #582b68;
        width: 16px;
        height: 16px;
        color: #fff;
        text-align: center;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
    }
        
        
    }




.cartFooter {
    height: unset;
}




        </style>
        
        @stack('css')
        
    </head>
    
    <body>
            
        <!--Header Part Include Start-->
        @include(general()->theme.'.layouts.header')

        <!--Main Section Start-->
        @yield('contents')
        <!--Main Section End-->
        
        <!--Footer Part Include Start-->
        @include(general()->theme.'.layouts.footer')
        
        <div class="mobile-menu-side-modals side-modals left">
         <a href="javascript:void(0)" class="overlay side-modals-close"></a>
            <div class="cartAreaSection">
            @include(general()->theme.'.layouts.cartModal')
            </div>
        </div>
        
        <!-- Floating Social Chat Buttons -->
<div class="floating-chat-wrapper">
    <!-- Messenger Button -->
    <a href="https://m.me/yourusername" target="_blank" class="chat-btn messenger-btn shadow" title="Chat on Messenger">
        <i class="fa-brands fa-facebook-messenger"></i>
        <span class="btn-ripple"></span>
    </a>

    <!-- WhatsApp Button -->
    <a href="https://wa.me/8801313610173" target="_blank" class="chat-btn whatsapp-btn shadow" title="Chat on WhatsApp">
        <i class="fa-brands fa-whatsapp"></i>
        <span class="btn-ripple"></span>
    </a>
</div>
            
        <div class="cartAreaSection2">
        @include(general()->theme.'.layouts.checkoutModal')
        </div>
        
         <div class="mobileFixedFooter">
            <ul>
                <li>
                    <a href="{{route('index')}}">
                        <i class="fa fa-home"></i>
                        <span>Home</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fa fa-th" aria-hidden="true"></i>
                        <span>All Products</span>
                    </a>
                </li>
                <!--<li>-->
                <!--    @if(Auth::check())-->
                <!--    <a href="{{route('customer.dashboard')}}">-->
                <!--        <i class="fa fa-user"></i>-->
                <!--        <span>Login</span>-->
                <!--    </a>-->
                <!--    @else-->
                <!--    <a href="{{route('login')}}">-->
                <!--        <i class="fa fa-user"></i>-->
                <!--        <span>Login</span>-->
                <!--    </a>-->
                <!--    @endif-->
                <!--</li>-->
                <li>
                    <a href="javascript:void(0)" class="moble-menus-models">
                        <div>
                            <i class="fas fa-shopping-cart"></i>
                            <span class="cart-count">@isset($cartsCount){{$cartsCount}}@endisset</span>
                        </div>
                        <span>Cart</span>
                    </a>
                </li>
                <!--<li>-->
                <!--    <a href="{{route('myWishlist')}}">-->
                <!--        <div>-->
                <!--            <i class="fa fa-heart-o"></i>-->
                <!--            <span class="wish-count">0</span>-->
                <!--        </div>-->
                <!--        <span>Wishlist</span>-->
                <!--    </a>-->
                <!--</li>-->
                <li class="ms">
                    <a href="javascript:void(0)" onclick="openSearch()" >
                        
                        <i class="fa fa-search"></i>
                         <span>Search</span>
                        </a>
                </li>
                
            </ul>
        </div>
        
        <!-- Jquery Script  CDN-->
        <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-zoom/1.7.21/jquery.zoom.js"></script>
        
        <!-- Bootstrap Script  CDN-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

        <!-- Metis Menus Script -->
        <script src="{{asset('welcome/js/metisMenu.min.js')}}"></script>

        <!-- Sweet Alert CDN -->
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

        <!-- Slick slider CDN -->
        <script type="text/javascript" src="{{asset('welcome/js/slick.min.js')}}"></script>

        <!--iconify Script CDN-->
        <script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>

        <!-- Custom Script for this Design -->
        <script src="{{asset('welcome/js/myScript.js')}}"></script>
        
        <script type="text/javascript" src="{{asset('welcome/wow/wowslider.js')}}"></script>
        <script type="text/javascript" src="{{asset('welcome/wow/script.js')}}"></script>
        
        
        <script>
    $(document).ready(function(){
        $('.best-sellers-slider').slick({
            dots: false,
            infinite: true,
            speed: 300,
            slidesToShow: 4, // Extra Large Screens (Desktops 1200px+)
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 3000,
            prevArrow: $('.custom-prev'),
            nextArrow: $('.custom-next'),
            responsive: [
                {
                    breakpoint: 1200, // Standard Laptops & Small Desktops
                    settings: {
                        slidesToShow: 4,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 992, // Tablets (Landscape) & Small Laptops
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 768, // Tablets (Portrait) & Large Mobile Devices
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 480, // Small Mobile Phones
                    settings: {
                        slidesToShow: 2, // ২টির বদলে ১টি দেখাতে চাইলে এখানে 1 দিন
                        slidesToScroll: 1
                    }
                }
            ]
        });
    });
</script>
        
        <script>
              $(document).ready(function () {
                var quantitiy = 0;
                $("#increment").click(function (e) {
                  e.preventDefault();
                    var quantity = parseInt($("#quantity").val());
                    $("#quantity").val(quantity + 1);
                    weightCalculate(quantity);
                });
        
                $("#decrement").click(function (e) {
                  e.preventDefault();
                  var quantity = parseInt($("#quantity").val());
                  if (quantity > 1) {
                    $("#quantity").val(quantity - 1);
                  }
                    weightCalculate(quantity);
                });
                
                
                function weightCalculate(quantity){
                    var weight = parseFloat($('.NetWeight').data('weight'));
                    var ice = parseFloat($('.grossWeight').data('weight'));
                    
                    var newQuantity = quantity + 1;
                    
                    var grossWeight = ((weight + ice) * newQuantity).toFixed(2) + ' KG';
                    var netWeight = (weight * newQuantity).toFixed(2) + ' KG';
                    console.log(weight);
                    console.log(ice);
                    console.log(ice);
                    console.log(grossWeight);
                    $('.grossWeight').empty().append(grossWeight);
                    $('.NetWeight').empty().append(netWeight);
                }
                
                
              });
        </script>
        
        
        <script>
          $(document).ready(function(){
            $(".toggleButton").click(function(){
              // Hide all contents
              $(".toggle-content").slideUp();
              $(".toggleButton .icon").text("+");
        
              // Show clicked content if it's not already visible
              var content = $(this).next(".toggle-content");
              if(!content.is(":visible")) {
                content.slideDown();
                $(this).find(".icon").text("−");
              }
            });
          });
        </script>
        
        
        
        
        <script>
            $(document).ready(function(){
                
                $(document).on('click','.discountApply .apply',function(){
                    var code =$('.discountApply input').val();
                    var areaId =$('#district2').val();
                    var cityId =$('#city2').val();
                    if(code=='' || code=='undefined' || code==null){
                        $('.discountApply .couponErro').empty().append('<span style="color:red;">Input Coupon Code here..</span>');
                    }else{
                        
                        var url = "{{route('couponApply')}}";
                        
                        $.ajax({
                            url: url,
                            method: "POST",
                            data: {
                                coupon_code: code,
                                areaId: areaId,
                                cityId: cityId,
                                _token: "{{ csrf_token() }}" // Laravel CSRF token
                            },
                        })
                        .done(function (data) {
                            if(data.status=='success'){
                                $('.discountApply .couponErro').empty().append('<span style="color:green;">'+data.message+'</span>');
                                $('.cartItemsTotal').empty().append(data.view2);
                            }else{
                               $('.discountApply .couponErro').empty().append('<span style="color:red;">'+data.message+'</span>'); 
                            }
                            
                        })
                        .fail(function () {
                            //location.reload(true);
                        });
                        
                    }
                });
                
                $(document).on('keyup','.discountApply input',function(){
                    $('.discountApply .couponErro').empty();
                });
                
                $('.downMenus i').click(function(){
                    // $(this).parent().toggleClass('active');
                    const $li = $(this).parent();
                    const $ul = $li.parent().children('ul');
                    $li.toggleClass('active');
                    if ($li.hasClass('active')) {
                       $ul.slideDown();
                    } else {
                       $ul.slideUp();
                    }
                });
                
                
                 /** Mobile sidebar Menus  js **/
                $('.moble-menus-models').click(function(){
                  $('.mobile-menu-side-modals').addClass('open-side');
                  $("body").css('overflow-y','hidden');
                  viewCartDataCall();
                  
                });
                
                $('.moble-menus-models2').click(function(){
                  $('.mobile-menu-side-modals2').addClass('open-side');
                  $("body").css('overflow-y','hidden');
                  viewCartDataCall();
                  
                });
            
                $(document).on('click','.side-modals-close',function(){
                  $('.side-modals').removeClass('open-side');
                  $("body").css('overflow-y','');
                })
                /** Mobile sidebar Menus  js **/
                
                /** CSRF Token Header Set **/
                $.ajaxSetup({
            	    headers: {
            	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            	    }
            	});
            	
            	$(document).on("click", ".btn-wishlist", function () {
            	    var that =$(this);
                    var id = that.attr("data-id");
                    var url = that.attr("data-url");
                    $.ajax({
                        url: url,
                        method: "GET",
                        beforeSend: function() {
                            $(that).find('.load-more-overlay').addClass('loading');
                        },
                    })
                    .done(function (data) {
                        $(that).find('.load-more-overlay').removeClass('loading');
                        if(data.status){
                            $(that).addClass('active');
                        }else{
                            $(that).removeClass('active');
                        }
                        $(".wishlist-count").empty().append(data.count);
                        $('.mywishList').empty().append(data.itemsView);
                    })
                    .fail(function () {
                        $(that).find('.load-more-overlay').removeClass('loading');
                        //location.reload(true);
                    });

            	});
            	$(document).on("click", ".btn-cart", function () {
            	    var that =$(this);
                    var id = that.attr("data-id");
                    var url = that.attr("data-url");
                    
                    $.ajax({
                        url: url,
                        method: "GET",
                        beforeSend: function() {
                            $(that).find('.load-more-overlay').addClass('loading');
                        },
                    })
                    .done(function (data) {
                        $('.mobile-menu-side-modals').addClass('open-side');
                        $("body").css('overflow-y','hidden');
                        $(that).find('.load-more-overlay').removeClass('loading');
                        $(".cart-count").empty().append(data.cartCount);
                        $(".cartAreaSection").empty().append(data.cartItem);
                        $(".cartAreaSection2").empty().append(data.cartItem2);
                    })
                    .fail(function () {
                        $(that).find('.load-more-overlay').removeClass('loading');
                        // location.reload(true);
                    });
            	    
            	});
            	
            	$(document).on("click", ".orderModalAction", function () {
  
            	    beginCheckout();
            	});
            	
            	$(document).on("click", ".cartUpdate", function () {
            	    var that =$(this);
                    var url = that.attr("data-url");
                    $.ajax({
                        url: url,
                        method: "GET",
                    })
                    .done(function (data) {
                        $(".cart-count").empty().append(data.cartCount);
                        $('.cartItemsAll').empty().append(data.cartItems);
                        $(".cartAreaSection").empty().append(data.cartItem);
                        $(".cartAreaSection2").empty().append(data.cartItem2);
                    })
                    .fail(function () {
                       // location.reload(true);
                    });
            	});
            	
            	$(document).on("change", "#district2", function(){
                    var id = $(this).val();
                      if(id==''){
                       $('#city2').empty().append('<option value="">No City</option>');
                      }else{
                          var url = '{{url("/checkout")}}?areaId='+id;
                          $.get(url,function(data){
                            $('#city2').empty().append(data.geoData);
                            $('.orderSummryTable').empty().append(data.view);
                            $('.cartItemsTotal').empty().append(data.view2);
                          });  
                      }
                });
                
                $(document).on("change", "#city2", function(){
                        var area = $('#district2').val();
                        var id = $(this).val();
                      if(id=='' || area==''){
                       //$('#city').empty().append('<option value="">No City</option>');
                      }else{
                          var url = '{{url("/checkout")}}?areaId='+area+'&cityId='+id;
                          $.get(url,function(data){
                            $('.orderSummryTable').empty().append(data.view);
                            $('.cartItemsTotal').empty().append(data.view2);
                          });  
                      }
                });
                
                let typingTimer2;
                $(document).on('keyup','.valuecheck3',function(){
                    clearTimeout(typingTimer2);
                    var url ="{{route('incompletedOrder')}}";
                    var mobile2 =$('.mobileNumberInput2').val();
                    mobile2 = mobile2.replace(/^\+88/, '');
                    mobile2 = mobile2.replace(/^88/, '');
                    if(mobile2.length ==11){
                        typingTimer2 = setTimeout(function () {
                            var data =$(".checkout-form2").serialize();
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
                
            	
            	$(document).on('click','.subsriberbtm',function(e){
            	    
                    e.preventDefault();
                    var url = $('#subscirbeForm').data('url');
                    var formData =$('#subscirbeForm').serialize();
                    if(validateEmail()){
                        $.ajax({
                          url: url,
                          type: 'POST',
                          dataType: 'json',
                          data: formData,
                          cache: false,
                        })
                        .done(function(data) {
                            if(data.success)
                              {
                                $("#subscribeemailMsg").html("<span style='background: #00baa3;padding: 5px 15px;'>"+ data.message +"</span>");
                                $("#subscirbeForm")[0].reset();
                              }else{
                                $("#subscribeemailMsg").html("<span style='background: #ffc107;padding: 5px 15px;'>"+ data.message +"</span>");
                              }
                        })
                        .fail(function() {
                          // alert("error");
                        });
                    }else{ 
                        $("#subscribeemailMsg").html("<span style='background: #e52734;padding: 5px 15px;'>Please Write a Verified Email</span>");
                    }
        
            });
        
            function validateEmail(){
                  var subscribeEmail=$("#subscribeEmail").val();
                   var reg =/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                   if(reg.test(subscribeEmail)){
                      return true;
                   }else{
                      return false;
              }
            }
            	
                
            });
        </script>
        
        <script>
            function openSearch() {
              document.getElementById("myOverlay").style.display = "block";
            }
            
            function closeSearch() {
              document.getElementById("myOverlay").style.display = "none";
            }
        </script>
        
        @stack('js')
        
    </body>
</html>
