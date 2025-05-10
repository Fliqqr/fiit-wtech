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
        @include('partials.header')
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
                    @foreach ($cartItems as $item)
                        <div class="cart-item">
                            <span>{{ $item->amount }}x {{ $item->product->name }}</span>
                            <span>{{ number_format($item->product->price * $item->amount, 2) }} €</span>
                        </div>
                    @endforeach
                </div>
                <div class="delivery-summary">
                    <h3>Delivery Address</h3>
                    <div class="delivery-item">{{ $user->full_name }}</div>
                    <div class="delivery-item">{{ $user->address }}</div>
                    <div class="delivery-item">{{ $user->city }}, {{ $user->postal_code }}</div>
                    <div class="delivery-item">{{ $user->country }}</div>
                </div>
                <div class="total-summary">
                    <h3>Total</h3>
                    <div class="total-item">
                        <span>Subtotal</span>
                        <span>{{ number_format($subtotal, 2) }} €</span>
                    </div>
                    <div class="total-item">
                        <span>Delivery ({{ ucfirst($delivery) }})</span>
                        <span>{{ number_format($deliveryPrice, 2) }} €</span>
                    </div>
                    <div class="total-item sum">
                        <span>Total</span>
                        <span>{{ number_format($total, 2) }} €</span>
                    </div>
                </div>
            </div>

            <div class="payment-panel">
                <h2>Payment Method</h2>
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
            </div>
        </div>

        <div class="payment-footer">
            <div class="confirm-check">
                <label>
                    <input type="checkbox" id="confirmCheckbox" />
                    I confirm my personal and order information is correct.
                </label>
            </div>
            <div class="payment-actions">
                <a href="{{ route('delivery') }}">Back to Delivery</a>
                <button type="button" id="confirmButton" disabled>Confirm Order</button>
            </div>
        </div>
    </div>

    <footer>
        <p>&copy; 2025 eShop. All rights reserved.</p>
        <p>Contact | Privacy Policy | Terms of Service</p>
    </footer>

    <script>
        const checkbox = document.getElementById('confirmCheckbox');
        const button = document.getElementById('confirmButton');

        checkbox.addEventListener('change', () => {
            button.disabled = !checkbox.checked;
        });

        button.addEventListener('click', () => {
            //  Check confirmation checkbox
            if (!checkbox.checked) {
                alert("Please confirm your information before placing the order.");
                return;
            }

            // Check if a payment method is selected
            const selectedPayment = document.querySelector('input[name="payment"]:checked');
            if (!selectedPayment) {
                alert("Please select a payment method.");
                return;
            }

            // All good
            alert("Order confirmed! Thank you for shopping with eShop.");
            window.location.href = "{{ route('cart.confirm') }}";
        });
    </script>

</body>
</html>
