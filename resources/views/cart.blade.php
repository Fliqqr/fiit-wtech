<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Shopping Cart - eShop</title>
    @vite([
        'resources/css/cart.css', 
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

    <div class="cart-container">
      <div class="progress-bar">
        <span class="active">Shopping cart</span>
        <span>&rarr;</span>
        <span>Delivery</span>
        <span>&rarr;</span>
        <span>Payment</span>
      </div>

      <div class="cart-items">
        <div class="cart-item">
          <div class="item-image">
            <img src="../images/GPU.jpg" alt="GPU">
          </div>
          <div class="item-details">
            <p>Nvidia Graphics card</p>
            <div class="item-row">
              <div class="quantity">
                <button>-</button>
                <span>2</span>
                <button>+</button>
              </div>
              <div class="item-controls">
                <div class="item-price">55 €</div>
                <button class="remove-item">×</button>
              </div>
            </div>
          </div>
        </div>
        <div class="cart-item">
          <div class="item-image">
            <img src="../images/Computer.jpg" alt="PC">
          </div>
          <div class="item-details">
            <p>Pre-Built Gaming PC</p>
            <div class="item-row">
              <div class="quantity">
                <button>-</button>
                <span>1</span>
                <button>+</button>
              </div>
              <div class="item-controls">
                <div class="item-price">5 €</div>
                <button class="remove-item">×</button>
              </div>
            </div>
          </div>
        </div>
        <div class="cart-item">
          <div class="item-image">
            <img src="../images/Cpu2.jpg" alt="CPU">
          </div>
          <div class="item-details">
            <p>CPU</p>
            <div class="item-row">
              <div class="quantity">
                <button>-</button>
                <span>3</span>
                <button>+</button>
              </div>
              <div class="item-controls">
                <div class="item-price">10 €</div>
                <button class="remove-item">×</button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="cart-footer">
        <div class="cart-total">
          <span>Total</span>
          <span>80 €</span>
        </div>
        <div class="cart-actions">
          <a href="products">Back to product page</a>
          <a href="delivery">Continue</a>
        </div>
      </div>
    </div>

    <footer>
      <p>&copy; 2025 eShop. All rights reserved.</p>
      <p>Contact | Privacy Policy | Terms of Service</p>
    </footer>
  </body>
</html>
