<?php

namespace App\Http\Controllers;

use App\Models\CheckoutSession;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ClientAreaAccessController extends Controller
{
    public function redirect()
    {
        return self::redirectToClientArea();
    }

    public static function redirectToClientArea()
    {
        $plainToken = Str::random(96);

        CheckoutSession::create([
            'user_id' => Auth::id(),
            'token_hash' => hash('sha256', $plainToken),
            'cart_payload' => [
                'items' => [],
                'type' => 'client_area_login',
            ],
            'source' => 'vortexhost-login',
            'expires_at' => now()->addMinutes(10),
        ]);

        $clientAreaUrl = rtrim(config('services.client_area.url'), '/');

        return redirect()->away(
            $clientAreaUrl . '/checkout/entrar?token=' . urlencode($plainToken)
        );
    }
}