@extends('app')

@section('title', 'プラン詳細')

@section('content')
  @include('nav')
  <div class="container">
    @include('plans.card')
  </div>
@endsection
