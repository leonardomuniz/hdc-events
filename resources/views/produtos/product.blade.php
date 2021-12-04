@extends('layouts.main')

@section('title', 'HDC Events - produtos')

@section('content')


@if ($id == null)
    <p>Tem cheiro de intruso, tem cara de intruso, será que é um intruso ?</p>
@else
    <p>Exibindo produto id: {{$id}}</p>
@endif
@endsection