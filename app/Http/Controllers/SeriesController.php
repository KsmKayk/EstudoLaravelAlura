<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeriesFormRequest;
use Illuminate\Http\Request;
use App\Models\Serie;
use App\Services\SerieCreator;
use App\Services\SerieRemover;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewSerie;
use App\Models\User;

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
    public function store(SeriesFormRequest $request, SerieCreator $serieCreator)
    {

        $name = $request->name;
        $seasons_quantity = $request->seasons_quantity;
        $episodes_quantity = $request->episodes_quantity;

        $serie = $serieCreator->createSerie($name, $seasons_quantity, $episodes_quantity);

        $users = User::All();
        foreach ($users as $index => $user) {
            $multiplyer = $index + 1;
            $email = new NewSerie($name, $seasons_quantity, $episodes_quantity);
            $email->subject = 'Nova Série adicionada!';
            $when = now()->addSeconds($multiplyer * 10);
            Mail::to($user)->later($when, $email);
        }

        //create session message
        $request->session()->flash('message', "A Série {$serie->name}, suas temporadas e episódios foram adicionada com sucesso!");

        //return to the index
        return redirect()->route('series_list');
    }

    //Create public function destroy
    public function destroy(Request $request, SerieRemover $serieRemover)
    {
        $serieName = $serieRemover->remove($request->id);

        //create session message
        $request->session()->flash('message', "A Série $serieName foi removida com sucesso!");
        //return to the index
        return redirect()->route('series_list');
    }

    public function editName(Request $request)
    {
        $newName = $request->name;
        $serie = Serie::find($request->id);
        $serie->name = $newName;
        $serie->save();
    }
}
