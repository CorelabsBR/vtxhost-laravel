<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MercadoPagoWebhookController extends Controller
{
    public function handle(Request $request)
    {
        $paymentId = $request->input('data.id')
            ?? $request->input('id')
            ?? $request->query('id');

        if (!$paymentId) {
            return response()->json(['ok' => true]);
        }

        $response = Http::withToken(env('MERCADOPAGO_ACCESS_TOKEN'))
            ->get("https://api.mercadopago.com/v1/payments/{$paymentId}");

        if (!$response->successful()) {
            Log::warning('Mercado Pago webhook erro', [
                'payment_id' => $paymentId,
                'body' => $response->body(),
            ]);

            return response()->json(['ok' => false], 400);
        }

        $payment = $response->json();

        $orderId = $payment['external_reference'] ?? null;
        $status = $payment['status'] ?? null;

        if (!$orderId) {
            return response()->json(['ok' => true]);
        }

        $order = Order::find($orderId);

        if (!$order) {
            return response()->json(['ok' => true]);
        }

        if ($status === 'approved') {
            $order->update([
                'status' => 'pago',
                'mp_pagamento_id' => $paymentId,
            ]);

            // Depois entra aqui:
            // criar service
            // provisionar Hestia/Pterodactyl
        } elseif (in_array($status, ['cancelled', 'rejected'], true)) {
            $order->update([
                'status' => 'cancelado',
                'mp_pagamento_id' => $paymentId,
            ]);
        }

        return response()->json(['ok' => true]);
    }
}