<a href="{{ route('home') }}" class="logo">eShop</a>
<form action="{{ route('products.index') }}" method="GET" class="search-bar">
    <input type="text" name="search" placeholder="Search products..." value="{{ request('search') }}">
    <button type="submit">🔍</button>
</form>
<div class="navbar-actions">
    @auth
        @if(auth()->user()->is_admin)
            <a href="{{ route('admin.index') }}" class="admin">⚙️ Admin</a>
        @endif
    @endauth

    <a href="{{ route('cart') }}" class="cart">🛒</a>

    @guest
        <a href="{{ route('login') }}" class="account">👤 Account</a>
    @endguest

    @auth
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="logout">🔓 Logout</button>
        </form>
    @endauth
</div>
