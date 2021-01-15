@extends('app')

@section('title', $tag->name)

@section('content')
  @include('nav')
  <div class="container">
    <div class="card my-3">
      <div class="card-body">
        <div class="text-center">
          <span class="card-title m-0 border p-1 mr-2 my-1 text-muted" style="border-radius: 3px; color: rgb(88, 88, 88)!important; border-color: rgb(88, 88, 88)!important; background-color: rgb(243, 243, 243); font-size: 30px;">
            {{ $tag->name }}
          </span>
        </div>
        <div class="card-text text-right">
          投稿{{ $tag->plans->count() }}件
        </div>
      </div>
    </div>
    @foreach($tag->plans as $plan)
      @include('plans.smallcard')
    @endforeach
  </div>
  @include('footer')
@endsection
