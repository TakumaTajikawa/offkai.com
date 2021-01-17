<nav class="navbar navbar-expand navbar-dark mb-4" style="background-color: rgb(0,200,179);">

  <a class="navbar-brand" href="/">オフ会.com</a>

  <ul class="navbar-nav ml-auto">
    @guest
      <li class="nav-item">
        <a class="nav-link" href="{{ route('register') }}">ユーザー登録</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="{{ route('login') }}">ログイン</a>
      </li>
    @endguest

    @auth
      <li class="nav-item">
        <a class="nav-link plans-create-link" href="{{ route('plans.search') }}">
        <i class="fas fa-search">オフ会を検索</i>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link plans-create-link" href="{{ route('plans.create') }}">
          <i class="fas fa-pen mr-1">オフ会プランを投稿</i>
        </a>
      </li>
    @endauth

    @auth
    <!-- Dropdown -->
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-user-circle"></i>
      </a>
      <div class="dropdown-menu dropdown-menu-right dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
        <button class="dropdown-item" type="button" onclick="location.href='{{ route('users.show', ['name' => Auth::user()->name]) }}'">
          マイページ
        </button>
        <div class="dropdown-divider"></div>
        <button form="logout-button" class="dropdown-item" type="submit">
          ログアウト
        </button>
      </div>
    </li>
    <form id="logout-button" method="POST" action="{{ route('logout') }}">
      @csrf
    </form>
    <!-- Dropdown -->
    @endauth
  </ul>

</nav>
