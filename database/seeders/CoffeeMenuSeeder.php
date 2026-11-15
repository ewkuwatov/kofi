<?php

namespace Database\Seeders;

use App\Models\CoffeeItem;
use Illuminate\Database\Seeder;

class CoffeeMenuSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'name' => 'Флэт уайт', 'slug' => 'flat-white', 'category' => 'espresso',
                'description' => 'Двойной эспрессо и тонкий слой бархатного молока. Ничего лишнего — только хороший баланс.',
                'tasting_notes' => 'Шоколад · фундук · карамель', 'size' => '200 мл', 'price' => 32000,
                'image_url' => 'https://images.unsplash.com/photo-1461023058943-07fcbe16d735?auto=format&fit=crop&w=900&q=85',
                'is_featured' => true, 'sort_order' => 1,
            ],
            [
                'name' => 'Капучино', 'slug' => 'cappuccino', 'category' => 'espresso',
                'description' => 'Наш фирменный бленд, свежее молоко и мягкая пена. Классика, к которой приятно возвращаться.',
                'tasting_notes' => 'Какао · красное яблоко · мёд', 'size' => '250 мл', 'price' => 30000,
                'image_url' => 'https://images.unsplash.com/photo-1534778101976-62847782c213?auto=format&fit=crop&w=900&q=85',
                'is_featured' => true, 'sort_order' => 2,
            ],
            [
                'name' => 'Эспрессо-тоник', 'slug' => 'espresso-tonic', 'category' => 'cold',
                'description' => 'Холодный тоник, яркий эспрессо и немного цитруса. Освежает и бодрит без лишних слов.',
                'tasting_notes' => 'Апельсин · можжевельник · цитрус', 'size' => '300 мл', 'price' => 36000,
                'image_url' => 'https://images.unsplash.com/photo-1517701604599-bb29b565090c?auto=format&fit=crop&w=900&q=85',
                'is_featured' => true, 'sort_order' => 3,
            ],
            [
                'name' => 'V60 · Эфиопия', 'slug' => 'v60-ethiopia', 'category' => 'filter',
                'description' => 'Лёгкий фильтр с мытой обработкой. Завариваем вручную, чтобы в чашке остались все оттенки зерна.',
                'tasting_notes' => 'Бергамот · жасмин · персик', 'size' => '250 мл', 'price' => 38000,
                'image_url' => 'https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?auto=format&fit=crop&w=900&q=85',
                'is_featured' => true, 'sort_order' => 4,
            ],
            [
                'name' => 'Бамбл', 'slug' => 'bumble', 'category' => 'cold',
                'description' => 'Двойной эспрессо, апельсиновый сок и лёд. Слоистый, яркий, идеальный для солнечной прогулки.',
                'tasting_notes' => 'Апельсин · карамель · лёд', 'size' => '350 мл', 'price' => 39000,
                'image_url' => 'https://images.unsplash.com/photo-1513558161293-cdaf765edfd7?auto=format&fit=crop&w=900&q=85',
                'is_featured' => false, 'sort_order' => 5,
            ],
            [
                'name' => 'Матча-латте', 'slug' => 'matcha-latte', 'category' => 'cold',
                'description' => 'Церемониальная матча из Удзи и молоко на ваш выбор. Можно сделать горячим или со льдом.',
                'tasting_notes' => 'Трава · белый шоколад · умами', 'size' => '300 мл', 'price' => 42000,
                'image_url' => 'https://images.unsplash.com/photo-1515823064-d6e0c04616a7?auto=format&fit=crop&w=900&q=85',
                'is_featured' => false, 'sort_order' => 6,
            ],
            [
                'name' => 'Круассан с миндалём', 'slug' => 'almond-croissant', 'category' => 'bakery',
                'description' => 'Слоёное сливочное тесто, крем франжипан и лепестки миндаля. Выпекаем каждое утро.',
                'tasting_notes' => 'Сливочное масло · миндаль', 'size' => '1 шт.', 'price' => 28000,
                'image_url' => 'https://images.unsplash.com/photo-1555507036-ab1f4038808a?auto=format&fit=crop&w=900&q=85',
                'is_featured' => false, 'sort_order' => 7,
            ],
            [
                'name' => 'Баскский чизкейк', 'slug' => 'basque-cheesecake', 'category' => 'bakery',
                'description' => 'Нежная сливочная серединка и карамельная корочка. Подаём с сезонными ягодами.',
                'tasting_notes' => 'Ваниль · сливки · карамель', 'size' => '1 кусочек', 'price' => 35000,
                'image_url' => 'https://images.unsplash.com/photo-1533134242443-d4fd215305ad?auto=format&fit=crop&w=900&q=85',
                'is_featured' => false, 'sort_order' => 8,
            ],
        ];

        foreach ($items as $item) {
            CoffeeItem::query()->updateOrCreate(['slug' => $item['slug']], $item);
        }
    }
}
