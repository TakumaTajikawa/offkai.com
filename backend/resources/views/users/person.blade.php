<div class="card mt-3">
  <div class="card-body">
    <div class="d-flex flex-row" style="position: relative;">
      <a href="{{ route('users.show', ['name' => $person->name]) }}" class="text-dark d-flex">
        @if($person->profile_img)
          <img src="{{ $person->profile_img }}" alt="プロフィール画像" style="width: 50px; height: 50px; border-radius: 30px;">
        @else
          <i class="fas fa-user-circle fa-3x"></i>
        @endif
      </a>
      <h5 class="card-title m-0 font-weight-bold" style="font-size: 16px; line-height: 49px;">
        <a href="{{ route('users.show', ['name' => $person->name]) }}" class="text-dark" style="margin-left: 15px;">
          {{ $person->name }}
        </a>
      </h5>
      @if( Auth::id() !== $person->id )
        <follow-button
          style="position: absolute; top: 50%; right: 0; -webkit-transform : translateY(-50%); transform: translateY(-50%);"
          :initial-is-followed-by='@json($person->isFollowedBy(Auth::user()))'
          :authorized='@json(Auth::check())'
          endpoint="{{ route('users.follow', ['name' => $person->name]) }}"
        >
        </follow-button>
      @endif
    </div>
  </div>
</div>