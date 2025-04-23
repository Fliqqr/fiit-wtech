<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login - eShop</title>
    @vite([
        'resources/css/login.css',
        'resources/css/base.css',
        'resources/css/header.css',
        'resources/css/footer.css'
    ])
  </head>
  <body>
    <header>
      <a href="{{route('home')}}" class="logo">eShop</a>
      <div class="search-bar">
        <input type="text" placeholder="Search products..." />
        <button type="submit">🔍</button>
      </div>
      <div class="navbar-actions">
        <div class="cart"><a href="{{route('cart')}}">🛒</a></div>
          <div class="account">
              @guest
                  <a href="{{ route('login')}}">👤 Account</a>
              @endguest
              @auth
                  <form method="POST" action="{{ route("logout") }}">
                    @csrf
                      <button type="submit">🔓 Logout</button>
                  </form>
              @endauth
          </div>
      </div>
    </header>

    <div class="login-container">
      <div class="login-box">
        <h2>Login</h2>
          <form method="POST" action="{{ route('login') }}">
              <input type="email" name="email" placeholder="Email" required>
              <input type="password" name="password" placeholder="Password" required>
              <button type="submit">Login</button>
              @csrf

              @if ($errors->any())
                  <div class="form-errors">
                      <ul>
                          @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
              @endif
          </form>
        <div class="login-links">
          <a href="{{route('register')}}">Register</a>
        </div>
      </div>
    </div>

    <footer>
      <p>&copy; 2025 eShop. All rights reserved.</p>
      <p>Contact | Privacy Policy | Terms of Service</p>
    </footer>
  </body>
</html>
