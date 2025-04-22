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
      <a href="/" class="logo">eShop</a>
      <div class="search-bar">
        <input type="text" placeholder="Search products..." />
        <button type="submit">🔍</button>
      </div>
      <div class="navbar-actions">
        <div class="cart"><a href="cart">🛒</a></div>
        <div class="account"><a href="login">👤 Account</a></div>
      </div>
    </header>

    <div class="register-container">
      <div class="register-box">
        <h2>Register</h2>
        <form>
          <input type="email" placeholder="E-mail" required />
          <input type="password" placeholder="Password" required />
          <input type="password" placeholder="Confirm Password" required />
          <button type="submit">Register</button>
        </form>
        <div class="register-links">
          <a href="login">Already have an account? Login</a>
        </div>
      </div>
    </div>

    <footer>
      <p>&copy; 2025 eShop. All rights reserved.</p>
      <p>Contact | Privacy Policy | Terms of Service</p>
    </footer>
  </body>
</html>
