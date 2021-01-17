<div class="card mt-3">
  <div class="card-body">
    <div class="d-flex flex-row" style="position: relative;">
      <a href="{{ route('users.show', ['name' => $person->name]) }}" class="text-dark d-flex">
        <i class="fas fa-user-circle fa-3x"></i>
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