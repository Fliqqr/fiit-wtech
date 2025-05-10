<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>eShop Landing Page</title>
        @vite([
            'resources/css/index.css',
            'resources/css/base.css',
            'resources/css/header.css',
            'resources/css/footer.css'
        ])
    </head>
    <body>
        <header>
            @include('partials.header')
        </header>
        <div class="content-wrapper">
            <div class="main">
                <a href="{{route('products.index')}}" class="category">
                    <img src="../images/pc.jpg" alt="Pre-built PCs" />
                    <span>Pre-built PCs</span>
                </a>
                <a href="{{route('products.index')}}" class="category">
                    <img src="../images/cpu.jpg" alt="PC Components" />
                    <span>PC Components</span>
                </a>
                <a href="{{route('products.index')}}" class="category">
                    <img src="../images/monitor.jpg" alt="Peripherals" />
                    <span>Peripherals</span>
                </a>
            </div>
        </div>

        <footer>
            <p>&copy; 2025 eShop. All rights reserved.</p>
            <p>Contact | Privacy Policy | Terms of Service</p>
        </footer>
    </body>
</html>
