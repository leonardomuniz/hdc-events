@extends('layouts.main')

@section('title', 'HDC Events - Evento ')

@section('content')

<div class="col-md-10 offset-md-1">
    <div class="row">
        <div id="image-container" class="col-md-6">
            <img src="/img/events/{{$evento->image}}" class="img-fluid" alt="{{$evento->titulo}}">
        </div>
        <div id="info-container" class="col-md-6">
            <h1>{{$evento->titulo}}</h1>
            <p class="event-city"><ion-icon name="location-outline"></ion-icon> {{$evento->cidade}}</p>
            <p class="events-participants"><ion-icon name="people-outline"></ion-icon> {{count($evento->users)}} Participantes</p>
            <p class="event-owner"><ion-icon name="star-outline"></ion-icon> {{$eventOwner['name']}}</p>
            <br>
            <h3>O evento conta com:</h3>
            <ul id="items-list">
                @foreach($evento->items as $item)
                <li><ion-icon name="play-outline"></ion-icon><span>{{$item}}</span></li>
                @endforeach
            </ul>
            @if(!$hasUserJoined)
                <form action="/eventos/join/{{$evento->id}}" method="post">
                @csrf
                    <a 
                        href="#" 
                        class="btn btn-primary" 
                        id="event-submit"
                        onclick="event.preventDefault();
                            this.closest('form').submit();
                        "
                    >Confirmar Presença</a>
                </form>
            @else
                <p class="already-joined-msg">Você já está participando deste evento !</p>
            @endif
        </div>
        <div class="col-md-12" id="description-container">
            <h3>Sobre o Evento:</h3>
            <p class="event-description">{{$evento->descricao}}</p>
        </div>
    </div>
</div>

@endsection