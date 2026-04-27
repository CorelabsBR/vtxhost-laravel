<?php

namespace App\Http\Controllers;

use App\Models\CheckoutSession;
use App\Models\Plan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CartCheckoutController extends Controller
{
    public function checkout($produto)
    {
        $plan = Plan::where('plan', $produto)->firstOrFail();

        $plainToken = Str::random(96);

        CheckoutSession::create([
            'user_id' => Auth::id(),
            'token_hash' => hash('sha256', $plainToken),
            'cart_payload' => [
                'type' => 'checkout',
                'items' => [
                    [
                        'plan_id' => $plan->plan,
                        'quantity' => 1,
                    ],
                ],
            ],
            'source' => 'vortexhost-cart',
            'expires_at' => now()->addMinutes(20),
        ]);

        $clientAreaUrl = rtrim(config('services.client_area.url'), '/');

        return redirect()->away(
            $clientAreaUrl . '/checkout/entrar?token=' . urlencode($plainToken)
        );
    }
}