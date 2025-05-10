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
        @include('partials.header')
    </header>

    <div class="content-wrapper">
        <form class="product-edit-form" action="{{ route('product.update', $product->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="product-view">
                <div class="product-gallery">
                    <label for="main-image">Main Image:</label>
                    <input type="file" id="main-image" name="main_image" accept="image/*" />

                    <p>Current Main Image:</p>
                    <img src="{{ asset('storage/' . $product->image_url) }}" alt="Main Image" width="150" />

                    <div class="thumbnail-container">
                        <p>Additional Images:</p>
                        @foreach ($product->additional_images ?? [] as $i => $thumb)
                            <div class="thumb-group">
                                <img src="{{ asset('storage/' . $thumb) }}" alt="Thumbnail {{ $i + 1 }}"
                                    width="100" />
                                <label>
                                    <input type="checkbox" name="delete_thumbnails[]" value="{{ $thumb }}" />
                                    Remove
                                </label>
                            </div>
                        @endforeach

                        <label for="new-thumbnails">Add New Thumbnails:</label>
                        <input type="file" name="new_thumbnails[]" id="new-thumbnails" accept="image/*" multiple />
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

                    <div class="category-section">
                        <h3>Categories</h3>
                        @php
                            $selectedNames = $product->categories->pluck('name')->toArray();
                            $allCategories = \App\Models\ProductCategory::getCategoriesAsMap();
                        @endphp

                        @foreach ($allCategories as $type => $names)
                            <div class="category-group">
                                <strong>{{ $type }}</strong><br>
                                @foreach ($names as $name)
                                    <label>
                                        <input type="checkbox" name="categories[{{ $type }}][]"
                                            value="{{ $name }}"
                                            {{ in_array($name, $selectedNames) ? 'checked' : '' }}>
                                        {{ $name }}
                                    </label><br>
                                @endforeach
                            </div>
                        @endforeach
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
