@extends('layout')

@section('header')
    Adicionar Série
@endsection

@section('content')
    <!-- create if showing errors -->
    @if ($errors->any())
        <div class="alert alert-danger mb-2">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="post">
        @csrf
        <div class="form-group mb-3">
            <label for="name" class="">Nome</label>
            <input type="text" class="form-control" name="name" id="name">
        </div>

        <button class="btn btn-outline-primary">Adicionar</button>
    </form>
@endsection
