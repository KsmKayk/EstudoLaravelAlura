@extends('layout')

@section('header')
Adicionar Série
@endsection

@section('content')
@include('error', ['errors' => $errors])

<form method="post">
    @csrf
    <div class="row mb-3">
        <div class="col col-8">
            <label for="name">Nome</label>
            <input type="text" class="form-control" name="name" id="name">
        </div>
        <div class="col col-2">
            <label for="seasons_quantity">N* temporadas</label>
            <input type="number" class="form-control" name="seasons_quantity" id="seasons_quantity">
        </div>
        <div class="col col-2">
            <label for="episodes_quantity">N* episodios</label>
            <input type="number" class="form-control" name="episodes_quantity" id="episodes_quantity">
        </div>
    </div>

    <button class="btn btn-outline-primary">Adicionar</button>
</form>
@endsection
