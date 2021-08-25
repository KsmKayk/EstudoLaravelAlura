@extends('layout')

@section('header')
Series
@endsection

@section('content')

@include('message', ['message' => $message])

@auth
<a href="{{ route('series_create') }}" class="btn btn-outline-dark mb-2">Adicionar</a>
@endauth
<ul class="list-group">
    <!-- create blade foreach showing series -->
    @foreach($series as $serie)
    <li class="list-group-item d-flex justify-content-between align-items-center">
        <span id="nome-serie-{{ $serie->id }}">{{ $serie->name }}</span>

        <div class="input-group w-50" hidden id="input-nome-serie-{{ $serie->id }}">
            <input type="text" class="form-control" value="{{ $serie->name }}">
            <div class="input-group-append">
                <button class="btn btn-primary" onclick="editarSerie({{ $serie->id }})">
                    <i class="fas fa-check"></i>
                </button>
                @csrf
            </div>
        </div>

        <span class="d-flex">
            @auth
            <button class="btn btn-outline-info" style="margin-right: 8px" onclick="toggleInput({{ $serie->id }})">
                <i class="fas fa-edit"></i>
            </button>
            @endauth
            <a href="/series/{{$serie->id}}/seasons" class="btn btn-outline-info" style="margin-right: 8px"><i
                    class="fas fa-external-link-alt"></i></a>
            @auth
            <form method="POST" action="/series/remove/{{ $serie->id }}"
                onsubmit="return confirm ('Tem certeza que deseja excluir {{ addslashes($serie->name) }}?')">
                @csrf
                @method('DELETE')
                <button class="btn btn-outline-danger"><i class="far fa-trash-alt"></i></button>
            </form>
            @endauth
        </span>
    </li>
    @endforeach
</ul>
<script>
    function toggleInput(serieId) {
    const nomeSerieEl = document.getElementById(`nome-serie-${serieId}`);
    const inputSerieEl = document.getElementById(`input-nome-serie-${serieId}`);
    if (nomeSerieEl.hasAttribute('hidden')) {
        nomeSerieEl.removeAttribute('hidden');
        inputSerieEl.hidden = true;
    } else {
        inputSerieEl.removeAttribute('hidden');
        nomeSerieEl.hidden = true;
    }
}

    function editarSerie(serieId) {
        let formData = new FormData();
        const name = document.querySelector(`#input-nome-serie-${serieId} > input`).value;
        const token = document.querySelector('input[name="_token"]').value;
        formData.append('name', name);
        formData.append('_token', token);

        const url = `/series/${serieId}/editName`;
        fetch(url, {
            method: 'POST',
            body: formData
        }).then(() => {
            toggleInput(serieId)
            document.getElementById(`nome-serie-${serieId}`).textContent = name;
        })
    }
</script>
@endsection
