@extends('app')

@section('title', 'プラン一覧')

@section('content')
  @include('nav')
  <div class="container">
    @foreach($plans as $plan)
      @include('plans.smallcard')
    @endforeach
  </div>
@endsection
