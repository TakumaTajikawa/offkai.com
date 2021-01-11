@extends('app')

@section('title', 'アカウント編集')

@section('content')
  @include('nav')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">アカウント編集</div>
          <div class="card-body">
            @include('errors')
            <form method="POST" action="{{ route('users.update', ['name' => $user->name]) }}" enctype="multipart/form-data">
              @method('PATCH')
              @csrf
              <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}<span style="font-size: 12px; padding-left: 10px;">※必須</span></label>

                <div class="col-md-6">
                  <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name ?? old('name') }}" required autocomplete="name" autofocus>
                  @error('name')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>

              <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}<span style="font-size: 12px; padding-left: 10px;">※必須</span></label>

                <div class="col-md-6">
                  <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email ?? old('email') }}" required autocomplete="email">

                  @error('email')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>

              <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Introduction') }}</label>

                <div class="col-md-6">
                  <textarea id="introduction" type="introduction" class="form-control @error('introduction') is-invalid @enderror" name="introduction" value="{{ $user->introduction ?? old('introduction') }}" rows="5" placeholder="【例】こんにちは。東京都在住、２５歳、山田太郎です！趣味は〇〇なので〇〇好きな方と仲良くなれたらと思います。よろしくお願いします。" autocomplete="off"></textarea>

                  @error('introduction')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>

              <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                  <button type="submit" class="btn btn-primary">
                    編集を完了する
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
