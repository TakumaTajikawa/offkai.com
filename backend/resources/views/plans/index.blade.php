@extends('app')

@section('title', 'プラン一覧')

@section('content')
  @include('nav')
  <div class="container">
    @foreach($plans as $plan)
      <div class="card mt-3">
        <div class="card-body d-flex flex-row">
          <i class="fas fa-user-circle fa-3x mr-1"></i>
          <div>
            <div class="font-weight-bold">
              {{ $plan->user->name }}
            </div> 
            <div class="font-weight-lighter">
              {{ $plan->created_at->format('Y/m/d H:i') }}
            </div>
          </div>
          @if( Auth::id() === $plan->user_id )
            <!-- dropdown -->
            <div class="ml-auto card-text">
              <div class="dropdown">
                <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <button type="button" class="btn btn-link text-muted m-0 p-2">
                    <i class="fas fa-ellipsis-v"></i>
                  </button>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                  <a class="dropdown-item" href="{{ route('plans.edit', ['plan' => $plan]) }}">
                    <i class="fas fa-pen mr-1"></i>プランを編集する
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item text-danger" data-toggle="modal" data-target="#modal-delete-{{ $plan->id }}">
                    <i class="fas fa-trash-alt mr-1"></i>プランを削除する
                  </a>
                </div>
              </div>
            </div>
            <!-- dropdown -->
    
            <!-- modal -->
            <div id="modal-delete-{{ $plan->id }}" class="modal fade" tabindex="-1" role="dialog">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <form method="POST" action="{{ route('plans.destroy', ['plan' => $plan]) }}">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body">
                      {{ $plan->title }}を削除します。よろしいですか？
                    </div>
                    <div class="modal-footer justify-content-between">
                      <a class="btn btn-outline-grey" data-dismiss="modal">キャンセル</a>
                      <button type="submit" class="btn btn-danger">削除する</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <!-- modal -->
          @endif
        </div>
        <div class="card-body pt-0 pb-2">
          <h3 class="h4 card-title">
            <a class="text-dark" href="{{ route('plans.show', ['plan' => $plan]) }}">
              {{ $plan->title }}
            </a>
          </h3>
          <div class="card-text">
            {!! nl2br(e( $plan->body )) !!}
          </div>
        </div>

        @foreach($plan->tags as $tag)
          @if($loop->first)
            <div class="card-body pt-0 pb-4 pl-3">
              <div class="card-text line-height">
          @endif
                <a href="{{ route('tags.show', ['name' => $tag->name]) }}" class="border p-1 mr-1 mt-1 text-muted">
                  {{ $tag->name }}
                </a>
          @if($loop->last)
              </div>
            </div>
          @endif
        @endforeach

      </div>
    @endforeach
  </div>
@endsection
