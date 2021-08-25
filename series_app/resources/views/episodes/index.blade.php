@extends('layout')

@section('header')
Episódios da temporada - {{$season->number}}
@endsection

@section('content')

@include('message', ['message' => $message])

<form action="/seasons/{{$season->id}}/episodes/watch" method="POST">
    @csrf
    <ul class="list-group">
        @foreach ($episodes as $episode)
        <li class="list-group-item d-flex justify-content-between align-items-center">
            Episódio - {{$episode->number}}

            <input type="checkbox" name="episodes[]" value="{{$episode->id}}" {{$episode->watched ? "checked" : ''}}>

        </li>
        @endforeach
    </ul>
    @auth
    <button class="btn btn-outline-primary mt-3 mb-3">Salvar</button>
    @endauth
</form>
@endsection
