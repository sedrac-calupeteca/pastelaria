@extends('layouts.template')
@section('body', 'd-flex text-center text-white bg-primary')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/cover.css') }}" />
@endsection
@section('content')
    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
        <header class="mb-auto">
            <div>
                <h3 class="float-md-start mb-0 text-white fwb h3">
                    <i class="fas fa-cookie"></i>
                    <span>Pastelaria El Flamingo</span>
                </h3>
            </div>
            <div class="float-right">
                <a href="{{ route('loja.public') }}" class="nav-item text-white h3">
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                    <span>Loja</span>
                </a>
            </div>
        </header>

        <main class="px-3">
            <div class="continer w-50 m-auto">
                <div class="text-white text-underlane bg-transp">
                    <h1>Bem vindo</h1>
                    <hr class="" />
                    <p class="lead text-justify fwb">
                        Faça a sua encomenda no nosso website onde poderás encontrar os nossos produtos.
                    </p>
                    <ul class="text-left">
                        <li class="fwb">Bolos</li>
                        <li class="fwb">Biscoitos</li>
                        <li class="fwb">Salgadinhos</li>
                        <li class="fwb">Merendas</li>
                    </ul>
                </div>
                @if (Route::has('login'))
                    @auth
                        <a href="{{ route('home') }}" class="btn btn-warning btn-lg mt-1 rounded">
                            <i class="fas fa-solar-panel"></i>
                            <span>Painel de control</span>
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-dark m-1 rounded h3">
                            <i class="fas fa-lock"></i>
                            <span>Entrar</span>
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-info m-1 rounded h3">
                                <i class="fas fa-file-alt"></i>
                                <span>Registar</span>
                            </a>
                        @endif
                    @endauth
                @endif
            </div>
        </main>

        <footer class="mt-auto text-dark">

        </footer>

    </div>
@endsection
