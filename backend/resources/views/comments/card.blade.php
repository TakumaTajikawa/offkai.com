@forelse ($comments as $comment)
  <li class="list-group-item">
    <div class="pt-3 w-100 d-flex">
      <a href="{{ route('users.show', ['name' => $comment->user->name]) }}" class="in-link text-dark">
        @if($comment->user->profile_img)
          <img src="{{ $comment->user->profile_img }}" alt="プロフィール画像" style="width: 50px; height: 50px; border-radius: 30px;">
        @else
          <i class="fas fa-user-circle fa-3x"></i>
        @endif
      </a>
      <div class="ml-3 d-flex flex-column p-2 pr-4  comment-flame" style="background-color: rgb(239,242,245); border-radius: 10px">
        <div class="d-flex">
          <a href="{{ route('users.show', ['name' => $comment->user->name]) }}" class="in-link text-dark">
            <p class="font-weight-bold mb-0" style="font-size: 14px;">
              {{ $comment->user->name }}
            </p>
          </a>

          @if( Auth::id() === $comment->user_id || Auth::id() === $plan->user_id )
            <!-- dropdown -->
            <div class="ml-auto card-text hide-d">
              <div class="dropdown">
                <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-ellipsis-v"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                  <a class="dropdown-item text-danger" data-toggle="modal" data-target="#modal-delete-{{ $comment->id }}">
                    <i class="fas fa-trash-alt mr-1"></i>コメントを削除する
                  </a>
                </div>
              </div>
            </div>
            <!-- dropdown -->

            <!-- modal -->
            <div id="modal-delete-{{ $comment->id }}" class="modal fade" tabindex="-1" role="dialog">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <form method="POST" action="{{ route('comments.destroy', ['comment' => $comment]) }}">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body">
                      コメントを削除します。よろしいですか？
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
        <p class="mb-0">
          {!! nl2br(e($comment->text)) !!}
        </p>
      </div>
      <div class="d-flex justify-content-end flex-grow-1">
      </div>
    </div>
    <p class="mb-0 font-weight-lighter" style="margin-left: 70px; font-size: 12px;">
      {{ $comment->created_at->format('Y-m-d H:i') }}
    </p>
  </li>
@empty
  <li class="list-group-item ">
    <p class="mb-0">コメントはまだありません</p>
  </li>
@endforelse