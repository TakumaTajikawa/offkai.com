@extends('app')

@section('title', $user->name)

@section('content')
  @include('nav')
  <div class="container">
    @include('users.user')
    @include('users.tabs', ['hasPlans' => true, 'hasInterests' => false])
    @forelse($plans as $plan)
      @include('plans.smallcard')
    @empty
      <div class="card mb-4">
        <div class="card-body text-center py-5" style="color: rgb(108,117,125);">
          企画したオフ会はありません
        </div>
      </div>
    @endforelse
  </div>
  @include('footer')
@endsection
