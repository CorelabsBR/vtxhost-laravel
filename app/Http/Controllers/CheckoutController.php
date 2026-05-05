<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class CheckoutController extends Controller
{
    public function index()
    {
        $items = CartItem::with('product')
            ->where('user_id', Auth::id())
            ->get();

        if ($items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Carrinho vazio.');
        }

        $total = $items->sum(fn ($item) => $item->product->preco * $item->quantidade);

        return view('checkout.index', compact('items', 'total'));
    }

    public function pay()
    {
        $cartItems = CartItem::with('product')
            ->where('user_id', Auth::id())
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Carrinho vazio.');
        }

        $order = DB::transaction(function () use ($cartItems) {
            $total = $cartItems->sum(fn ($item) => $item->product->preco * $item->quantidade);

            $order = Order::create([
                'user_id' => Auth::id(),
                'total' => $total,
                'status' => 'pendente',
            ]);

            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantidade' => $item->quantidade,
                    'preco' => $item->product->preco,
                ]);
            }

            CartItem::where('user_id', Auth::id())->delete();

            return $order;
        });

        $order->load('items.product');

        $mpItems = $order->items->map(fn ($item) => [
            'title' => $item->product->nome,
            'quantity' => (int) $item->quantidade,
            'unit_price' => (float) $item->preco,
            'currency_id' => 'BRL',
        ])->values()->toArray();

        $payload = [
            'items' => $mpItems,
            'external_reference' => (string) $order->id,
            'notification_url' => route('webhooks.mercadopago'),
            'back_urls' => [
                'success' => route('checkout.success'),
                'pending' => route('checkout.pending'),
                'failure' => route('checkout.failure'),
            ],
            'auto_return' => 'approved',
        ];

        $response = Http::withToken(env('MERCADOPAGO_ACCESS_TOKEN'))
            ->post('https://api.mercadopago.com/checkout/preferences', $payload);

        if (!$response->successful()) {
            return redirect()
                ->route('cart.index')
                ->with('error', 'Erro ao gerar pagamento Mercado Pago.');
        }

        $data = $response->json();

        $order->update([
            'mp_pagamento_id' => $data['id'] ?? null,
        ]);

        return redirect()->away($data['init_point']);
    }

    public function success()
    {
        return redirect()->route('cliente.dashboard')->with('success', 'Pagamento aprovado ou em processamento.');
    }

    public function pending()
    {
        return redirect()->route('cliente.dashboard')->with('success', 'Pagamento pendente.');
    }

    public function failure()
    {
        return redirect()->route('checkout.index')->with('error', 'Pagamento não aprovado.');
    }
}