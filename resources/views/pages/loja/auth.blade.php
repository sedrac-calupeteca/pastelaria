@extends('layouts.dashboard')
@section('css')
    @parent
    <link rel="stylesheet" href="{{ asset('css/paginate.css') }}" />
@endsection
@section('painel')
    @include('pages.loja.container')
@endsection
