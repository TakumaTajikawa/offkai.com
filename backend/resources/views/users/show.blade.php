@extends('app')

@section('title', $user->name)

@section('content')
  @include('nav')
  <div class="container">
    @include('users.user')
    @include('users.tabs', ['hasPlans' => true, 'hasInterests' => false])
    @foreach($plans as $plan)
      @include('plans.card')
    @endforeach
  </div>
@endsection
