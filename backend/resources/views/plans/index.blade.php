@extends('app')

@section('title', 'プラン一覧')

@section('content')
  @include('nav')
  <div class="container">
    <div class="row">
      <div class="mx-auto col col-12 col-sm-12 col-md-12 col-lg-10 col-xl-9">
        @foreach($plans as $plan)
          @include('plans.smallcard')
        @endforeach
      </div>
    </div>
  </div>
  @include('footer')
@endsection
