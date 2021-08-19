@extends('layout')

@section('header')
    Series
@endsection

@section('content')
    @if (!empty($message))
        <div class="alert alert-success mb-3" role="alert">{{ $message }}</div>
    @endif
    <a href="{{ route('series_create') }}" class="btn btn-outline-dark mb-2">Adicionar</a>
    <ul class="list-group">
        <!-- create blade foreach showing series -->
        @foreach ($series as $serie)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                {{ $serie->name }}
                <form method="POST" action="/series/remove/{{ $serie->id }}"
                    onsubmit="return confirm ('Tem certeza que deseja excluir {{ addslashes($serie->name) }}?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-outline-danger"><i class="far fa-trash-alt"></i></button>
                </form>
            </li>
        @endforeach
    </ul>
@endsection
