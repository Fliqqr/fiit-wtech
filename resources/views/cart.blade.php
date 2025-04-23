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

    <div class="cart-container">
      <div class="progress-bar">
        <span class="active">Shopping cart</span>
        <span>&rarr;</span>
        <span>Delivery</span>
        <span>&rarr;</span>
        <span>Payment</span>
      </div>

        <div class="cart-items">
            @foreach ($cartItems as $item)
                <div class="cart-item">
                    <div class="item-image">
                        <img src="{{ $item->product->image_url ?? '/images/placeholder.jpg' }}" alt="{{ $item->product->name }}">
                    </div>
                    <div class="item-details">
                        <p>{{ $item->product->name }}</p>
                        <div class="item-row">
                            <div class="quantity">
                                <form method="POST" action="{{ route('cart.update', $item->id) }}" style="display: flex; align-items: center;">
                                    @csrf
                                    <button type="submit" name="amount" value="{{ $item->amount - 1 }}" {{ $item->amount <= 1 ? 'disabled' : '' }}>-</button>
                                    <span style="margin: 0 10px;">{{ $item->amount }}</span>
                                    <button type="submit" name="amount" value="{{ $item->amount + 1 }}">+</button>
                                </form>
                            </div>
                            <div class="item-controls">
                                <div class="item-price">{{ number_format($item->product->price * $item->amount, 2) }} €</div>
                                <form method="POST" action="{{ route('cart.remove', $item->id) }}">
                                    @csrf
                                    <button class="remove-item" type="submit">×</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            @if ($cartItems->isEmpty())
                <p>Your cart is empty.</p>
            @endif
        </div>

      <div class="cart-footer">
        <div class="cart-total">
            <span>Total</span>
            <span>{{number_format($cartItems->sum(fn($item) => $item->product->price * $item->amount), 2)}} €</span>
        </div>
        <div class="cart-actions">
          <a href="{{route('products.index')}}">Back to product page</a>
          <a href="{{route('delivery')}}">Continue</a>
        </div>
      </div>
    </div>

    <footer>
      <p>&copy; 2025 eShop. All rights reserved.</p>
      <p>Contact | Privacy Policy | Terms of Service</p>
    </footer>
  </body>
</html>
