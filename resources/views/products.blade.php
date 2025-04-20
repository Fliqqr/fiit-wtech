<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Products - eShop</title>
    <link rel="stylesheet" href="./css/base.css" />
    <link rel="stylesheet" href="./css/products.css" />
    <link rel="stylesheet" href="./css/header.css" />
    <link rel="stylesheet" href="./css/footer.css" />
  </head>
  <body>
    <header>
      <a href="index.html" class="logo">eShop</a>
      <div class="search-bar">
        <input type="text" placeholder="Search products..." />
        <button type="submit">🔍</button>
      </div>
      <div class="navbar-actions">
        <div class="cart"><a href="cart.html">🛒</a></div>
        <div class="account"><a href="login.html">👤 Account</a></div>
      </div>
    </header>

    <div class="content-wrapper">
      <div class="container">
        <div class="sidebar">
          <h3>Filters</h3>

          <label for="sort-select">Sort By:</label>
          <select id="sort-select">
            <option value="price-asc">Price: Low to High</option>
            <option value="price-desc">Price: High to Low</option>
            <option value="date-asc">Release Date: Oldest First</option>
            <option value="date-desc">Release Date: Newest First</option>
          </select>

          <label for="price-range"
            >Max Price: <span id="price-value">100</span></label
          >
          <input
            type="range"
            id="price-range"
            min="0"
            max="1000"
            value="100"
            step="10"
            oninput="document.getElementById('price-value').innerText = this.value"
          />

          <label><input type="checkbox" /> In Stock</label><br />
          <label><input type="checkbox" /> On Sale</label><br />

          <label for="brand-select">Brand:</label>
          <select id="brand-select">
            <option value="all">All Brands</option>
            <option value="nvidia">NVIDIA</option>
            <option value="amd">AMD</option>
            <option value="intel">Intel</option>
          </select>
        </div>

        <div class="products-section">
          <h2>Products</h2>
          <div class="products-grid">
            <div class="product">
              <a href="./item.html">
                <img
                  src="../images/nvidia-rtx-3080.jpg"
                  alt="NVIDIA Geforce RTX 3080"
                />
                <p>NVIDIA Geforce RTX 3080</p>
              </a>
            </div>
            <div class="product">
              <a href="./item.html">
                <img
                  src="../images/nvidia-rtx-4070ti.jpg"
                  alt="NVIDIA Geforce RTX 4070 TI"
                />
                <p>NVIDIA Geforce RTX 4070 TI</p>
              </a>
            </div>

            <div class="product">
              <a href="./item.html">
                <img
                  src="../images/nvidia-rtx-4090.jpg"
                  alt="NVIDIA Geforce RTX 4090"
                />
                <p>NVIDIA Geforce RTX 4090</p>
              </a>
            </div>
            <div class="product">
              <a href="./item.html">
                <img
                  src="../images/nvidia-rtx-5070ti.jpg"
                  alt="NVIDIA Geforce RTX 5070 TI"
                />
                <p>NVIDIA Geforce RTX 5070 TI</p>
              </a>
            </div>
            <div class="product">
              <a href="./item.html">
                <img
                  src="../images/amd-rx-7600.jpg"
                  alt="AMD Radeon RX 7600 XT"
                />
                <p>AMD Radeon RX 7600 XT</p>
              </a>
            </div>
            <div class="product">
              <a href="./item.html">
                <img
                  src="../images/amd-rx-7600xt.jpg"
                  alt="AMD Radeon RX 7600"
                />
                <p>AMD Radeon RX 7600</p>
              </a>
            </div>
          </div>

          <div class="pagination">
            <a href="#" class="active">1</a>
            <a href="#">2</a>
            <a href="#">3</a>
            <a href="#">Next &rarr;</a>
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
