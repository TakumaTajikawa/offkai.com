@extends('app')

@section('title', 'プラン詳細')

@section('content')
  @include('nav')
  <div class="container">
    <div class="mb-3">
      @include('plans.card')
    </div>
    <div class="mb-3">
      <div class="card mt-3">
        <div class="card-body" style="padding: 0;">
          <ul style="padding: 0; margin: 0;">
            @auth
              <!-- コメント投稿フォーム -->
              @include('comments.form')
            @endauth
          </ul>
        </div>
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
@endsection
