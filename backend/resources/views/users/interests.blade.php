@extends('app')

@section('title', $user->name . 'の興味あり！のオフ会')

@section('content')
  @include('nav')
  <div class="container">
    @include('users.user')
    <ul class="nav nav-tabs nav-justified mt-3">
      <li class="nav-item">
        <a class="nav-link text-muted" href="{{ route('users.show', ['name' => $user->name]) }}">
          投稿したオフ会
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-muted active" href="{{ route('users.interests', ['name' => $user->name]) }}">
          興味あり！
        </a>
      </li>
    </ul>
    @foreach($plans as $plan)
      @include('plans.card')
    @endforeach
  </div>
@endsection
