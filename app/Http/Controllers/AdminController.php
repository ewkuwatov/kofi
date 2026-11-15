<?php

namespace App\Http\Controllers;

use App\Models\CafeOrder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function index(): View
    {
        $orders = CafeOrder::query()->with('lines')->latest()->paginate(20);

        return view('studio.index', ['orders' => $orders, 'statuses' => CafeOrder::STATUSES]);
    }

    public function updateStatus(Request $request, CafeOrder $cafeOrder): RedirectResponse
    {
        $validated = $request->validate(['status' => ['required', Rule::in(array_keys(CafeOrder::STATUSES))]]);
        $cafeOrder->update(['status' => $validated['status']]);

        return redirect()->route('studio.index')->with('status', 'Статус заказа обновлён.');
    }
}
