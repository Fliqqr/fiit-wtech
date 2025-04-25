<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Products - eShop</title>
    @vite(['resources/css/products.css', 'resources/css/base.css', 'resources/css/header.css', 'resources/css/footer.css'])
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <header>
        <a href="{{ route('home') }}" class="logo">eShop</a>
        <div class="search-bar">
            <input type="text" id="search-input" placeholder="Search products..." value="{{ request('search') }}">
            <button onclick="applyFilters()">🔍</button>
        </div>
        <div class="navbar-actions">
            <div class="cart"><a href="{{ route('cart') }}">🛒</a></div>
            <div class="account">
                @guest
                    <a href="{{ route('login') }}">👤 Account</a>
                @endguest
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
        <div class="container-wrapper">
            <div class="sidebar">
                <h3>Filters</h3>

                <form id="filters-form" method="GET" action="{{ route('products.index') }}">
                    <input type="hidden" name="search" id="search-hidden" value="{{ request('search') }}">

                    <label for="sort-select">Sort By:</label>
                    <select id="sort-select" name="sort">
                        <option value="price-asc" {{ request('sort') == 'price-asc' ? 'selected' : '' }}>Price: Low to
                            High</option>
                        <option value="price-desc" {{ request('sort') == 'price-desc' ? 'selected' : '' }}>Price: High
                            to Low</option>
                        <option value="date-asc" {{ request('sort') == 'date-asc' ? 'selected' : '' }}>Oldest First
                        </option>
                        <option value="date-desc" {{ request('sort') == 'date-desc' ? 'selected' : '' }}>Newest First
                        </option>
                    </select>

                    <label for="price-range">Max Price: <span
                            id="price-value">{{ request('max_price', 100) }}</span></label>
                    <input type="range" id="price-range" name="max_price" min="0" max="1000"
                        value="{{ request('max_price', 100) }}" step="10"
                        oninput="document.getElementById('price-value').innerText = this.value" />

                    <label><input type="checkbox" name="in_stock" {{ request('in_stock') ? 'checked' : '' }} /> In
                        Stock</label><br />

                    @foreach ($categories as $categoryType => $categoryGroup)
                        <label for="category-{{ $categoryType }}">{{ ucfirst($categoryType) }}</label>
                        <select id="category-{{ $categoryType }}" name="{{ $categoryType }}">
                            <option value="all">All {{ ucfirst($categoryType) }}</option>
                            @foreach ($categoryGroup as $category)
                                <option value="{{ $category }}"
                                    {{ request($categoryType) == $category ? 'selected' : '' }}>
                                    {{ $category }}
                                </option>
                            @endforeach
                        </select>
                    @endforeach

                    <button type="submit">Apply Filters</button>
                </form>
            </div>

            <div class="products-section">
                <h2>Products</h2>
                <div class="products-grid">
                    @foreach ($products as $product)
                        <div class="product">
                            <a href="{{ url('/item?id=' . $product->id) }}">
                                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" />
                                <p>{{ $product->name }}</p>
                                <p>{{ $product->price }}€</p>
                            </a>
                        </div>
                    @endforeach
                </div>

                <div class="pagination">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>

    <footer>
        <p>&copy; 2025 eShop. All rights reserved.</p>
        <p>Contact | Privacy Policy | Terms of Service</p>
    </footer>

    <script>
        // When user presses Enter in the search bar, submit the filters form
        document.getElementById('search-input').addEventListener('keydown', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault(); // Prevent default form submission if it's inside a <form>
                document.getElementById('search-hidden').value = this.value;
                document.getElementById('filters-form').submit();
            }
        });
    </script>
</body>

</html>
