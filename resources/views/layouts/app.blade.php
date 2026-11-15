<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#f3eee5">
    <meta name="description" content="KOFI / 02 — кофе, который делает день чуть лучше. Specialty кофе, завтраки и самовывоз в Ташкенте.">
    <title>@yield('title', 'KOFI / 02 — кофе, без спешки')</title>
    <link rel="icon" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 64 64'%3E%3Crect width='64' height='64' rx='32' fill='%232e332a'/%3E%3Ctext x='50%25' y='56%25' dominant-baseline='middle' text-anchor='middle' font-family='Georgia' font-size='32' fill='%23e0a15f'%3Ek%3C/text%3E%3C/svg%3E">
    <link rel="stylesheet" href="{{ asset('css/site.css') }}">
    <script defer src="{{ asset('js/site.js') }}"></script>
    @stack('head')
</head>
<body>
    <div class="topline"><span>ТАШКЕНТ · КАЖДЫЙ ДЕНЬ 08:00 — 22:00</span><span>КОФЕ — ЭТО ПАУЗА, А НЕ ГОНКА</span><a href="tel:+998901112222">+998 90 111 22 22</a></div>
    <header class="header">
        <a class="logo" href="{{ route('home') }}" aria-label="KOFI / 02 — главная"><span class="logo-symbol">k<span>.</span></span><span class="logo-name">KOFI <small>/ 02</small><i>coffee, slowly</i></span></a>
        <button class="nav-toggle" type="button" aria-expanded="false" aria-label="Открыть меню"><span></span><span></span></button>
        <nav class="nav" aria-label="Основное меню"><a href="{{ route('menu') }}">Меню</a><a href="{{ route('home') }}#story">О нас</a><a href="{{ route('home') }}#visit">Где мы</a></nav>
        <div class="header-right"><a class="hours" href="{{ route('home') }}#visit">Сегодня открыты <strong>до 22:00</strong></a><a class="cart-nav" href="{{ route('cart') }}">Заказ <span>{{ array_sum(session('cart', [])) }}</span></a></div>
    </header>

    @if (session('status'))
        <div class="flash" role="status"><span>{{ session('status') }}</span><button type="button" aria-label="Закрыть уведомление">×</button></div>
    @endif

    @if ($errors->any())
        <div class="flash flash-error" role="alert"><span>Проверьте поля формы — кое-что нужно поправить.</span><button type="button" aria-label="Закрыть уведомление">×</button></div>
    @endif

    <main>@yield('content')</main>

    <footer class="footer">
        <div class="footer-main"><div class="footer-brand"><a class="logo logo-inverse" href="{{ route('home') }}"><span class="logo-symbol">k<span>.</span></span><span class="logo-name">KOFI <small>/ 02</small><i>coffee, slowly</i></span></a><p>Зёрна с историей.<br>Кофе с настроением.</p></div>
            <div class="footer-column"><span class="footer-head">ПОСМОТРЕТЬ</span><a href="{{ route('menu') }}">Меню</a><a href="{{ route('home') }}#story">Наша философия</a><a href="{{ route('home') }}#visit">Как нас найти</a></div>
            <div class="footer-column"><span class="footer-head">ЗАГЛЯНУТЬ</span><span>Ташкент, ул. Садовая, 14</span><span>Каждый день · 08:00 — 22:00</span><a href="tel:+998901112222">+998 90 111 22 22</a></div>
            <div class="footer-news"><span class="footer-head">ЗАПИСКИ ИЗ КОФЕЙНИ</span><p>Новое зерно, сезонное меню и немного хороших новостей.</p><form action="{{ route('newsletter') }}" method="post" class="newsletter">@csrf<label class="sr-only" for="footer-email">Ваш email</label><input id="footer-email" type="email" name="email" placeholder="Ваш email" required><button type="submit" aria-label="Подписаться">↗</button></form></div>
        </div>
        <div class="footer-bottom"><span>© {{ date('Y') }} KOFI / 02 · Ташкент</span><span>Сделано без спешки. Сварено с любовью.</span><a href="{{ route('studio.index') }}">Для команды ↗</a></div>
    </footer>
</body>
</html>
