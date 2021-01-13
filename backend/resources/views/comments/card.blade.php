@forelse ($comments as $comment)
  <li class="list-group-item">
    <div class="pt-3 w-100 d-flex">
      <a href="{{ route('users.show', ['name' => $comment->user->name]) }}" class="in-link text-dark">
        <i class="fas fa-user-circle fa-3x"></i>
      </a>
      <div class="ml-3 d-flex flex-column p-2 pr-3" style="background-color: rgb(239,242,245); border-radius: 10px">
        <a href="{{ route('users.show', ['name' => $comment->user->name]) }}" class="in-link text-dark">
          <p class="font-weight-bold mb-0" style="font-size: 14px;">
            {{ $comment->user->name }}
          </p>
        </a>
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
    <p class="mb-0 text-secondary">コメントはまだありません。</p>
  </li>
@endforelse