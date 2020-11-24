@extends('frontend.layouts.template_02')
@section('main')
<style>
    .bnt{
        color: white;
        background-color: #6c757d;
        border-color: #666e76;
    }
</style>

<main id="main" class="site-main home-main business-main">
    <h2 class="title title-border-bottom align-center">{{__('Business SignUp')}}<span>{{__("Choose your type of business")}}</span></h2>
    <div class="row">
        <div class="col-md-8 container d-flex justify-content-between">
            <button id="dispensary" class="btn">Dispensary</button>
            <button id="delivery" class="btn">Delivery Doctor</button>
            <button id="doctor" class="btn">Doctor</button>
        </div>
    </div>

    <div id="content" class="container">
        <div class="card">
            <div class="card-body justify-content-center mb-5 mb-lg-0">
                <h2 class="card-title text-muted text-uppercase text-center">SignUp Page</h2>
                <form class="form-sign form-content" id="register" action="#" method="post">
                    {{-- @csrf   --}}
                    <small class="form-text text-danger golo-d-none" id="register_error">error!</small>
                    <div class="field-input">
                        <input type="text" id="register_name" name="name" placeholder="Full Name" class="form-control col-md-4 rounded bg-white mb-2" required>
                    </div>
                    <div class="field-input">
                        <input type="email" id="register_email" name="email" placeholder="Email" class="form-control col-md-4  rounded bg-white mb-2" required>
                    </div>
                    <div class="field-input">
                        <input type="password" id="register_password" name="password" placeholder="Password" class="form-control col-md-4  rounded bg-white mb-2" required>
                    </div>
                    <div class="field-input">
                        <input type="password" id="register_password_confirmation" name="password_confirmation" placeholder="Confirm Password" class="form-control col-md-4 rounded bg-white mb-2" required>
                    </div>
                    <div class="field-check">
                        <label for="accept">
                            <input type="checkbox" id="accept" checked required>
                            Accept the <a title="Terms" href="#">Terms</a> and <a title="Privacy Policy" href="#">Privacy Policy</a>
                            <span class="checkmark">
                            <svg xmlns="http://www.w3.org/2000/svg" width="8" height="6" viewBox="0 0 8 6">
                                <path fill="#FFF" fill-rule="nonzero" d="M2.166 4.444L.768 3.047 0 3.815 1.844 5.66l.002-.002.337.337L7.389.788 6.605.005z"/>
                            </svg>
                        </span>
                        </label>
                    </div>
                    <button type="submit" class="gl-button btn button w-100" id="submit_register">{{__('Sign Up')}}</button>
                </form>
            </div>
        </div>
    </div>
</main>
@stop
