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
    .login-part {
    padding: 30px;
    background-color: #eee;
    color: #444;
    margin-bottom: 40px;
}

button.btn.submitbutton {
    margin: 15px 0;
}

.login-part .form-control {
    border: 1px solid #d3d3d3;
    margin-bottom: 20px;
    color: #444;
    margin-top: 7px;
}
</style>

@endpush 

@section('contents')

<!-- Start of Page Header -->
<div class="page-header">
    <div class="container">
        <h1 class="page-title mb-0">Forget Password </h1>
    </div>
</div>
<!-- End of Page Header -->

<!-- Start of Breadcrumb -->
<nav class="breadcrumb-nav mb-10">
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="{{route('index')}}">Home </a></li>
            <li>Forget Password </li>
        </ul>
    </div>
</nav>
<!-- End of Breadcrumb -->

<div class="lostpass">
	<div class="container">
    	<div class="row">
    	    <div class="col-md-3"></div>
    	    <div class="col-md-6">
    	        <div class="login-part">
    	            <p>
            			Lost your password? Please enter your username or email address. You will receive a link to create a new password via email.
            		</p>
            
            		<form  method="POST" action="{{route('forgotPassword')}}">
                        @csrf
                        @include(App\Models\General::first()->theme.'.alerts')
                        
            			<label for="email">
            				 Email*
            			</label>
            			<div class="form-group form-group-section">
            			    <input type="email" name="email" value="{{old('email')}}" class="form-control control-section" placeholder="Enter Your Email" required="">
            			    @if($errors->has('email'))
                                <span style="color:red;display: block;">{{ $errors->first('email') }}</span>
                            @endif
            			</div>
            			<div>
            				<button type="submit" class="btn submitbutton">RESET PASSWORD</button>
            			</div>
            		</form>
    	        </div>
    	    </div>
    	    <div class="col-md-3"></div>
    	</div>
	</div>
</div>

@endsection @push('js') @endpush