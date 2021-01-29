@extends('app')

@section('title', 'パスワード再設定 - オフ会.com')

@section('content')
    @include('nav')
    <div class="container">
        <div class="row">
            <div class="mx-auto col col-12 col-sm-11 col-md-9 col-lg-7 col-xl-6">
                <div class="card mt-3">
                    <div class="card-header text-center">
                        <span style="color: rgb(124,123,123); font-size: 18px;">
                            パスワード再設定
                        </span>
                    </div>
                    <div class="card-body text-center">
                        @include('errors')
                        @if (session('status'))
                            <div class="card-text alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="card-text">
                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf

                                <div class="md-form">
                                    <label for="email">メールアドレス</label>
                                    <input class="form-control submit" type="text" id="email" name="email" required>
                                </div>
                                <button class="btn submit-btn my-2" type="submit"style="background-color: rgb(	0,200,179); color: #fff;" >メール送信</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('footer')
@endsection
