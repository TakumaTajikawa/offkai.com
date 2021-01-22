@extends('app')

@section('title', 'パスワード変更')

@section('content')
  @include('nav')
  <div class="container">
    <div class="row">
      <div class="mx-auto col col-12 col-sm-11 col-md-9 col-lg-7 col-xl-6">
        <div class="card mt-3 text-center">
          <div class="card-header">
            <span style="color: rgb(124,123,123); font-size: 18px;">
              パスワード変更
            </span>
          </div>
          <div class="card-body text-center">
            @include('errors')
            <div class="card-text">
              <form method="POST" action="{{ route('user.password.update') }}">
                @csrf
                <div class="md-form mt-5">
                  <label for="password">
                    現在のパスワード
                  </label>
                  <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="current-password" required autofocus autocomplete="new-password">
                  @error('password')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>

                <div class="md-form mt-5">
                  <label for="password">
                    新しいパスワード
                  </label>
                  <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="new-password" required autocomplete="new-password">
                  @error('password')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>

                <div class="md-form mt-5">
                  <label for="password">
                    新しいパスワード（確認用）
                  </label>
                  <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="new-password_confirmation" required autocomplete="new-password">
                  @error('password')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>

              <button type="submit" class="btn submit-btn mt-5 mb-2">
                  変更
              </button> 
          </form>
        </div>
      </div>
    </div>
  </div>
  @include('footer')
@endsection
