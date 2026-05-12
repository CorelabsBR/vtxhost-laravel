<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    public function redirect(string $provider)
    {
        abort_unless(in_array($provider, ['google', 'discord']), 404);

        return Socialite::driver($provider)->redirect();
    }

    public function callback(string $provider)
    {
        abort_unless(in_array($provider, ['google', 'discord']), 404);

        $socialUser = Socialite::driver($provider)->user();

        $providerIdColumn = $provider . '_id';

        $user = User::where($providerIdColumn, $socialUser->getId())
            ->orWhere('email', $socialUser->getEmail())
            ->first();

        if (!$user) {
            $user = User::create([
                'nome' => $socialUser->getName()
                    ?: $socialUser->getNickname()
                    ?: 'Cliente Vortex',

                'email' => $socialUser->getEmail(),

                'senha' => null,

                $providerIdColumn => $socialUser->getId(),
                'provider' => $provider,
                'avatar' => $socialUser->getAvatar(),
                'email_verified_at' => now(),

                'tipo_usuario' => 'cliente',
                'profile_completed_at' => null,
            ]);
        } else {
            $user->update([
                $providerIdColumn => $socialUser->getId(),
                'provider' => $provider,
                'avatar' => $socialUser->getAvatar(),
                'email_verified_at' => $user->email_verified_at ?? now(),
            ]);
        }

        Auth::login($user, true);

        request()->session()->regenerate();

        if (empty($user->profile_completed_at)) {
            return redirect()
                ->route('cadastro.completar')
                ->with('success', 'Conta conectada. Complete seu cadastro para continuar.');
        }

        return redirect()->intended('/cliente');
    }
}