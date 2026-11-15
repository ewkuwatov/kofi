<?php

namespace App\Http\Controllers;

use App\Models\CafeOrder;
use App\Models\CafeOrderLine;
use App\Models\CoffeeItem;
use App\Models\Subscriber;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class SiteController extends Controller
{
    private const CATEGORIES = [
        'espresso' => 'Эспрессо-бар',
        'filter' => 'Фильтр',
        'cold' => 'Холодный кофе',
        'bakery' => 'К выпечке',
    ];

    public function home(): View
    {
        $featured = CoffeeItem::query()
            ->where('is_available', true)
            ->where('is_featured', true)
            ->orderBy('sort_order')
            ->take(4)
            ->get();

        return view('home', compact('featured'));
    }

    public function menu(Request $request): View
    {
        $category = $request->query('category', '');
        $items = CoffeeItem::query()->where('is_available', true);

        if (array_key_exists($category, self::CATEGORIES)) {
            $items->where('category', $category);
        }

        return view('menu.index', [
            'items' => $items->orderBy('sort_order')->orderBy('name')->get(),
            'categories' => self::CATEGORIES,
            'activeCategory' => $category,
        ]);
    }

    public function addToCart(Request $request, CoffeeItem $coffeeItem): RedirectResponse
    {
        abort_unless($coffeeItem->is_available, 404);

        $validated = $request->validate(['quantity' => ['nullable', 'integer', 'min:1', 'max:8']]);
        $cart = (array) $request->session()->get('cart', []);
        $id = (string) $coffeeItem->id;
        $cart[$id] = min(8, (int) ($cart[$id] ?? 0) + (int) ($validated['quantity'] ?? 1));
        $request->session()->put('cart', $cart);

        return back()->with('status', $coffeeItem->name.' добавлен в заказ.');
    }

    public function cart(Request $request): View
    {
        return view('cart.index', $this->cartData($request));
    }

    public function updateCart(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'quantities' => ['nullable', 'array'],
            'quantities.*' => ['required', 'integer', 'min:0', 'max:8'],
        ]);

        $cart = (array) $request->session()->get('cart', []);
        foreach (($validated['quantities'] ?? []) as $id => $quantity) {
            if ((int) $quantity === 0) {
                unset($cart[(string) $id]);
            } elseif (ctype_digit((string) $id)) {
                $cart[(string) $id] = (int) $quantity;
            }
        }
        $request->session()->put('cart', $cart);

        return redirect()->route('cart')->with('status', 'Заказ обновлён.');
    }

    public function checkout(Request $request): View|RedirectResponse
    {
        $data = $this->cartData($request);
        if ($data['items']->isEmpty()) {
            return redirect()->route('menu')->with('status', 'Добавьте что-нибудь из меню перед оформлением.');
        }

        return view('cart.checkout', $data);
    }

    public function placeOrder(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'customer_name' => ['required', 'string', 'max:120'],
            'phone' => ['required', 'string', 'max:40'],
            'email' => ['nullable', 'email', 'max:254'],
            'pickup_slot' => ['required', Rule::in(['asap', '15-min', '30-min', '45-min'])],
            'comment' => ['nullable', 'string', 'max:500'],
        ]);

        $cart = (array) $request->session()->get('cart', []);
        if ($cart === []) {
            return redirect()->route('menu')->with('status', 'Корзина пуста — выберите напитки из меню.');
        }

        $order = DB::transaction(function () use ($cart, $validated): ?CafeOrder {
            $products = CoffeeItem::query()
                ->whereIn('id', array_keys($cart))
                ->where('is_available', true)
                ->get()
                ->keyBy(fn (CoffeeItem $item): string => (string) $item->id);

            if ($products->isEmpty()) {
                return null;
            }

            $total = 0;
            foreach ($products as $item) {
                $total += $item->price * min(8, max(1, (int) ($cart[(string) $item->id] ?? 1)));
            }

            $order = CafeOrder::create([
                'uuid' => (string) Str::uuid(),
                'customer_name' => $validated['customer_name'],
                'phone' => $validated['phone'],
                'email' => $validated['email'] ?? null,
                'pickup_slot' => $validated['pickup_slot'],
                'comment' => $validated['comment'] ?? null,
                'status' => 'new',
                'total' => $total,
            ]);

            foreach ($products as $item) {
                CafeOrderLine::create([
                    'cafe_order_id' => $order->id,
                    'coffee_item_id' => $item->id,
                    'name' => $item->name,
                    'size' => $item->size,
                    'price' => $item->price,
                    'quantity' => min(8, max(1, (int) ($cart[(string) $item->id] ?? 1))),
                ]);
            }

            return $order;
        });

        if (! $order) {
            return redirect()->route('menu')->with('status', 'Позиции из заказа уже закончились. Выберите что-нибудь ещё.');
        }

        $request->session()->forget('cart');

        return redirect()->route('orders.receipt', $order->uuid);
    }

    public function receipt(string $uuid): View
    {
        $order = CafeOrder::query()->with('lines')->where('uuid', $uuid)->firstOrFail();

        return view('orders.receipt', compact('order'));
    }

    public function subscribe(Request $request): RedirectResponse
    {
        $validated = $request->validate(['email' => ['required', 'email', 'max:254']]);
        Subscriber::query()->firstOrCreate(['email' => mb_strtolower($validated['email'])]);

        return back()->with('status', 'Готово. Иногда будем присылать новости из кофейни.');
    }

    private function cartData(Request $request): array
    {
        $cart = (array) $request->session()->get('cart', []);
        $products = CoffeeItem::query()
            ->whereIn('id', array_keys($cart))
            ->where('is_available', true)
            ->get();

        $items = $products->map(function (CoffeeItem $product) use ($cart): array {
            $quantity = min(8, max(1, (int) ($cart[(string) $product->id] ?? 1)));

            return [
                'product' => $product,
                'quantity' => $quantity,
                'lineTotal' => $quantity * $product->price,
            ];
        });

        return ['items' => $items, 'total' => $items->sum('lineTotal')];
    }
}
