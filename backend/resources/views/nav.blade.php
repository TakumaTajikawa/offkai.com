<nav class="navbar navbar-expand navbar-dark mb-4" style="background-color: rgb(0,200,179);">

  <a class="nvn navbar-brand font-weight-bold" href="/" style="font-size: 18px;">オフ会<span style="font-size: 23px; font-weight: normal;">.c</span><i class="far fa-smile" style="font-size: 16px;"></i><span style="font-size: 23px; font-weight: normal;">m</span></a>
  
  <ul class="navbar-nav ml-auto normal-menu">
    @guest
      <li class="nav-item">
        <a class="nav-link py-1 px-2 nav-link-custom" href="{{ route('register') }}"><i class="fas fa-user-plus"> ユーザー登録</i></a>
      </li>

      <li class="nav-item">
        <a class="nav-link py-1 px-2 ml-3 nav-link-custom" href="{{ route('login') }}"><i class="fas fa-sign-in-alt"> ログイン</i></a>
      </li>

      <li class="nav-item">
        <a class="nav-link py-1 px-2 ml-3 nav-link-custom" href="{{ route('login.guest') }}"><i class="fas fa-check-square"> ゲストログイン</i></a>
      </li>
    @endguest

    @auth
      <li class="nav-item">
        <a class="nav-link plans-create-link py-1 px-2 ml-3 nav-link-custom" href="{{ route('plans.create') }}">
          <i class="fas fa-pen mr-1"> オフ会プランを投稿</i>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link plans-create-link py-1 px-2 ml-3 nav-link-custom" href="{{ route('plans.search') }}">
        <i class="fas fa-search"> オフ会を検索</i>
        </a>
      </li>
    @endauth

    @auth
      <!-- Dropdown -->
      <li class="nav-item dropdown ml-2">
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

<nav class="globalMenuSp">
  <ul class="globalMenuSp-ul">
    @guest
      <li>
        <a href="{{ route('register') }}">
          <i class="fas fa-user-plus"> 
            ユーザー登録
          </i>
        </a>
      </li>
      <li>
        <a href="{{ route('login') }}">
          <i class="fas fa-sign-in-alt"> 
            ログイン
          </i>
        </a>
      </li>
      <li>
        <a href="{{ route('login.guest') }}">
          <i class="fas fa-check-square"> 
            ゲストログイン
          </i>
        </a>
      </li>
    @endguest
    @auth
      <li>
        <a href="{{ route('plans.create') }}">
          <i class="fas fa-pen mr-1"> 
            オフ会プランを投稿
          </i>
        </a>
      </li>
      <li>
        <a href="{{ route('plans.search') }}">
          <i class="fas fa-search"> 
            オフ会を検索
          </i>
        </a>
      </li>
      <li>
        <a href="{{ route('users.show', ['name' => Auth::user()->name]) }}">
          <i class="fas fa-user"> 
            マイページ
          </i>
        </a>
      </li>
      <li>
        <button form="logout-button" type="submit" class="logout-link">
          <i class="fas fa-sign-out-alt"> 
            ログアウト
          </i>
        </button>
        <form id="logout-button" method="POST" action="{{ route('logout') }}">
      </li>
    @endauth
  </ul>
</nav>

<div class="hamburger">
  <span></span>
  <span></span>
  <span></span>
</div>



