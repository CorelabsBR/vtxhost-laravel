<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
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
                'name' => $socialUser->getName() ?: $socialUser->getNickname() ?: 'Cliente Vortex',
                'email' => $socialUser->getEmail(),
                $providerIdColumn => $socialUser->getId(),
                'provider' => $provider,
                'avatar' => $socialUser->getAvatar(),
                'password' => null,
                'email_verified_at' => now(),
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

        return redirect()->intended('/');
    }
}