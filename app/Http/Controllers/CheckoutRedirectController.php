<?php

namespace App\Http\Controllers;

use App\Models\CheckoutSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CheckoutRedirectController extends Controller
{
    public function redirect(Request $request)
    {
        $data = $request->validate([
            'items' => ['required', 'array', 'min:1'],
            'items.*.plan_id' => ['required', 'integer', 'exists:plans,id'],
            'items.*.quantity' => ['required', 'integer', 'min:1', 'max:20'],
        ]);

        $plainToken = Str::random(96);

        CheckoutSession::create([
            'user_id' => Auth::id(),
            'token_hash' => hash('sha256', $plainToken),
            'cart_payload' => [
                'items' => $data['items'],
            ],
            'source' => 'vortexhost',
            'expires_at' => now()->addMinutes(20),
        ]);

        $clientAreaUrl = rtrim(config('services.client_area.url'), '/');

        return redirect()->away(
            $clientAreaUrl . '/checkout/entrar?token=' . urlencode($plainToken)
        );
    }
}