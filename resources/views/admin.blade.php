<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Panel - Products</title>
    @vite(['resources/css/admin.css', 'resources/css/products.css', 'resources/css/base.css', 'resources/css/header.css', 'resources/css/footer.css'])
    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body>
    <header>
        <a href="{{ route('home') }}" class="logo">eShop Admin</a>
        <div class="navbar-actions">
            <div class="account"><a href="logout">🔒 Logout</a></div>
        </div>
    </header>

    <div class="content-wrapper">
        <div class="container-wrapper">
            <div class="sidebar">
                <h2>Admin - Manage Products</h2>
                <form id="add-product-form" class="admin-form" method="POST" action="{{ route('product.new') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <h3>Add New Product</h3>
                    <label>Product Name:
                        <input type="text" name="name" required /></label>
                    <label>Description:
                        <textarea name="description" required></textarea>
                    </label>
                    <label>Price: <input type="number" name="price" required /></label>
                    <label>Stock Amount:
                        <input type="number" name="stock" required /></label>

                    <label>Images: <input type="file" name="images[]" multiple /></label>

                    <!-- Category selection -->
                    @foreach ($categories as $categoryType => $categoryGroup)
                        <fieldset class="category-group">
                            <legend>{{ ucfirst($categoryType) }}</legend>
                            @foreach ($categoryGroup as $category)
                                <label>
                                    <input type="checkbox" name="categories[{{ $categoryType }}][]"
                                        value="{{ $category }}">
                                    {{ $category }}
                                </label>
                            @endforeach
                        </fieldset>
                    @endforeach

                    <button type="submit">Add Product</button>
                </form>
            </div>

            <div class="products-section">
                <h2>Products</h2>
                <div class="products-grid">
                    @foreach ($products as $product)
                        <div class="product">
                            <a href="{{ url('/edit-product?id=' . $product->id) }}">
                                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" />
                                <p>{{ $product->name }}</p>
                                <p>{{ $product->price }}€</p>
                            </a>
                        </div>
                    @endforeach
                </div>

                <div class="pagination">
                    {{ $products->onEachSide(3)->links() }}
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
