@extends('layouts.main')

@section('title', 'HDC Events - produtos')

@section('content')

<h1>
    Tela Produtos
</h1>

@if( $busca != '')
    <p>O usuário busca por: {{ $busca }}</p>

@endif

@endsection