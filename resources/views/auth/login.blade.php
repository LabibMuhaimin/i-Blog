@extends('layouts.frontend.app')

@section('title','Login')

@push('css')
    <link href="{{ asset('assets/frontend/css/auth/styles.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="{{ asset('assets/frontend/css/home/responsive.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/frontend/css/home/iblog.css')}}" rel="stylesheet">
@endpush

@section('content')


	<section style="background-image:url({{ Storage::url('site/wall.jpg')}});background-position: center;background-repeat: no-repeat;background-size: cover;"  class="blog-area section">
		<div class="container">
            <h2 style="color:white;text-align:center;margin-bottom:30px;"><b>Log In</b></h2>
			<div class="row">
				<div class="col-lg-2 col-md-0"></div>
				<div class=" col-lg-8 col-md-12">
					<div class="card-body post-wrapper" >
                        <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                        @csrf

                        <div class="form-group row">
                            <!--<label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>-->

                            <div class="input-group mb-3">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                                
                                <label><i class="fa fa-envelope"></i> E-Mail Address</label>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                           <!-- <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>-->

                            <div class="input-group mb-3">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                                
                                <label><i class="fa fa-lock"></i> Password</label>
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember" style="color:white;">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            </div>
                        </div>
                    </form>
                    
					</div><!-- post-wrapper -->
				</div><!-- col-sm-8 col-sm-offset-2 -->
			</div><!-- row -->

		</div><!-- container -->
	</section><!-- section -->

@endsection

@push('js')

@endpush