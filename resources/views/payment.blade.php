<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Payment - eShop</title>
    @vite([
        'resources/css/payment.css', 
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

<div class="payment-container">
    <div class="progress-bar">
        <span>Shopping cart</span>
        <span>&rarr;</span>
        <span>Delivery</span>
        <span>&rarr;</span>
        <span class="active">Payment</span>
    </div>

    <div class="payment-content">
        <div class="summary-panel">
            <h2>Order Summary</h2>
            <div class="cart-summary">
                <h3>Items</h3>
                <div class="cart-item">
                    <span>Product name 1</span>
                    <span>55 €</span>
                </div>
                <div class="cart-item">
                    <span>Product name 2</span>
                    <span>10 €</span>
                </div>
                <div class="cart-item">
                    <span>Product name 3</span>
                    <span>5 €</span>
                </div>
            </div>
            <div class="delivery-summary">
                <h3>Delivery Address</h3>
                <div class="delivery-item">Pavol Mrkva</div>
                <div class="delivery-item">Hlavna 2</div>
                <div class="delivery-item">Bratislava, 821 06</div>
                <div class="delivery-item">Slovakia</div>
            </div>
            <div class="total-summary">
                <h3>Total</h3>
                <div class="total-item">
                    <span>Subtotal</span>
                    <span>70 €</span>
                </div>
                <div class="total-item">
                    <span>Delivery (Home Delivery)</span>
                    <span>5 €</span>
                </div>
                <div class="total-item sum">
                    <span>Total</span>
                    <span>75 €</span>
                </div>
            </div>
        </div>

        <div class="payment-panel">
            <h2>Payment Method</h2>
            <form class="payment-form">
                <div class="payment-options">
                    <label>
                        <input type="radio" name="payment" value="credit-card" required />
                        Credit Card
                    </label>
                    <label>
                        <input type="radio" name="payment" value="paypal" />
                        PayPal
                    </label>
                    <label>
                        <input type="radio" name="payment" value="bank-transfer" />
                        Bank Transfer
                    </label>
                </div>
                <div class="payment-details">
                    <p>Please select a payment method to proceed.</p>
                </div>
            </form>
        </div>
    </div>

    <div class="payment-actions">
        <a href="delivery">Back to Delivery</a>
        <button onclick="alert('Order confirmed! Thank you for shopping with eShop.'); window.location.href='/';">Confirm Order</button>
    </div>
</div>

<footer>
    <p>&copy; 2025 eShop. All rights reserved.</p>
    <p>Contact | Privacy Policy | Terms of Service</p>
</footer>
</body>
</html>