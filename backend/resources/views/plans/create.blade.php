@extends('app')

@section('title', 'オフ会投稿 - オフ会.com')

@section('content')
  @include('nav')
  <div class="container">
    <div class="row">
      <div class="mx-auto col col-12 col-sm-12 col-md-12 col-lg-10 col-xl-9">
        <div class="card mt-3">
          <div class="card-body pt-0">
            @include('errors')
            <div class="card-text">
              <form method="POST" action="{{ route('plans.store') }}" enctype="multipart/form-data">
                @include('plans.form')
                <button type="submit" class="btn submit-btn">投稿する</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @include('footer')
@endsection
