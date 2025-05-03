<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Главная</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<!-- Header -->
<header class="site-header">
    <div class="container header-container">
        <div class="logo">Логотип</div>
        <nav class="main-nav">
            <a href="/shop">Магазин</a>
            <a href="/profile">Профиль</a>
            <a href="/support">Поддержка</a>
        </nav>
    </div>
</header>

<!-- Main -->
<main class="main-content">
    <div class="container">
        <h1>Добро пожаловать!</h1>
        <p>Это главная страница вашего Laravel-приложения.</p>
    </div>
</main>

<!-- Footer -->
<footer class="site-footer">
    <div class="container">
        &copy; {{ date('Y') }} Ваш сайт. Все права защищены.
    </div>
</footer>

</body>
</html>
