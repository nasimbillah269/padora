@extends(general()->theme.'.layouts.app') @section('title')
<title>{{general()->title}} | {{general()->subtitle}}</title>
@endsection @section('SEO')
<meta name="description" content="{!!general()->meta_description!!}" />
<meta name="keywords" content="{{general()->meta_keyword}}" />
<meta property="og:title" content="{{general()->meta_title}}" />
<meta property="og:description" content="{!!general()->meta_description!!}" />
<meta property="og:image" content="{!!general()->meta_description!!}" />
<meta property="og:url" content="{{route('forgotPassword')}}" />
@endsection @push('css')

<style>
.padding_eight_all.bg-white {
    padding: 30px;
    box-shadow: 0px 0px 10px #ccc;
}

.form-note.text-center {
    color: #444;
}

button.btn.btn-fill-out.btn-block {
    border: 1px solid #ccc;
}

.form-group.mb-3 label{
    font-weight: 600;
    font-size: 14px;
    color: #444;
    margin-bottom: 4px;
    display: block;
}
</style>

@endpush

@section('contents')

<!-- Start of Page Header -->
<div class="page-header">
    <div class="container">
        <h1 class="page-title mb-0">Reset Password </h1>
    </div>
</div>
<!-- End of Page Header -->

<!-- START MAIN CONTENT -->
<div class="main_content mb-5">

    <div class="login_register_wrap section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-md-10">
                    <div class="login_wrap">
                        <div class="padding_eight_all bg-white">
                            <div class="heading_s1">
                                <h3 style="color:#444!important;">Reset Password</h3>
                            </div>
                            <p style="color:#444;margin-bottom:20px;">
                                Enter the 6-digit verification code we sent you, along with your new password.
                            </p>

                            @include(App\Models\General::first()->theme.'.alerts')

                            <form action="{{route('resetPasswordCheck')}}" method="post">
                                @csrf
                                <input type="hidden" name="token" value="{{ $token }}">

                                @if($errors->has('name'))
                                    <span style="color:red;display: block;margin-bottom:10px;">{{ $errors->first('name') }}</span>
                                @endif

                                <div class="form-group mb-3">
                                    <label for="verifycode">Verify Code *</label>
                                    <input type="number" class="form-control" value="{{request()->code?:old('verifycode')}}" name="verifycode" id="verifycode" placeholder="Enter Verify Code" autocomplete="off" required>
                                    @if($errors->has('verifycode'))
                                        <span style="color:red;display: block;">{{ $errors->first('verifycode') }}</span>
                                    @endif
                                </div>

                                <div class="form-group mb-3">
                                    <label for="password">Password *</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" required>
                                    @if($errors->has('password'))
                                        <span style="color:red;display: block;">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>

                                <div class="form-group mb-3">
                                    <button type="submit" class="btn btn-fill-out btn-block">Reset Password</button>
                                </div>
                            </form>

                            <div class="form-note text-center">Remembered your password? <a href="{{route('login')}}">Log in</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- END MAIN CONTENT -->

@endsection @push('js') @endpush