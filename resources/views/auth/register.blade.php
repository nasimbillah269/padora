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
        <h1 class="page-title mb-0">Registration </h1>
    </div>
</div>
<!-- End of Page Header -->

<!-- Start of Breadcrumb -->
<nav class="breadcrumb-nav mb-10">
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="{{route('index')}}">Home </a></li>
            <li>Registration </li>
        </ul>
    </div>
</nav>
<!-- End of Breadcrumb -->

<div class="lostregis">
	<div class="container">
	    <div class="row">
	        <div class="col-md-3"></div>
	        <div class="col-md-6">
	            <div class="login-part">
            		<h4 style="color:#444!important;">REGISTER</h4>
            		@include(App\Models\General::first()->theme.'.alerts')
            		<form action="{{route('register')}}" method="post">
            		    @csrf
            			<label for="name">
            				Name *
            			</label>
            			<div class="form-group form-group-section">
            			    <input type="name" name="name" value="{{old('name')}}" class="form-control control-section" placeholder="" required="">
            			    @if($errors->has('name'))
                                <span style="color:red;display: block;">{{ $errors->first('name') }}</span>
                            @endif
            			</div>
            
            			<label for="email">
            				Email address *
            			</label>
            			<div class="form-group form-group-section">
            			    <input type="email" name="email" value="{{old('email')}}" class="form-control control-section" placeholder="" required="">
            			    @if($errors->has('email'))
                                <span style="color:red;display: block;">{{ $errors->first('email') }}</span>
                            @endif
            			</div>
            
            			<label for="password">
            				Password *
            			</label>
            			<div class="form-group form-group-section">
            			    <input type="password" name="password" value="" class="form-control control-section" placeholder="" required="">
            			    @if($errors->has('password'))
                                <span style="color:red;display: block;">{{ $errors->first('password') }}</span>
                            @endif
            			</div>
            
            			<p>
            				Your personal data will be used to support your experience throughout this website, to manage access to your account, and for other purposes described in our
            			</p>
            			<div>
            				<button type="submit" class="btn submitbutton">REGISTER</button>
            			</div>
            		</form>
            		
                    <div class="row">
                        <div class="col-md-12">
                            <a href="{{route('login')}}">Alrady Have An Account? <span>Log-In</span></a>
                        </div>
                    </div>
            		
        		</div>
	        </div>
	        <div class="col-md-3"></div>
	    </div>

	</div>
</div>

@endsection @push('js') @endpush
