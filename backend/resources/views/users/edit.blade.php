@extends('app')

@section('title', 'アカウント編集')

@section('content')
  @include('nav')
  <div class="container">
    <div class="row">
      <div class="mx-auto col col-12 col-sm-12 col-md-12 col-lg-10 col-xl-9">
        <div class="card mt-3 text-center">
          <div class="card-header">
            <span style="color: rgb(124,123,123); font-size: 18px;">
              アカウント編集
            </span>
          </div>
          <div class="card-body text-left">
            @include('errors')
            <div class="card-text">
              <form method="POST" action="{{ route('users.update', ['name' => $user->name]) }}" enctype="multipart/form-data">
                @method('PATCH')
                @csrf

                <div class="md-form mt-5">
                  <label for="name">
                    {{ __('Name') }}
                    <span class="ml-2" style="font-size: 7px; color: #fff; background-color: #FF367F; border-radius: 5px; padding: 2px; position: relative; bottom: 2px;">
                      ※必須
                    </span>
                  </label>
                  <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name ?? old('name') }}" required autocomplete="name" autofocus>
                  @error('name')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>

                <div class="md-form mt-5">
                  <label for="email" class="mb-3">
                    {{ __('E-Mail Address') }}
                    <span class="ml-2" style="font-size: 7px; color: #fff; background-color: #FF367F; border-radius: 5px; padding: 2px; position: relative; bottom: 2px;">
                      ※必須
                    </span>
                  </label>
                  <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email ?? old('email') }}" required autocomplete="email">
                  @error('email')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>

                <div class="form-group mt-5">
                  <label for="introduction">
                    {{ __('Introduction') }}
                  </label>
                  <textarea id="introduction" type="introduction" class="form-control @error('introduction') is-invalid @enderror" name="introduction" rows="5" placeholder="【例】こんにちは。東京都在住、２５歳、山田太郎です！趣味は〇〇なので〇〇好きな方と仲良くなれたらと思います。よろしくお願いします。" autocomplete="off">
                    {{ $user->introduction ?? old('introduction') }}
                  </textarea>
                  @error('introduction')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>

                <div class="form-group mt-5 d-flex flex-column">
                  <label for="profile_img" class="mb-2">
                    プロフィール画像
                  </label>
                  <input type="file" name="profile_img" accept="image/png, image/jpeg, image/jpg" class="@error('profile_img') is-invalid @enderror">
                  @error('profile_img')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
                <img id="preview" src="{{ $user->profile_img ? $user->profile_img : '/storage/noimage.png' }}" style="width: 120px; height: 120px;">
                <button type="submit" class="btn submit-btn mt-5 mb-2">
                  更新
                </button>
              </form>
              <div class="text-center mt-5 mb-3">
                <a href="{{ route('user.password.edit') }}" class="card-text atag_gray">
                  パスワードの変更はこちら
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @include('footer')
@endsection
