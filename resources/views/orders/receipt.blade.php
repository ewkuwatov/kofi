@extends('layouts.app')

@section('title', 'Заказ принят — KOFI / 02')

@section('content')
@php($pickupLabels = ['asap' => 'Как можно скорее', '15-min' => 'Через 15 минут', '30-min' => 'Через 30 минут', '45-min' => 'Через 45 минут'])
<section class="receipt-page"><span class="receipt-icon">✳</span><span class="eyebrow">СПАСИБО, {{ mb_strtoupper($order->customer_name) }}!</span><h1>Мы уже<br><em>ставим чашки.</em></h1><p>Предзаказ принят. Если понадобится уточнить детали, мы позвоним на {{ $order->phone }}.</p><div class="receipt-card"><span class="receipt-label">ЗАКАЗ · #{{ str_pad((string) $order->id, 5, '0', STR_PAD_LEFT) }}</span>@foreach ($order->lines as $line)<div class="receipt-line"><span>{{ $line->name }} <small>× {{ $line->quantity }}</small></span><strong>{{ number_format($line->price * $line->quantity, 0, ',', ' ') }} сум</strong></div>@endforeach<div class="receipt-line"><span>Время самовывоза</span><strong>{{ $pickupLabels[$order->pickup_slot] ?? $order->pickup_slot }}</strong></div><div class="summary-total"><span>К оплате на кассе</span><strong>{{ number_format($order->total, 0, ',', ' ') }} сум</strong></div></div><a class="button button-dark" href="{{ route('menu') }}">Выбрать ещё что-нибудь <span>↗</span></a></section>
@endsection
