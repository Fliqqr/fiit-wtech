<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite(['resources/css/edit.css', 'resources/css/base.css', 'resources/css/header.css', 'resources/css/footer.css'])
    <title>Edit Product - Admin Panel</title>
</head>

<body>
    <header>
        <a href="{{ route('home') }}" class="logo">eShop Admin</a>
        <div class="navbar-actions">
            <div class="account">
                @auth
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit">🔓 Logout</button>
                    </form>
                @endauth
            </div>
        </div>
    </header>

    <div class="content-wrapper">
        <form class="product-edit-form" action="{{ route('product.update', $product->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="product-view">
                <div class="product-gallery">
                    <label for="main-image">Main Image URL:</label>
                    <input type="text" id="main-image" name="main_image"
                        value="{{ old('main_image', $product->image_url) }}" />

                    <div class="thumbnail-container">
                        @foreach ($product->additional_images ?? [] as $i => $thumb)
                            <label for="thumbnail{{ $i + 1 }}">Thumbnail {{ $i + 1 }} URL:</label>
                            <input type="text" id="thumbnail{{ $i + 1 }}" name="thumbnails[]"
                                value="{{ $thumb }}" />
                        @endforeach
                    </div>
                </div>

                <div class="product-details">
                    <label for="product-name">Product Name:</label>
                    <input type="text" id="product-name" name="product_name"
                        value="{{ old('product_name', $product->name) }}" />

                    <label for="price">Price:</label>
                    <input type="text" id="price" name="price"
                        value="{{ old('price', number_format($product->price, 2)) }}" />

                    <label for="stock">Stock Count:</label>
                    <input type="number" id="stock" name="stock" value="{{ old('stock', $product->in_stock) }}"
                        min="0" />

                    <label for="description">Description:</label>
                    <textarea id="description" name="description" rows="5">{{ old('description', $product->description) }}</textarea>

                    <div class="technical-details">
                        <h2>Technical Specifications</h2>
                        <label for="specifications">Specifications (one per line):</label>
                        <textarea id="specifications" name="specifications" rows="10">{{ old('specifications', is_array($product->specifications) ? implode("\n", $product->specifications) : $product->specifications) }}</textarea>
                    </div>

                    <div class="add-to-cart-section">
                        <label for="default-quantity">Default Quantity:</label>
                        <input type="number" id="default-quantity" name="default_quantity"
                            value="{{ old('default_quantity', $product->default_quantity ?? 1) }}" min="1" />
                    </div>
                </div>
            </div>

            <button type="submit" class="save-button">Save Changes</button>
        </form>
    </div>

    <footer>
        <p>&copy; 2025 eShop. All rights reserved.</p>
        <p>Contact | Privacy Policy | Terms of Service</p>
    </footer>
</body>

</html>
