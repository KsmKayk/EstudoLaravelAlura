<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeriesFormRequest;
use Illuminate\Http\Request;
use App\Models\Serie;

class SeriesController extends Controller
{
    //Create public function index
    public function index(Request $request)
    {
        //find all series
        $series = Serie::query()->orderBy('name')->get();
        $message = $request->session()->get('message');

        return view('series.index', compact('series', 'message'));
    }

    //Create public function create
    public function create(Request $request)
    {
        return view('series.create');
    }

    //Create public function store
    public function store(SeriesFormRequest $request)
    {

        //get series name from request
        $name = $request->name;
        //create new serie with name
        $serie = Serie::create(['name' => $name]);
        //create session message
        $request->session()->flash('message', "A Série {$serie->name} foi adicionada com sucesso!");

        //return to the index
        return redirect()->route('series_list');
    }

    //Create public function destroy
    public function destroy(Request $request)
    {
        //destroy serie with $request->id
        Serie::destroy($request->id);
        //create session message
        $request->session()->flash('message', "A Série {$request->name} foi removida com sucesso!");
        //return to the index
        return redirect()->route('series_list');
    }
}
