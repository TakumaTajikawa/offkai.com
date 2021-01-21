<div class="card mt-3">
  <div class="card-body">
    <div class="d-flex flex-row">
      <a href="{{ route('users.show', ['name' => $user->name]) }}" class="text-dark">
        @if($user->profile_img)
          <img src="{{ $user->profile_img }}" alt="プロフィール画像">
        @else
          <i class="fas fa-user-circle fa-3x"></i>
        @endif
      </a>
      <p>{{ $user->profile_img }}</p>
      <h5 class="h5 card-title m-0 font-weight-bold" style="font-size: 18px; line-height: 49px;">
        <a href="{{ route('users.show', ['name' => $user->name]) }}" class="text-dark" style="margin-left: 15px;">
          {{ $user->name }}
        </a>
      </h5>
      <p style="line-height: 49px; font-size: 12px; margin-left: 10px;">
        （{{ $user->gender }}性）
      </p>
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
  <div class="card-body pt-0">
    <div class="card-text">
      <a href="{{ route('users.followings', ['name' => $user->name]) }}" class="ml-4 font-weight-bold" style="color: black; font-size: 17px;">
        {{ $user->count_followings }} <span class="font-weight-normal" style="font-size: 14px;">フォロー</span>
      </a>
      <a href="{{ route('users.followers', ['name' => $user->name]) }}" class="ml-4 font-weight-bold" style="color: black; font-size: 17px;">
        {{ $user->count_followers }} <span class="font-weight-normal" style="font-size: 14px;">フォロワー</span>
      </a>
      <p class="mb-0" style="white-space: pre-wrap;">
        {{ $user->introduction }}
      </p>
      @if( Auth::id() !== $user->id )
        <follow-button
          class="ml-auto"
          :initial-is-followed-by='@json($user->isFollowedBy(Auth::user()))'
          :authorized='@json(Auth::check())'
          endpoint="{{ route('users.follow', ['name' => $user->name]) }}"
        >
        </follow-button>
      @endif
    </div>
  </div>
</div>
