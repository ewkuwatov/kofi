@extends('layouts.app')

@section('title', 'Меню — KOFI / 02')

@section('content')
<section class="page-intro"><span class="eyebrow">ОТ БАРА С ЛЮБОВЬЮ</span><h1>В меню —<br><em>только хорошее.</em></h1><p>Зерно небольших ферм, сезонная выпечка и напитки, которые можно взять с собой или выпить на месте.</p><div class="intro-meta"><span>КАЖДЫЙ ДЕНЬ</span><span>СВЕЖАЯ ОБЖАРКА</span><span>СДЕЛАНО В ТАШКЕНТЕ</span></div></section>
<section class="menu-content"><nav class="menu-filters" aria-label="Категории меню"><a class="{{ $activeCategory === '' ? 'active' : '' }}" href="{{ route('menu') }}">Всё меню</a>@foreach ($categories as $key => $label)<a class="{{ $activeCategory === $key ? 'active' : '' }}" href="{{ route('menu', ['category' => $key]) }}">{{ $label }}</a>@endforeach</nav><div class="menu-note"><span>{{ $items->count() }} позиций</span><span>Меню может меняться по сезону ↗</span></div><div class="item-grid menu-grid">@forelse ($items as $item)@include('partials.item-card', ['item' => $item])@empty<div class="empty-menu"><span>☕</span><h2>Эта полка пока пустая.</h2><p>Выберите другую категорию — что-нибудь вкусное обязательно найдётся.</p><a class="button button-dark" href="{{ route('menu') }}">Показать всё меню <span>↗</span></a></div>@endforelse</div><div class="menu-bottom"><span>Уточняйте состав и наличие у бариста.</span><span>Цены указаны в сумах.</span></div></section>
@endsection
