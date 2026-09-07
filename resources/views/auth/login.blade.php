@extends(general()->theme.'.layouts.app') @section('title')
<title>{{general()->title}} | {{general()->subtitle}}</title>
@endsection @section('SEO')
<meta name="description" content="{!!general()->meta_description!!}" />
<meta name="keywords" content="{{general()->meta_keyword}}" />
<meta property="og:title" content="{{general()->meta_title}}" />
<meta property="og:description" content="{!!general()->meta_description!!}" />
<meta property="og:image" content="{!!general()->meta_description!!}" />
<meta property="og:url" content="{{route('index')}}" />
@endsection @push('css')

<style>
.padding_eight_all.bg-white {
    padding: 30px;
    box-shadow: 0px 0px 10px #ccc;
}

ul.btn-login.list_none.text-center li {
    display: inline-block;
}

.chek-form {
    margin-bottom: 20px;
    color: #444;
}

.different_login {
    text-align: center;
    color: #444;
}

.form-note.text-center {
    color: #444;
}
button.btn.btn-fill-out.btn-block {
    border: 1px solid #ccc;
}
</style>

@endpush 

@section('contents')

<!-- Start of Page Header -->
<div class="page-header">
    <div class="container">
        <h1 class="page-title mb-0">Log-In </h1>
    </div>
</div>
<!-- End of Page Header -->

<!-- START MAIN CONTENT -->
<div class="main_content mb-5">

    <!-- START LOGIN SECTION -->
    <div class="login_register_wrap section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-md-10">
                    <div class="login_wrap">
                        <div class="padding_eight_all bg-white">
                            <div class="heading_s1">
                                <h3 style="color:#444!important;">Login</h3>
                            </div>
                            <br>
                            <form action="{{route('login')}}" method="post">
                            @csrf
                            @if($errors->has('username'))
                                <span style="color:red;display: block;">{{ $errors->first('username') }}</span>
                            @endif
                            @if($errors->has('password'))
                                <span style="color:red;display: block;">{{ $errors->first('password') }}</span>
                            @endif
                            @if (session('loginfail'))
                            <span style="color:red;display: block;">{{ session('loginfail') }}</span>
                            @endif
                            @if (session('loginfailP'))
                            <span style="color:red;display: block;">{{ session('loginfailP') }}</span>
                            @endif
                                <div class="form-group mb-3">
                                    <input type="text" required="" class="form-control" value="{{old('username')}}" name="username" placeholder="Your Email">
                                </div>
                                <div class="form-group mb-3">
                                    <input class="form-control" required="" type="password" name="password" placeholder="Password">
                                </div>
                                <div class="login_footer form-group mb-3">
                                    <div class="chek-form">
                                        <div class="custome-checkbox">
                                            <input class="form-check-input" type="checkbox" name="remember" id="exampleCheckbox1" value="">
                                            <label class="form-check-label" for="exampleCheckbox1"><span>Remember me</span></label>
                                        </div>
                                    </div>
                                    <a href="{{route('forgotPassword')}}">Forgot password?</a>
                                </div>
                                <div class="form-group mb-3">
                                    <button type="submit" class="btn btn-fill-out btn-block" name="login">Log in</button>
                                </div>
                            </form>
                            <div class="form-note text-center">Don't Have an Account? <a href="{{route('register')}}">Sign up now</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END LOGIN SECTION -->
</div>
<!-- END MAIN CONTENT -->



@endsection @push('js') @endpush