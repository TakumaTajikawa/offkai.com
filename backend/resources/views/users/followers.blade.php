@extends('app')

@section('title', $user->name . 'のフォロワー - オフ会.com')

@section('content')
  @include('nav')
  <div class="container">
    <div class="row">
      <div class="mx-auto col col-12 col-sm-12 col-md-12 col-lg-10 col-xl-9">
        @include('users.user')
        @include('users.tabs', ['hasPlans' => false, 'hasInterests' => false])
        @forelse($followers as $person)
          @include('users.person')
        @empty
          <div class="card mb-4">
            <div class="card-body text-center py-5" style="color: rgb(108,117,125);">
              まだフォロワーはいません
            </div>
          </div>
        @endforelse
      </div>
    </div>
  </div>
  @include('footer')
@endsection