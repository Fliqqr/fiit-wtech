<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Admin Panel - Products</title>
        @vite([
            'resources/css/admin.css',
            'resources/css/products.css',
            'resources/css/base.css',
            'resources/css/header.css',
            'resources/css/footer.css'
        ])
    </head>
    <body>
        <header>
            <a href="{{route('home')}}" class="logo">eShop Admin</a>
            <div class="navbar-actions">
                <div class="account"><a href="logout">🔒 Logout</a></div>
            </div>
        </header>

        <div class="content-wrapper">
            <div class="container">
                <div class="sidebar">
                    <h2>Admin - Manage Products</h2>
                    <form id="add-product-form" class="admin-form">
                        <h3>Add New Product</h3>
                        <label
                            >Product Name:
                            <input type="text" name="product-name" required
                        /></label>
                        <label
                            >Description:
                            <textarea name="description" required></textarea>
                        </label>
                        <label
                            >Price: <input type="number" name="price" required
                        /></label>
                        <label
                            >Stock Amount:
                            <input type="number" name="stock" required
                        /></label>
                        <label
                            >Images: <input type="file" name="images" multiple
                        /></label>
                        <button type="submit">Add Product</button>
                    </form>
                </div>

                <div class="products-section">
                    <h2>Product List</h2>
                    <div class="products-grid">
                        <div class="product">
                            <a href="{{route('item')}}">
                                <img
                                    src="../images/nvidia-rtx-3080.jpg"
                                    alt="NVIDIA Geforce RTX 3080"
                                />
                                <p>NVIDIA Geforce RTX 3080</p>
                            </a>
                            <div class="admin-actions">
                                <a href="{{route('edit_product')}}" class="edit-btn"
                                    >✏️ Edit</a
                                >
                            </div>
                        </div>

                        <div class="product">
                            <a href="{{route('item')}}">
                                <img
                                    src="../images/nvidia-rtx-4070ti.jpg"
                                    alt="NVIDIA Geforce RTX 4070 TI"
                                />
                                <p>NVIDIA Geforce RTX 4070 TI</p>
                            </a>
                            <div class="admin-actions">
                                <a href="{{route('edit_product')}}" class="edit-btn"
                                    >✏️ Edit</a
                                >
                            </div>
                        </div>

                        <div class="product">
                            <a href="{{route('item')}}">
                                <img
                                    src="../images/nvidia-rtx-4090.jpg"
                                    alt="NVIDIA Geforce RTX 4090"
                                />
                                <p>NVIDIA Geforce RTX 4090</p>
                            </a>
                            <div class="admin-actions">
                                <a href="{{route('edit_product')}}" class="edit-btn"
                                    >✏️ Edit</a
                                >
                            </div>
                        </div>

                        <div class="product">
                            <a href="{{route('item')}}">
                                <img
                                    src="../images/nvidia-rtx-5070ti.jpg"
                                    alt="NVIDIA Geforce RTX 5070 TI"
                                />
                                <p>NVIDIA Geforce RTX 5070 TI</p>
                            </a>
                            <div class="admin-actions">
                                <a href="{{route('edit_product')}}" class="edit-btn"
                                    >✏️ Edit</a
                                >
                            </div>
                        </div>

                        <div class="product">
                            <a href="{{route('item')}}">
                                <img
                                    src="../images/amd-rx-7600.jpg"
                                    alt="AMD Radeon RX 7600 XT"
                                />
                                <p>AMD Radeon RX 7600 XT</p>
                            </a>
                            <div class="admin-actions">
                                <a href="{{route('edit_product')}}" class="edit-btn"
                                    >✏️ Edit</a
                                >
                            </div>
                        </div>

                        <div class="product">
                            <a href="{{route('item')}}">
                                <img
                                    src="../images/amd-rx-7600xt.jpg"
                                    alt="AMD Radeon RX 7600"
                                />
                                <p>AMD Radeon RX 7600</p>
                            </a>
                            <div class="admin-actions">
                                <a href="{{route('edit_product')}}" class="edit-btn"
                                    >✏️ Edit</a
                                >
                            </div>
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
