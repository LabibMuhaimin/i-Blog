@extends('layouts.frontend.app')

@section('title','Register')

@push('css')
    <link href="{{ asset('assets/frontend/css/auth/styles.css')}}" rel="stylesheet">

	<link href="{{ asset('assets/frontend/css/home/responsive.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/frontend/css/home/iblog.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endpush

@section('content')
<!--<div class="slider display-table center-text">
		<h1 class="title display-table-cell"><b>REGISTER</b></h1>
	</div>-->

	<section style="background-image:url({{ Storage::url('site/wall.jpg')}});background-position: center;background-repeat: no-repeat;background-size: cover;" class="blog-area section">
		<div class="container">
            <h2 style="color:white;text-align:center;margin-bottom:30px;"><b>Register</b></h2>
			<div class="row">
				<div class="col-lg-2 col-md-0"></div>
				<div class="col-lg-8 col-md-12">
					<div class="reg-body post-wrapper">
                        <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
                        @csrf

                        <div class="form-group row">
                            <!--<label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>-->

                            <div class="input-group mb-3">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                <label><i class="fa fa-user"></i> Name</label>
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">

                            <div class="input-group mb-3">
                                <input id="username" type="text" class="form-control
                                {{ $errors->has('username') ? ' is-invalid' : '' }}" 
                                name="username" value="{{ old('username') }}" required autofocus>
                                <label><i class="fa fa-user"></i> Userame</label>

                                @if ($errors->has('username'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                           

                            <div class="input-group mb-3">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                                <label><i class="fa fa-envelope"></i> Email Address</label>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                           

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
                            

                            <div class="input-group mb-3">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                <label><i class="fa fa-lock"></i> Confirm Password</label>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
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