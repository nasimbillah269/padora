@extends(welcomeTheme().'layouts.app') @section('title')
<title>{{websiteTitle('Change Password')}}</title>
@endsection @section('SEO')
<meta name="title" property="og:title" content="{{websiteTitle('Change Password')}}" />
        <meta name="description" property="og:description" content="{!!general()->meta_description!!}" />
        <meta name="keywords" content="{{general()->meta_keyword}}" />
        <meta name="image" property="og:image" content="{{asset(general()->logo())}}" />
        <meta name="url" property="og:url" content="{{route('customer.changePassword')}}" />
        <link rel="canonical" href="{{route('customer.changePassword')}}">
@endsection 
@push('css')
@endpush 
@section('contents')

@include(welcomeTheme().'.customer.includes.pageHeader', ['pageTitle' => 'Change Password'])

<div class="userdashboard">
    <div class="container">
        <div class="tab tab-vertical row gutter-lg">
            @include(welcomeTheme().'.customer.includes.sidebar')
            <div class="tab-content">
                <p class="customer-panel-title">Change Password</p>
                @include(welcomeTheme().'.alerts')
                <form method="POST" action="{{route('customer.changePassword')}}" style="max-width:520px;">
                    @csrf
                    <div class="form-group" style="margin-bottom:16px;">
                        <label>Current Password <span style="color:#c0392b;">*</span></label>
                        <input type="password" class="form-control" name="current_password" placeholder="Enter current password" required>
                        @if ($errors->has('current_password'))
                            <p style="color: red;margin: 4px 0 0;">{{ $errors->first('current_password') }}</p>
                        @endif
                    </div>
                    <div class="form-group" style="margin-bottom:16px;">
                        <label>New Password <span style="color:#c0392b;">*</span></label>
                        <input type="password" class="form-control" name="password" placeholder="Enter new password" required>
                        @if ($errors->has('password'))
                            <p style="color: red;margin: 4px 0 0;">{{ $errors->first('password') }}</p>
                        @endif
                    </div>
                    <div class="form-group" style="margin-bottom:20px;">
                        <label>Confirm New Password <span style="color:#c0392b;">*</span></label>
                        <input type="password" class="form-control" name="password_confirmation" placeholder="Re-type new password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Password</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
@push('js')
@endpush