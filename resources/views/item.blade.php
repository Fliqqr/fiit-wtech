<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./css/base.css" />
    <link rel="stylesheet" href="./css/header.css" />
    <link rel="stylesheet" href="./css/footer.css" />
    <link rel="stylesheet" href="./css/item.css" />
    <title>GPU Details - eShop</title>
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
      <div class="product-view">
        <div class="product-gallery">
          <img
            src="../images/nvidia-rtx-4090.jpg"
            alt="NVIDIA RTX 4090 GPU"
            class="main-image"
          />
          <div class="thumbnail-container">
            <img
              src="../images/nvidia-rtx-4070ti.jpg"
              alt="NVIDIA RTX 4070 Ti"
              class="thumbnail"
            />
            <img
              src="../images/nvidia-rtx-3080.jpg"
              alt="NVIDIA RTX 3080"
              class="thumbnail"
            />
          </div>
        </div>

        <div class="product-details">
          <h1>NVIDIA GeForce RTX 4090</h1>
          <p class="price">$1,599.99</p>
          <p class="stock">Stock left: <span class="stock-count">15</span></p>
          <p class="description">
            Experience unparalleled gaming and rendering performance with the
            NVIDIA GeForce RTX 4090. Built with the latest Ada Lovelace
            architecture, it features 24GB GDDR6X memory, 16,384 CUDA cores, and
            advanced ray-tracing capabilities for an immersive experience.
          </p>

          <div class="technical-details">
            <h2>Technical Specifications</h2>
            <ul>
              <li>GPU Architecture: Ada Lovelace</li>
              <li>Memory: 24GB GDDR6X</li>
              <li>CUDA Cores: 16,384</li>
              <li>Boost Clock: 2.52 GHz</li>
              <li>Ray Tracing Cores: 3rd Generation</li>
              <li>DLSS: 3.0</li>
              <li>Power Consumption: 450W</li>
              <li>Recommended PSU: 850W</li>
              <li>Outputs: HDMI 2.1, DisplayPort 1.4a</li>
            </ul>
          </div>

          <div class="add-to-cart-section">
            <input type="number" class="quantity-input" value="1" min="1" />
            <button class="add-to-cart">Add to Cart</button>
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
