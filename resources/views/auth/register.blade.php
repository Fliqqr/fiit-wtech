<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register page - eShop</title>
    @vite([
        'resources/css/register.css',
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
                  <a href="{{ route('home')}}">🔓 Logout</a>
              @endauth
          </div>
      </div>
    </header>

    <div class="register-container">
      <div class="register-box">
        <h2>Register</h2>
        <form method="POST" action="{{ route('register') }}">
            <input type="text" name="name" placeholder="Your name" required />
            <input type="email" name="email" placeholder="E-mail" required />
            <input type="password" name="password" placeholder="Password" required />
            <input type="password" name="password_confirmation" placeholder="Confirm Password" required />
            <button type="submit">Register</button>
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
        <div class="register-links">
          <a href="{{route('login')}}">Already have an account? Login</a>
        </div>
      </div>
    </div>

    <footer>
      <p>&copy; 2025 eShop. All rights reserved.</p>
      <p>Contact | Privacy Policy | Terms of Service</p>
    </footer>
  </body>
</html>
