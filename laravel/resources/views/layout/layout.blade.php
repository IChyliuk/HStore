<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <link rel="stylesheet" href={{ asset('css/style.css') }}>
</head>
<body>

<!-- Header -->
<header class="site-header">
    <div class="container header-container">
        <img class="logo" src="{{ asset('images/logo.png') }}" alt="Hoofman Store">
        <nav class="main-nav">
            <a href="/shop">Магазин</a>
            <a href="/profile">Профиль</a>
            <a href="/support">Поддержка</a>
        </nav>
    </div>
</header>
<main class="main-content">
    @yield('Main')
</main>
<!-- Footer -->
<footer class="site-footer">
    <div class="container">
        &copy; {{ date('Y') }} Hoofman Store. Все права защищены.
    </div>
</footer>

</body>
</html>
