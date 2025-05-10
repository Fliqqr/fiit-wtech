<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ isset($edit_product) ? 'Edit' : 'Add' }} Product - Admin Panel</title>
    @vite(['resources/css/admin.css', 'resources/css/products.css', 'resources/css/base.css', 'resources/css/header.css', 'resources/css/footer.css'])
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <header>
        <a href="{{ route('home') }}" class="logo">eShop Admin</a>
        <div class="navbar-actions">
            @auth
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="logout">🔓 Logout</button>
                </form>
            @endauth
        </div>
    </header>

    <div class="content-wrapper">
        <div class="container-wrapper">
            <div class="sidebar">
                <h2>{{ isset($edit_product) ? 'Edit' : 'Add New' }} Product</h2>
                <form id="edit_product-form" class="admin-form" method="POST"
                    action="{{ isset($edit_product) ? route('product.update', ['id' => $edit_product->id]) : route('product.new') }}"
                    enctype="multipart/form-data">
                    @csrf
                    @if (isset($edit_product))
                        @method('POST')
                    @endif

                    <label>Product Name:
                        <input type="text" name="name" value="{{ old('name', $edit_product->name ?? '') }}"
                            required />
                    </label>

                    <label>Description:
                        <textarea name="description" required>{{ old('description', $edit_product->description ?? '') }}</textarea>
                    </label>

                    <label>Price: <input type="number" name="price"
                            value="{{ old('price', $edit_product->price ?? '') }}" required /></label>

                    <label>Stock Amount:
                        <input type="number" name="stock" value="{{ old('stock', $edit_product->in_stock ?? '') }}"
                            required />
                    </label>

                    <!-- Image upload for new/edit -->
                    <label>Images:
                        <input type="file" name="images[]" multiple />
                    </label>

                    <!-- Current images (for edit only) -->
                    @if (isset($edit_product) && $edit_product->all_images)
                        <div id="current-images" style="display: flex; gap: 10px; flex-wrap: wrap;">
                            @foreach ($edit_product->all_images as $index => $imagePath)
                                <div class="image-wrapper" style="position: relative;">
                                    <img src="{{ $imagePath }}" alt="Image {{ $index }}"
                                        style="width: 100px; height: auto; border: 1px solid #ccc;">
                                    <button type="button" class="delete-image-btn"
                                        onclick="markImageForDeletion('{{ $imagePath }}', this)"
                                        style="position: absolute; top: 0; right: 0; background: red; color: white; border: none; cursor: pointer;">✖</button>
                                </div>
                            @endforeach
                        </div>

                        <!-- Hidden input that stores which images to delete -->
                        <input type="hidden" name="delete_images" id="delete-images-input" value="">
                    @endif

                    @foreach ($categories as $categoryType => $categoryGroup)
                        <fieldset class="category-group">
                            <legend>{{ ucfirst($categoryType) }}</legend>
                            @foreach ($categoryGroup as $category)
                                <label>
                                    <input type="checkbox" name="categories[{{ $categoryType }}][]"
                                        value="{{ $category }}"
                                        {{ isset($edit_product) && in_array($category, $edit_product->categories->pluck('name')->toArray()) ? 'checked' : '' }}>
                                    {{ $category }}
                                </label>
                            @endforeach
                        </fieldset>
                    @endforeach

                    <button type="submit">{{ isset($edit_product) ? 'Save Changes' : 'Add Product' }}</button>
                </form>
            </div>

            <div class="products-section">
                <h2>Products</h2>
                <div class="products-grid">
                    @foreach ($products as $product)
                        <div class="product">
                            <a href="{{ url('/admin-edit?id=' . $product->id) }}">
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

<script>
    let deletedImages = [];

    function markImageForDeletion(imagePath, buttonElement) {
        deletedImages.push(imagePath);
        document.getElementById('delete-images-input').value = JSON.stringify(deletedImages);
        // Hide the image preview
        buttonElement.closest('.image-wrapper').style.display = 'none';
    }
</script>

</html>
