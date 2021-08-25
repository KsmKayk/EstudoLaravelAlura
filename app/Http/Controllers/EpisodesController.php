<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Season;
use App\Models\Episode;

class EpisodesController extends Controller
{

    public function index(Season $season, Request $request)
    {
        $episodes = $season->episodes;
        $message = $request->session()->get('message');

        return view('episodes.index', compact('episodes', 'season', 'message'));
    }
    public function watch(Season $season, Request $request)
    {
        $watchedEpisodes = $request->episodes;
        $season->episodes->each(function (Episode $episode) use ($watchedEpisodes) {
            $episode->watched = in_array($episode->id, $watchedEpisodes);
        });
        $season->push();
        $request->session()->flash('message', 'Seus episódios assistidos foram atualizados!');

        return redirect()->back();
    }
}
