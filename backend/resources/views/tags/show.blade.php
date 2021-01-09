@extends('app')

@section('title', $tag->name)

@section('content')
  @include('nav')
  <div class="container">
    <div class="card mt-3">
      <div class="card-body">
        <h2 class="h4 card-title m-0">{{ $tag->name }}</h2>
        <div class="card-text text-right">
          {{ $tag->plans->count() }}件
        </div>
      </div>
    </div>
    @foreach($tag->plans as $plan)
      @include('plans.card')
    @endforeach
  </div>
@endsection
