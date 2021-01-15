<ul class="nav nav-tabs nav-justified mt-3">
  <li class="nav-item">
    <a class="nav-link text-muted tab-text {{ $hasPlans ? 'active' : '' }}" href="{{ route('users.show', ['name' => $user->name]) }}">
      企画したオフ会
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link text-muted tab-text {{ $hasInterests ? 'active' : '' }}" href="{{ route('users.interests', ['name' => $user->name]) }}">
      興味あり！のオフ会
    </a>
  </li>
</ul>
