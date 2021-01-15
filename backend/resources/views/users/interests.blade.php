@extends('app')

@section('title', $user->name . 'の興味あり！のオフ会')

@section('content')
  @include('nav')
  <div class="container">
    @include('users.user')
    @include('users.tabs', ['hasPlans' => false, 'hasInterests' => true])
    @forelse($plans as $plan)
      @include('plans.smallcard')
    @empty
      <div class="card mb-4">
        <div class="card-body text-center py-5" style="color: rgb(108,117,125);">
          興味あり！のオフ会はありません
        </div>
      </div>
    @endforelse
  </div>
  @include('footer')
@endsection
