<nav class="globalMenuSp">
  <ul class="globalMenuSp-ul">
    @guest
      <li>
        <a href="{{ route('plans.search') }}">
          <i class="fas fa-search"> 
            オフ会を検索
          </i>
        </a>
      </li>
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
        <form id="logout-form-2" method="POST" action="{{ route('logout') }}">
          @csrf
          <button form="logout-form-2" type="submit" class="logout-link">
            <i class="fas fa-sign-out-alt"> 
              ログアウト
            </i>
          </button>
        </form>
      </li>
    @endauth
  </ul>
</nav>