<article class="item-card">
    <a class="item-photo" href="{{ route('menu', ['category' => $item->category]) }}"><img src="{{ $item->image_url }}" alt="{{ $item->name }}" loading="lazy">@if ($item->is_featured)<span class="item-label">ЛЮБИМЧИКИ БАРИСТА</span>@endif<span class="photo-plus">↗</span></a>
    <div class="item-meta"><div><span class="item-category">{{ $item->tasting_notes }}</span><h3>{{ $item->name }}</h3><p>{{ $item->size }}</p></div><div class="item-side"><strong>{{ number_format($item->price, 0, ',', ' ') }} <small>сум</small></strong><form action="{{ route('cart.add', $item) }}" method="post">@csrf<button class="add" type="submit" aria-label="Добавить: {{ $item->name }}">+</button></form></div></div>
</article>
