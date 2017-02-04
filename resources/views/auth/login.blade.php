@extends('layouts.admin')

@section('content')

                   

                    <form class="form-horizontal j-forms" role="form" method="POST" action="{{ url('/postSignIn') }}">
                    <div class="login-form-header">
            <div class="logo">
                <a title="Admin Template"><p style="font-size: 60px;">UNICEF</p></a>
            </div>
        </div>
                        {{ csrf_field() }}

                        
                        <div class="login-form-content">
                        <div class="unit">
                <div class="input login-input{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label class="icon-left" for="email">
                        <i class="zmdi zmdi-account"></i>
                    </label>
                    
                     <input id="email" type="email" class="form-control login-frm-input" placeholder="Username / Email" name="email" value="{{ old('email') }}" required autofocus>

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
                   
                    <input id="password" type="password" class="form-control login-frm-input" name="password" placeholder="Password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                       <!-- <span class="hint">
                            <a href="{{ url('/password/reset') }}" class="link">Forgot password?</a>
                        </span> -->
                </div>
            </div>

                      
            <div class="unit">
                <label class="checkbox">
                    <input type="checkbox" name="remember" checked="">
                    <i></i>
                    Keep me logged in
                </label>
            </div>
            </div>

                       
            <button type="submit" class="btn-block btn btn-primary btn-custom">Sign in</button>

             <!--<a href="/register" class="btn-block btn btn-primary btn-custom">Register</a> -->
        
                    </form>
               
@endsection


