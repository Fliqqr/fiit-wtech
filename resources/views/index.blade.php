<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>eShop Landing Page</title>
    @vite(['resources/css/index.css', 'resources/css/base.css', 'resources/css/header.css', 'resources/css/footer.css'])
</head>

<body>
    <header>
        @include('partials.header')
    </header>
    <div class="content-wrapper">
        <div class="main">
            <a href="{{ route('products.index', ['Component' => 'GPU']) }}" class="category">
                <img src="../images/gpu/amd-rx-7600xt.jpg" alt="GPUs" />
                <span>GPUs</span>
            </a>
            <a href="{{ route('products.index', ['Component' => 'CPU']) }}" class="category">
                <img src="../images/cpu/ryzen_9_7900.webp" alt="CPUs" />
                <span>CPUs</span>
            </a>
            <a href="{{ route('products.index', ['Component' => 'RAM']) }}" class="category">
                <img src="../images/ram/ram1.webp" alt="RAM" />
                <span>RAM</span>
            </a>
        </div>
    </div>

    <footer>
        <p>&copy; 2025 eShop. All rights reserved.</p>
        <p>Contact | Privacy Policy | Terms of Service</p>
    </footer>
</body>

</html>
