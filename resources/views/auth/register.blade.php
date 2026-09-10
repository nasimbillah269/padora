@extends(general()->theme.'.layouts.app') @section('title')
<title>{{general()->title}} | {{general()->subtitle}}</title>
@endsection @section('SEO')
<meta name="description" content="{!!general()->meta_description!!}" />
<meta name="keywords" content="{{general()->meta_keyword}}" />
<meta property="og:title" content="{{general()->meta_title}}" />
<meta property="og:description" content="{!!general()->meta_description!!}" />
<meta property="og:image" content="{!!general()->meta_description!!}" />
<meta property="og:url" content="{{route('register')}}" />
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

.field-error{
    color:red;
    display:block;
    font-size:13px;
    margin-top:4px;
}
.form-msg{
    text-align:center;
    margin-bottom:15px;
    font-size:14px;
}
.form-msg.error{ color:#a01a22; }
.form-msg.success{ color:green; }

/* Honeypot — invisible to real users, bots tend to fill every field they can see in the DOM */
.hp-field{
    position:absolute;
    left:-9999px;
    top:-9999px;
    width:1px;
    height:1px;
    overflow:hidden;
}

/* Loading spinner inside the submit button */
button.btn-fill-out.btn-block{
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
}
.btn-spinner{
    display:none;
    width:16px;
    height:16px;
    border:2px solid rgba(255,255,255,.4);
    border-top-color:#fff;
    border-radius:50%;
    margin-right:8px;
    animation: btnSpin .6s linear infinite;
}
button.is-loading .btn-spinner{
    display:inline-block;
}
@keyframes btnSpin{
    to{ transform: rotate(360deg); }
}

/* Password show/hide — inline SVG so it never depends on an icon font */
.password-wrapper{
    position: relative;
}
.password-wrapper .form-control{
    padding-right: 42px;
}
.toggle-password{
    position: absolute;
    right: 8px;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    padding: 6px;
    margin: 0;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #726161;
}
.toggle-password:hover{ color:#444; }
.toggle-password svg{ width:20px; height:20px; display:block; }
.toggle-password .icon-eye-off{ display:none; }
.toggle-password.is-visible .icon-eye{ display:none; }
.toggle-password.is-visible .icon-eye-off{ display:block; }

.otp-resend{
    text-align:center;
    margin-top:15px;
    font-size:14px;
    color:#444;
}
.otp-resend a{
    color:#7c3aed;
    font-weight:600;
    cursor:pointer;
}
.otp-resend a.disabled{
    color:#999;
    pointer-events:none;
    cursor:not-allowed;
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

<!-- START MAIN CONTENT -->
<div class="main_content mb-5">

    <!-- START REGISTER SECTION -->
    <div class="login_register_wrap section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-md-10">
                    <div class="login_wrap">
                        <div class="padding_eight_all bg-white">
                            <div class="heading_s1">
                                <h3 style="color:#444!important;">Register</h3>
                            </div>
                            <br>

                            @include(App\Models\General::first()->theme.'.alerts')

                            {{-- STEP 1: Registration Info --}}
                            <form id="regStep1Form">
                                @csrf

                                <div id="step1Msg" class="form-msg"></div>

                                {{-- Honeypot — leave empty, it's not a real field --}}
                                <div class="hp-field" aria-hidden="true">
                                    <label for="company_website">Website</label>
                                    <input type="text" name="company_website" id="company_website" tabindex="-1" autocomplete="off">
                                </div>

                                <div class="form-group mb-3">
                                    <label for="name">Name *</label>
                                    <input type="text" name="name" id="name" class="form-control" placeholder="Your Name">
                                    <span class="field-error" id="err_name"></span>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="contact">Mobile OR Email *</label>
                                    <input type="text" name="contact" id="contact" class="form-control" placeholder="Your Mobile or Email">
                                    <span class="field-error" id="err_contact"></span>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="password">Password *</label>
                                    <div class="password-wrapper">
                                        <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                                        <button type="button" class="toggle-password" data-target="password" aria-label="Show password">
                                            <svg class="icon-eye" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7-11-7-11-7Z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                            <svg class="icon-eye-off" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7-11-7-11-7Z"></path><circle cx="12" cy="12" r="3"></circle><line x1="2" y1="2" x2="22" y2="22"></line></svg>
                                        </button>
                                    </div>
                                    <span class="field-error" id="err_password"></span>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="password_confirmation">Confirm Password *</label>
                                    <div class="password-wrapper">
                                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Re-enter Password">
                                        <button type="button" class="toggle-password" data-target="password_confirmation" aria-label="Show password">
                                            <svg class="icon-eye" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7-11-7-11-7Z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                            <svg class="icon-eye-off" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7-11-7-11-7Z"></path><circle cx="12" cy="12" r="3"></circle><line x1="2" y1="2" x2="22" y2="22"></line></svg>
                                        </button>
                                    </div>
                                    <span class="field-error" id="err_password_confirmation"></span>
                                </div>

                                <div class="form-group mb-3">
                                    <button type="submit" class="btn btn-fill-out btn-block" id="step1Btn">
                                        <span class="btn-spinner"></span><span class="btn-text">Register</span>
                                    </button>
                                </div>
                            </form>

                            {{-- STEP 2: OTP Verify --}}
                            <form id="regStep2Form" style="display:none;">
                                <div class="heading_s1">
                                    <h3 style="color:#444!important;">Verify OTP</h3>
                                </div>
                                <p id="otpSentInfo" style="color:#444;">A verification code has been sent.</p>

                                <div id="step2Msg" class="form-msg"></div>

                                <div class="form-group mb-3">
                                    <label for="otp">Enter OTP Code *</label>
                                    <input type="text" name="otp" id="otp" maxlength="6" class="form-control" placeholder="Enter OTP Code">
                                    <span class="field-error" id="err_otp"></span>
                                </div>

                                <div class="form-group mb-3">
                                    <button type="submit" class="btn btn-fill-out btn-block" id="step2Btn">
                                        <span class="btn-spinner"></span><span class="btn-text">Verify &amp; Complete Registration</span>
                                    </button>
                                </div>

                                <div class="otp-resend">
                                    Didn't receive code?
                                    <a id="resendBtn">Resend OTP</a>
                                    <span id="resendTimer"></span>
                                </div>
                            </form>

                            <div class="form-note text-center">Already Have An Account? <a href="{{route('login')}}">Log in</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END REGISTER SECTION -->
</div>
<!-- END MAIN CONTENT -->

@endsection

@push('js')
<script>
(function(){
    const csrfToken = document.querySelector('meta[name="csrf-token"]') ?
        document.querySelector('meta[name="csrf-token"]').getAttribute('content') :
        document.querySelector('#regStep1Form input[name="_token"]').value;

    const step1Form   = document.getElementById('regStep1Form');
    const step2Form   = document.getElementById('regStep2Form');
    const step1Btn    = document.getElementById('step1Btn');
    const step2Btn    = document.getElementById('step2Btn');
    const resendBtn   = document.getElementById('resendBtn');
    const resendTimer = document.getElementById('resendTimer');

    let cooldownInterval = null;

    // Password show/hide toggles
    document.querySelectorAll('.toggle-password').forEach(function(btn){
        btn.addEventListener('click', function(){
            const input = document.getElementById(btn.getAttribute('data-target'));
            const showing = input.type === 'text';
            input.type = showing ? 'password' : 'text';
            btn.classList.toggle('is-visible', !showing);
            btn.setAttribute('aria-label', showing ? 'Show password' : 'Hide password');
        });
    });

    function clearErrors(prefix){
        document.querySelectorAll('#'+prefix+'Form .field-error').forEach(el => el.textContent = '');
        document.getElementById(prefix === 'regStep1' ? 'step1Msg' : 'step2Msg').textContent = '';
    }

    function showErrors(errors, fallbackMsgId){
        Object.keys(errors).forEach(function(key){
            const el = document.getElementById('err_'+key);
            if(el){
                el.textContent = errors[key][0];
            } else if(fallbackMsgId){
                showMsg(fallbackMsgId, errors[key][0], 'error');
            }
        });
    }

    function showMsg(elId, message, type){
        const el = document.getElementById(elId);
        el.textContent = message;
        el.className = 'form-msg ' + type;
    }

    function startCooldown(seconds){
        clearInterval(cooldownInterval);
        let remaining = seconds;
        resendBtn.classList.add('disabled');
        resendTimer.textContent = ' (' + remaining + 's)';

        cooldownInterval = setInterval(function(){
            remaining--;
            if(remaining <= 0){
                clearInterval(cooldownInterval);
                resendBtn.classList.remove('disabled');
                resendTimer.textContent = '';
            } else {
                resendTimer.textContent = ' (' + remaining + 's)';
            }
        }, 1000);
    }

    function setLoading(btn, loading){
        btn.disabled = loading;
        btn.classList.toggle('is-loading', loading);
        const form = btn.closest('form');
        form.querySelectorAll('input').forEach(function(input){
            input.disabled = loading;
        });
    }

    // STEP 1: Submit registration info -> send OTP
    step1Form.addEventListener('submit', function(e){
        e.preventDefault();
        clearErrors('regStep1');

        // Capture values BEFORE disabling inputs — a disabled input is
        // excluded from FormData entirely.
        const formData = new FormData(step1Form);
        formData.append('action', 'send_otp');

        setLoading(step1Btn, true);

        fetch("{{ route('register') }}", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            setLoading(step1Btn, false);

            if(!data.status){
                if(data.errors){ showErrors(data.errors, 'step1Msg'); }
                if(data.message){ showMsg('step1Msg', data.message, 'error'); }
                return;
            }

            step1Form.style.display = 'none';
            step2Form.style.display = 'block';
            document.getElementById('otpSentInfo').textContent =
                'A verification code has been sent to ' + document.getElementById('contact').value;
            startCooldown(data.next_resend_in || 60);
        })
        .catch(() => {
            setLoading(step1Btn, false);
            showMsg('step1Msg', 'Something went wrong. Please try again.', 'error');
        });
    });

    // STEP 2: Verify OTP
    step2Form.addEventListener('submit', function(e){
        e.preventDefault();
        clearErrors('regStep2');
        setLoading(step2Btn, true);

        fetch("{{ route('register') }}", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ action: 'verify_otp', otp: document.getElementById('otp').value })
        })
        .then(res => res.json())
        .then(data => {
            setLoading(step2Btn, false);

            if(!data.status){
                if(data.errors){ showErrors(data.errors, 'step2Msg'); }
                if(data.message){ showMsg('step2Msg', data.message, 'error'); }

                if(data.restart){
                    setTimeout(function(){
                        step2Form.style.display = 'none';
                        step2Form.reset();
                        step1Form.style.display = 'block';
                        step1Form.reset();
                        clearErrors('regStep1');
                    }, 1800);
                }
                return;
            }

            showMsg('step2Msg', data.message || 'Registration successful!', 'success');
            window.location.href = data.redirect;
        })
        .catch(() => {
            setLoading(step2Btn, false);
            showMsg('step2Msg', 'Something went wrong. Please try again.', 'error');
        });
    });

    // RESEND OTP
    resendBtn.addEventListener('click', function(){
        if(resendBtn.classList.contains('disabled')) return;

        const originalText = resendBtn.textContent;
        resendBtn.classList.add('disabled');
        resendBtn.textContent = 'Sending...';

        const resendData = new FormData();
        resendData.append('action', 'resend_otp');

        fetch("{{ route('register') }}", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            body: resendData
        })
        .then(res => res.json())
        .then(data => {
            resendBtn.textContent = originalText;

            if(!data.status){
                resendBtn.classList.remove('disabled');
                showMsg('step2Msg', data.message, 'error');
                if(data.remaining){ startCooldown(data.remaining); }
                return;
            }
            showMsg('step2Msg', data.message, 'success');
            startCooldown(data.next_resend_in || 60);
        })
        .catch(() => {
            resendBtn.textContent = originalText;
            resendBtn.classList.remove('disabled');
            showMsg('step2Msg', 'Something went wrong. Please try again.', 'error');
        });
    });
})();
</script>
@endpush