@extends('app')

@section('title', $user->name . 'のフォロー中')

@section('content')
  @include('nav')
  <div class="container">
    @include('users.user')
    @include('users.tabs', ['hasPlans' => false, 'hasInterests' => false])
    @forelse($followings as $person)
      @include('users.person')
    @empty
      <div class="card mb-4">
        <div class="card-body text-center py-5" style="color: rgb(108,117,125);">
          まだフォローしていません
        </div>
      </div>
    @endforelse
  </div>
  @include('footer')
@endsection