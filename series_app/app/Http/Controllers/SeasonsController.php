<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Serie;

class SeasonsController extends Controller
{

    //public function index
    public function index(int $id)
    {
        $serie = Serie::find($id);
        $seasons = $serie->seasons;

        return view('seasons.index', compact('seasons', 'serie'));
    }
}
