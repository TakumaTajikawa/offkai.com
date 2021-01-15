@extends('app')

@section('title', 'ユーザー登録')

@section('content')
    @include('nav')
    <div class="container">
        <div class="row">
            <div class="mx-auto col col-12 col-sm-11 col-md-9 col-lg-7 col-xl-6">
                <div class="card mt-3 text-center">
                    <div class="card-header">
                        <span style="color: rgb(124,123,123); font-size: 18px;">
                            ユーザー登録
                        </span>
                    </div>
                    <div class="card-body text-center">
                        @include('errors')
                        <div class="card-text">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="md-form mt-5">
                                    <label for="name">
                                        {{ __('Name') }}
                                    </label>
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="md-form mt-5 text-center">
                                    <label for="gender">
                                        {{ __('Gender') }}
                                    </label>
                                    <input id="gender-m" type="radio" name="gender" value="男" class="gender-select-m">
                                    <span class="gender-select-m">男性</span>
                                    <input id="gender-f" type="radio" name="gender" value="女" class="gender-select-f">
                                    <span class="gender-select-f">女性</span>
                                    <hr style="border-color: rgb(206,212,217);">
                                    @if ($errors->has('gender'))
                                        <span class="invalid-feedback" role="alert" style="display:inline-block; margin-top: 0;">
                                            <strong>{{ $errors->first('gender') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="md-form mt-5">
                                    <label for="email">
                                        {{ __('E-Mail Address') }}
                                    </label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="md-form mt-5">
                                    <label for="password">
                                        {{ __('Password') }}
                                    </label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="md-form mt-5">
                                    <label for="password-confirm">
                                        {{ __('Confirm Password') }}
                                    </label>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>

                                <button type="submit" class="btn btn-block mt-5 mb-2" style="background-color: rgb(	0,200,179); color: #fff;">
                                    登録
                                </button> 
                            </form>
                        </div>
                        <div class="mt-4 mb-2">
                            <a href="{{ route('login') }}" class="card-text atag_gray">
                                登録済みの方はこちら
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('footer')
@endsection
