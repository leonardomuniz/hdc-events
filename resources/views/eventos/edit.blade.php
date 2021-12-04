@extends('layouts.main')

@section('title', 'HDC Events - Editando:'.$evento->titulo)

@section('content')

<div id="event-create-container" class="col-md-6 offset-md-3">
    <h1>Editando: {{$evento->titulo}}</h1>
    <form action="/eventos/update/{{$evento->id}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="titulo">Evento:</label>
            <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Nome do evento" value="{{$evento->titulo}}" required>
        </div>
        <div class="form-group">
            <label for="date">Data do evento:</label>
            <input type="date" class="form-control" id="date" value="{{$evento ->date->format('Y-m-d')}}" name="date">
        </div>
        <div class="form-group">
            <label for="cidade">Cidade:</label>
            <input type="text" class="form-control" id="cidade" name="cidade" placeholder="Local do evento" value="{{$evento->cidade}}" required>
        </div>
        <div class="form-group">
            <label for="privado">O evento é privado:</label>
            <select name="privado" id="privado" class="form-control">
                <option value="0">Não</option>
                <option value="1" {{$evento->privado == 1 ? "selected='selected'" : ''}}>Sim</option>
            </select>
        </div>
        <div class="form-group">
            <label for="descricao">Descrição do evento:</label>
            <textarea name="descricao" id="descricao" cols="30" rows="10" class="form-control" placeholder="O que vai acontecer no evento">
            {{$evento->descricao}}
            </textarea>
        </div>
        <div class="form-group">
            <label for="items">Adicione items de infraestrutura :</label>
            <div class="form-group">
                <input type="checkbox" name="items[]" value="Cadeiras"> Cadeiras
            </div>
            <div class="form-group">
                <input type="checkbox" name="items[]" value="Palco"> Palco
            </div>
            <div class="form-group">
                <input type="checkbox" name="items[]" value="Cerveja grátis"> Cerveja grátis
            </div>
            <div class="form-group">
                <input type="checkbox" name="items[]" value="Open Food"> Open Food
            </div>
            <div class="form-group">
                <input type="checkbox" name="items[]" value="Brindes"> Brindes
            </div>
        </div>
        <br>
        <div class="form-group">
            <label for="image">Imagem do evento:</label>
            <input type="file" class="form-control-file" id="image" name="image">
            <img src="/img/events/{{ $evento->image}}" alt="{{$evento->titulo}}" class="img-preview">
        </div>
        <br>
        <input type="submit" value="Editar evento" class="btn btn-primary">
    </form>
</div>

@endsection