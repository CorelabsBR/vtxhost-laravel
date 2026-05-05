<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $items = CartItem::with('product')
            ->where('user_id', Auth::id())
            ->get();

        $total = $items->sum(fn ($item) => $item->product->preco * $item->quantidade);

        return view('cart.index', compact('items', 'total'));
    }

    public function addPlan($plan)
    {
        $plan = Plan::where('plan', $plan)->firstOrFail();

        $product = Product::where('plan', $plan->plan)->first();

        if (!$product) {
            $product = Product::create([
                'nome' => $plan->name,
                'descricao' => 'Servidor de jogo',
                'preco' => $plan->price / 100,
                'categoria_id' => 2,
                'jogo_id' => $plan->jogo_id,
                'local_id' => $plan->location_id,
                'plan' => $plan->plan,
                'ram' => $plan->ramFormatada(),
                'armazenamento' => $plan->discoFormatado(),
                'processamento' => $plan->cpuFormatada(),
                'ddos_protection' => true,
                'featured' => false,
                'sort_order' => $plan->plan,
            ]);
        }

        if (!$product || !$product->id) {
            abort(500, 'Produto não foi criado corretamente.');
        }

        $item = CartItem::where('user_id', Auth::id())
            ->where('product_id', $product->id)
            ->first();

        if ($item) {
            $item->quantidade++;
            $item->save();
        } else {
            CartItem::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'quantidade' => 1,
            ]);
        }

        return redirect()
            ->route('cart.index')
            ->with('success', 'Plano adicionado ao carrinho.');
    }

    public function add(Request $request, Product $product)
    {
        abort_if(!$product || !$product->id, 404);

        $quantidade = (int) $request->input('quantidade', 1);

        $item = CartItem::where('user_id', Auth::id())
            ->where('product_id', $product->id)
            ->first();

        if ($item) {
            $item->quantidade += $quantidade;
            $item->save();
        } else {
            CartItem::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'quantidade' => $quantidade,
            ]);
        }

        return redirect()->route('cart.index');
    }

    public function update(Request $request, CartItem $cartItem)
    {
        abort_if($cartItem->user_id !== Auth::id(), 403);

        $request->validate([
            'quantidade' => 'required|integer|min:1|max:99',
        ]);

        $cartItem->update([
            'quantidade' => $request->quantidade,
        ]);

        return redirect()->route('cart.index');
    }

    public function remove(CartItem $cartItem)
    {
        abort_if($cartItem->user_id !== Auth::id(), 403);

        $cartItem->delete();

        return redirect()->route('cart.index');
    }

    public function clear()
    {
        CartItem::where('user_id', Auth::id())->delete();

        return redirect()->route('cart.index');
    }
}