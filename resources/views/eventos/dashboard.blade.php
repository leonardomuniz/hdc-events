@extends('layouts.main')

@section('title', 'HDC - Dashboard')

@section('content')

<div class="col-md-10 offset-md-1 dashboard-title container">
    <h1>Meus Eventos</h1>
</div>
<div class="col-md-10 offset-md-1 dashboard-events-container">
    @if(count($eventos) > 0)
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Nome</th>
                <th>Participantes</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($eventos as $evento)
                <tr>
                    <td scropt="row">{{$loop-> index +1}}</td>
                    <td><a href="/eventos/{{$evento ->id}}">{{$evento->titulo}}</a></td>
                    <td>{{count($evento->users)}}</td>
                    <td>
                        <a href="/eventos/edit/{{$evento->id}}" class="btn btn-info edit-btn"><ion-icon name="create-outline"></ion-icon> Editar</a>
                        <form action="/eventos/{{$evento->id}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger delete-btn">
                                <ion-icon name="trash-outline"></ion-icon>
                                Deletar
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p>Você ainda não tem eventos, <a href="/eventos/criar">criar evento</a>.</p>
    @endif
    <br>
    <hr>
    <br>
</div>

    <div class="col-md-10 offset-md-1 dashboard-title container">
        <h1>Eventos que estou participando</h1>
    </div>
    <div class="col-md-10 offset-md-1 dashboard-events-container">
    @if(count($eventsAsParticipant) > 0)
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Nome</th>
                <th>Participantes</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($eventsAsParticipant as $evento)
                <tr>
                    <td scropt="row">{{$loop-> index +1}}</td>
                    <td><a href="/eventos/{{$evento ->id}}">{{$evento->titulo}}</a></td>
                    <td>{{count($evento->users)}}</td>
                    <td>
                        <form action="/eventos/leave/{{$evento->id}}" method="post">
                            @csrf
                            @method("DELETE")
                            <button type="submit" class="btn btn-danger delete-btn">
                                <ion-icon name="trash-outline"></ion-icon>
                                sair do evento
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @else
        <p>Você ainda não está participando de nenhum evento, <a href="/">Veja todos os eventos</a>.</p>
    @endif
    </div>
</div>

@endsection