<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Contact Form</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/common.css') }}" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Gorditas:wght@400;700&family=Inika:wght@400;700&family=Noto+Serif+JP:wght@200..900&display=swap" rel="stylesheet">

  @yield('css')
</head>

<body>
  <header class="header">
    <div class="header__inner">
      <a class="header__logo" href="/">
        FashionablyLate
      </a>
      <div class="header__auth">
        @if(request()->is('admin*'))
          <!-- ログイン済み（管理画面など）の場合 -->
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="header__button">logout</button>
          </form>
        @else
            @if (request()->routeIs('register'))
              <!-- 登録ページの場合はログインだけ -->
              <form method="GET" action="{{ route('login') }}">
                <button type="submit" class="header__button">login</button>
              </form>
            @elseif (request()->routeIs('login'))
              <!-- ログインページの場合は登録だけ -->
              <form method="GET" action="{{ route('register') }}">
                <button type="submit" class="header__button">register</button>
              </form>
            @endif
        @endif
      </div>
    </div>
  </header>

  <main>
    @yield('content')
  </main>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>