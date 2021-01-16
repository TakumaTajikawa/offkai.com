<div class="card mt-3">
  <div class="card-body">
    <div class="d-flex flex-row">
      <a href="{{ route('users.show', ['name' => $user->name]) }}" class="text-dark">
        <i class="fas fa-user-circle fa-3x"></i>
      </a>
      <h6 class="h5 card-title m-0 font-weight-bold" style="line-height: 49px; font-size: 18px;">
        <a href="{{ route('users.show', ['name' => $user->name]) }}" class="text-dark" style="margin-left: 15px;">
          {{ $user->name }}
        </a>
      </h6>
      <p style="line-height: 49px; font-size: 12px; margin-left: 10px;">
        （{{ $user->gender }}性）
      </p>
      @if( Auth::id() !== $user->id )
        <follow-button
          class="ml-auto"
          :initial-is-followed-by='@json($user->isFollowedBy(Auth::user()))'
        >
        </follow-button>
      @endif
      @if( Auth::id() === $user->id )
        <!-- dropdown -->
        <div class="ml-auto card-text">
          <div class="dropdown">
            <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-ellipsis-v"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
              <a class="dropdown-item" href="{{ route('users.edit', ['name' => $user->name]) }}">
                <i class="fas fa-pen mr-1"></i>アカウントを編集する
              </a>
            </div>
          </div>
        </div>
        <!-- dropdown -->
      @endif
    </div>
  </div>
  <div class="card-body">
    <div class="card-text">
      <p style="white-space: pre-wrap;">{{ $user->introduction }}</p>
    </div>
  </div>
</div>
