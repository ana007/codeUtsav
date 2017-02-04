@extends('layouts.admin')

<!-- Main Content -->
@section('content')

                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-horizontal j-forms" role="form" method="POST" action="{{ url('/password/email') }}">
                        {{ csrf_field() }}
                        <div class="login-form-header">
            <div class="logo">
                <a href="index.html" title="Admin Template"><img src="/images/logo.png" alt="logo" width="250"></a>
            </div>
        </div>
               
                        <div class="login-form-content">



            <!-- start login -->
            <div class="unit">
                <div class="input login-input{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label class="icon-left" for="email">
                        <i class="zmdi zmdi-account"></i>
                    </label>
                    
                    <input id="email" type="email" class="form-control login-frm-input" placeholder="Email" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                </div>
            </div>
       



        </div>

                       <button type="submit" class="btn-block btn btn-primary btn-custom">Send Password Reset Link</button>
                    </form>
            
@endsection
