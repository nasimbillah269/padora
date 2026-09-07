<div class="ac-header">
    <div class="container">
        <h1>{{ $pageTitle ?? 'My Account' }}</h1>
        <nav class="ac-crumb">
            <a href="{{ url('/') }}">Home</a>
            <span class="sep">/</span>
            <a href="{{ route('customer.dashboard') }}">My Account</a>
            @if(($pageTitle ?? '') && $pageTitle !== 'My Account')
                <span class="sep">/</span> {{ $pageTitle }}
            @endif
        </nav>
    </div>
</div>
