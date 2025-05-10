<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite(['resources/css/item.css', 'resources/css/base.css', 'resources/css/header.css', 'resources/css/footer.css'])
    <title>{{ $product->name }} - eShop</title>
</head>

<body>
    <header>
        @include('partials.header')
    </header>

    <div class="content-wrapper">
        <div class="product-view">
            <div class="product-gallery">
                <img id="mainImage" src="{{ $product->image_url }}" alt="{{ $product->name }}" class="main-image" />

                @if (!empty($product->additional_images))
                    <div class="thumbnail-container">
                        <!-- Include the original image as the first thumbnail -->
                        <img src="{{ $product->image_url }}" alt="Main image for {{ $product->name }}" class="thumbnail"
                            onclick="document.getElementById('mainImage').src='{{ $product->image_url }}'" />

                        <!-- Loop through additional images -->
                        @foreach ($product->additional_images as $image)
                            <img src="{{ $image }}" alt="Additional image for {{ $product->name }}"
                                class="thumbnail"
                                onclick="document.getElementById('mainImage').src='{{ $image }}'" />
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="product-details">
                <h1>{{ $product->name }}</h1>
                <p class="price">{{ number_format($product->price, 2) }}€</p>
                <p class="stock">Stock left: <span class="stock-count">{{ $product->in_stock }}</span></p>
                <p class="description">{{ $product->description }}</p>

                <div class="product-categories">
                    <h2>Categories</h2>
                    <ul>
                        @foreach ($categories as $category)
                            <li>{{ $category->name }}</li>
                        @endforeach
                    </ul>
                </div>

                {{-- Placeholder for technical specs --}}
                <div class="technical-details">
                    <h2>Technical Specifications</h2>
                    <ul>
                        <li>More specs coming soon...</li>
                    </ul>
                </div>

                <div class="add-to-cart-section">
                    <form method="POST" action="{{ route('cart.add') }}">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="number" name="amount" value="1" min="1" class="quantity-input">
                        <button type="submit" class="add-to-cart">Add to Cart</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <p>&copy; 2025 eShop. All rights reserved.</p>
        <p>Contact | Privacy Policy | Terms of Service</p>
    </footer>
</body>

</html>
