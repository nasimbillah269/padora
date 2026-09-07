@extends(welcomeTheme().'layouts.app') @section('title')
<title>{{websiteTitle('Profile Edit')}}</title>
@endsection @section('SEO')
<meta name="title" property="og:title" content="{{websiteTitle('Profile Edit')}}" />
<meta name="description" property="og:description" content="{!!general()->meta_description!!}" />
<meta name="keywords" content="{{general()->meta_keyword}}" />
<meta name="image" property="og:image" content="{{asset(general()->logo())}}" />
<meta name="url" property="og:url" content="{{route('customer.profile')}}" />
<link rel="canonical" href="{{route('customer.profile')}}">
@endsection 
@push('css')
<style>
    .accountProfile .profile-photo-row { display:flex; align-items:center; gap:16px; margin-bottom:20px; }
    .accountProfile .profile-photo-row img { width:72px; height:72px; object-fit:cover; border-radius:50%; border:2px solid #ece7f0; }
    .accountProfile .form-group, .accountProfile .mb-3 { margin-bottom:16px; }
    .accountProfile .required { color:#c0392b; }
</style>
@endpush
@section('contents')

@include(welcomeTheme().'.customer.includes.pageHeader', ['pageTitle' => 'Account Details'])

<div class="userdashboard">
    <div class="container">
        <div class="tab tab-vertical row gutter-lg">
            @include(welcomeTheme().'.customer.includes.sidebar')
            <div class="tab-content accountProfile">
                <p class="customer-panel-title">Account Details</p>
                @include(welcomeTheme().'.alerts')
                <form method="POST" action="{{ route('customer.profile') }}" enctype="multipart/form-data">
                  @csrf
                  <div class="profile-photo-row">
                    <img src="{{asset($user->image())}}" alt="{{ $user->name }}">
                    <div style="flex:1;">
                        <label>Upload Photo</label>
                        <input type="file" class="form-control" name="image">
                        @if ($errors->has('image'))
                          <p style="color: red;margin: 4px 0 0;">{{ $errors->first('image') }}</p>
                        @endif
                    </div>
                  </div>
                  <div class="form-group mb-3">
                    <label>Name<span class="required">*</span></label>
                    <input required="" class="form-control" value="{{old('name')?:$user->name}}" name="name" type="text" placeholder="Enter Your Name">
                    @if ($errors->has('name'))
                      <p style="color: red;margin: 0;">{{ $errors->first('name') }}</p>
                    @endif
                  </div>
                  <div class="form-group mb-3">
                    <label>Email<span class="required">*</span></label>
                    <input required="" class="form-control" value="{{old('email')?:$user->email}}" name="email" type="email" placeholder="Enter Your Email">
                    @if ($errors->has('email'))
                      <p style="color: red;margin: 0;">{{ $errors->first('email') }}</p>
                    @endif
                  </div>
                  <div class="form-group mb-3">
                    <label>Mobile <span class="required">*</span></label>
                    <input required="" class="form-control" value="{{old('mobile')?:$user->mobile}}" name="mobile" type="text" placeholder="Enter Your Mobile">
                    @if ($errors->has('mobile'))
                      <p style="color: red;margin: 0;">{{ $errors->first('mobile') }}</p>
                    @endif
                  </div>
                  <div class="row">
                    <div class="form-group col-md-4 mb-3">
                      <label>District</label>
                      <select class="form-control"  name="district" >
                          <option value="">Select Option</option>
                          @foreach(geoData(3) as $data)
                          <option value="{{$data->id}}" {{$user->district==$data->id?'selected':''}}>{{$data->name}}</option>
                          @endforeach
                      </select>
                      @if ($errors->has('district'))
                        <p style="color: red;margin: 0;">{{ $errors->first('district') }}</p>
                      @endif
                    </div>
                    <div class="form-group col-md-4 mb-3">
                      <label>City/Thana</label>
                      <select class="form-control"  name="city" >
                          <option value="">Select Option</option>
                          @if($user->district)
                          @foreach(geoData(4,$user->district) as $data)
                          <option value="{{$data->id}}" {{$user->city==$data->id?'selected':''}}>{{$data->name}}</option>
                          @endforeach
                          @endif
                      </select>
                      @if ($errors->has('city'))
                        <p style="color: red;margin: 0;">{{ $errors->first('city') }}</p>
                      @endif
                    </div>
                    <div class="form-group col-md-4 mb-3">
                      <label>Postal Code</label>
                      <input type="text" class="form-control" name="postal_code" value="{{old('postal_code')?:$user->postal_code}}" placeholder="Enter Postal Code">
                      @if ($errors->has('postal_code'))
                        <p style="color: red;margin: 0;">{{ $errors->first('postal_code') }}</p>
                      @endif
                    </div>
                  </div>
                  <div class="form-group mb-3">
                    <label>Address</label>
                    <input class="form-control" value="{{old('address')?:$user->address_line1}}" name="address" type="text" placeholder="Exp: House Road..">
                    @if ($errors->has('address'))
                      <p style="color: red;margin: 0;">{{ $errors->first('address') }}</p>
                    @endif
                  </div>
                  <button type="submit" class="btn btn-primary">Update Profile</button>
                          
                          {{--<div class="form-group row">
                            <label for="inputPassword" class="col-sm-3 col-form-label">Division*</label>
                            <div class="col-sm-9">
                                @if ($errors->has('division'))
                                <p style="color: red;margin: 0;">{{ $errors->first('division') }}</p>
                              @endif
                              <select class="form-control regionname" id="division" name="division">
                                  <option value="">Select Option</option>
                                  @foreach(App\Models\Country::where('type',2)->orderBy('name')->get() as $data)
                                  <option value="{{$data->id}}" {{Auth::user()->division==$data->id?'selected':''}}>{{$data->name}}</option>
                                  @endforeach
                              </select>
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputPassword" class="col-sm-3 col-form-label">District*</label>
                            <div class="col-sm-9">
                                @if ($errors->has('district'))
                                <p style="color: red;margin: 0;">{{ $errors->first('district') }}</p>
                              @endif
                              <select class="form-control district" id="district" name="district">
                                  <option value="">Select Option</option>
                                  @foreach(App\Models\Country::where('parent_id',Auth::user()->division)->orderBy('name')->get() as $data)
                                  <option value="{{$data->id}}" {{Auth::user()->district==$data->id?'selected':''}}>{{$data->name}}</option>
                                  @endforeach
    
                              </select>
                            </div>
                          </div>
                          
                          <div class="form-group row">
                            <label for="inputPassword" class="col-sm-3 col-form-label">City*</label>
                            <div class="col-sm-9">
                                @if ($errors->has('city'))
                                <p style="color: red;margin: 0;">{{ $errors->first('city') }}</p>
                              @endif
                              <select class="form-control cityname" id="city" name="city">
                                  <option value="">Select Option</option>
    
                                  @foreach(App\Models\Country::where('parent_id',Auth::user()->district)->orderBy('name')->get() as $data)
                                  <option value="{{$data->id}}" {{Auth::user()->city==$data->id?'selected':''}}>{{$data->name}}</option>
                                  @endforeach
    
                              </select>
                            </div>
                          </div>
                            --}}
                  </form>
            </div>
        </div>
    </div>
</div>

@endsection
@push('js')
@endpush