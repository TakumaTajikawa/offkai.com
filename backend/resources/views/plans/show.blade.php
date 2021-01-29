@extends('app')

@section('title', 'オフ会詳細 - オフ会.com')

@section('content')
  @include('nav')
  <div class="container">
    <div class="row">
      <div class="mx-auto col col-12 col-sm-12 col-md-12 col-lg-10 col-xl-9">
        @include('flash_message')
        <div class="mb-3">
          @include('plans.card')
        </div>
        <div class="card mt-3 mb-3">
          <div class="card-body p-0">
            @auth
              <!-- コメント投稿フォーム -->
              @include('comments.form')
            @endauth
          </div>
        </div>
        <div class="mb-3">
          <div class="card mt-3">
            <div class="card-body" style="padding: 0;">
              <ul style="padding: 0; margin: 0;">
                <!-- コメント一覧 -->
                @include('comments.card')
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @include('footer')
@endsection
