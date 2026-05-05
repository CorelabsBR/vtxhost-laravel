@extends('layouts.app')

@section('title', 'Checkout - VortexHost')

@section('content')
<section class="container py-5">
    <h1>Checkout</h1>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="checkout-box">
        @foreach($items as $item)
            <div class="checkout-item">
                <strong>{{ $item->product->nome }}</strong>

                <span>
                    {{ $item->quantidade }}x
                    R$ {{ number_format($item->product->preco, 2, ',', '.') }}
                </span>

                <small>
                    Subtotal:
                    R$ {{ number_format($item->product->preco * $item->quantidade, 2, ',', '.') }}
                </small>
            </div>
        @endforeach

        <hr>

        <h2>Total: R$ {{ number_format($total, 2, ',', '.') }}</h2>

        <form method="POST" action="{{ route('checkout.pay') }}">
            @csrf

            <button type="submit" class="btn btn-primary">
                Pagar com Mercado Pago
            </button>
        </form>
    </div>
</section>
@endsection