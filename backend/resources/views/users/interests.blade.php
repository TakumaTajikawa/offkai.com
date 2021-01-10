@extends('app')

@section('title', $user->name . 'の興味あり！のオフ会')

@section('content')
  @include('nav')
  <div class="container">
    @include('users.user')
    @include('users.tabs', ['hasPlans' => false, 'hasInterests' => true])
    @foreach($plans as $plan)
      @include('plans.card')
    @endforeach
  </div>
@endsection
