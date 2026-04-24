<?php

namespace App\Http\Controllers;

use App\Models\JogoProd;

class GameHostingController extends Controller
{
    public function index()
    {
        $jogos = JogoProd::query()
            ->where('ativo', true)
            ->orderBy('nome')
            ->get();

        return view('games.index', compact('jogos'));
    }

    public function show(JogoProd $jogo)
    {
        abort_if(! $jogo->ativo, 404);

        $plans = $jogo->plans()
            ->orderByRaw('ram = 0')
            ->orderBy('ram')
            ->orderBy('disk')
            ->get();

        $customView = 'games.custom.' . $jogo->slug;

        if ($jogo->slug && view()->exists($customView)) {
            return view($customView, compact('jogo', 'plans'));
        }

        return view('games.show', compact('jogo', 'plans'));
    }
}