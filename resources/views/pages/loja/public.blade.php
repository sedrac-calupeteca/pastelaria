@extends('layouts.template')
@section('css')
    @parent
    <link rel="stylesheet" href="{{ asset('css/paginate.css') }}" />
    <style>
        body{
            margin: 0 auto;
        }
    </style>
@endsection
@section('content')
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-2">
    <a class="navbar-brand" href="#">Loja</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="/">
            <i class="fas fa-home"></i>
            <span>Página incical</span>
        </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('login') }}">
            <i class="fas fa-lock"></i>
            <span>Login</span>
        </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('register') }}">
            <i class="fas fa-file-alt"></i>
            <span>Cadastramento</span>
          </a>
        </li>
      </ul>
    </div>
  </nav>
    @include('pages.loja.container')
@endsection
