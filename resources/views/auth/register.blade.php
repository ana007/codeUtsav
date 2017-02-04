@extends('layouts.admin')

@section('content')

                    <form class="form-horizontal j-forms" role="form" method="POST" action="{{ url('/register') }}">
                        {{ csrf_field() }}
                        <div class="login-form-header">
            <div class="logo">
                <a href="index.html" title="Admin Template"><img src="images/logo.png" alt="logo" width="250"></a>
            </div>
        </div>

         <div class="login-form-content">

            
            <div class="unit">
                <div class="input login-input{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label class="icon-left" for="name">
                        <i class="zmdi zmdi-account"></i>
                    </label>
                   
                     <input id="name" type="text" class="form-control login-frm-input" placeholder="Full Name" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                </div>
            </div>

            <div class="unit">
                <div class="input login-input{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label class="icon-left" for="email">
                        <i class="zmdi zmdi-account"></i>
                    </label>
                   
                     <input id="email" type="email" placeholder="Email" class="form-control login-frm-input" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                </div>
            </div>

            <div class="unit">
                <div class="input login-input{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label class="icon-left" for="password">
                        <i class="zmdi zmdi-key"></i>
                    </label>
                   
                    <input id="password" type="password" placeholder="Password" class="form-control login-frm-input" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                </div>
            </div>

            <div class="unit">
                <div class="input login-input">
                    <label class="icon-left" for="password-confirm">
                        <i class="zmdi zmdi-key"></i>
                    </label>
                    <input id="password-confirm" type="password" placeholder="Confirm Password" class="form-control login-frm-input" name="password_confirmation" required>
                </div>
            </div>

        </div>
                 
                
            <button type="submit" class="btn-block btn btn-primary btn-custom">Sign Up</button>
     
    
            <a href="/login" class="btn-block btn btn-primary btn-custom">Log In</a>
   
    

                    </form>
                
@endsection
