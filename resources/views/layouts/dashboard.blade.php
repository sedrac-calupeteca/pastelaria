@extends('layouts.template')
@section('body', 'bg-light')
@section('css')
    @parent
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}" />
@endsection
@section('content')
    <div class="d-flex" id="wrapper">
        <div class="border-end bg-primary text-white position-relative" id="sidebar-wrapper">
            <div class="sidebar-heading border-bottom">
                <div class="text-center">
                    <div><i class="fas fa-cookie fa-2x"></i></div>
                    <div><span>Pastelaria</span></div>
                    <div><span>El Flamingo</span></div>
                </div>
            </div>
            <div class="list-group list-group-flush">
                <a href="/" class="list-group-item p-3 bg-primary text-white">
                    <i class="fas fa-home"></i>
                    <span>Página incial</span>
                </a>
                <a href="{{ route('home') }}"
                    class="@if (isset($panel) && $panel == 'account') list-group-item-action @else list-group-item @endif p-3 bg-primary text-white">
                    <i class="fas fa-user-circle"></i>
                    <span>Conta</span>
                </a>
                @isset(Auth::user()->funcionario->id)
                <a href="{{ route('funcionarios.index') }}"
                    class="@if (isset($panel) && $panel == 'funcionarios') list-group-item-action @else list-group-item @endif p-3 bg-primary text-white">
                    <i class="fas fa-users-cog"></i>
                    <span>Funcionarios</span>
                </a>
                <a href="{{ route('clientes.index') }}"
                    class="@if (isset($panel) && $panel == 'clientes') list-group-item-action @else list-group-item @endif p-3 bg-primary text-white">
                    <i class="fas fa-users"></i>
                    <span>Clientes</span>
                </a>
                @endisset
                <a href="{{ route('produtos.index') }}"
                    class="@if (isset($panel) && $panel == 'produtos') list-group-item-action @else list-group-item @endif p-3 bg-primary text-white">
                    <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                    <span>Produto</span>
                </a>
                <a href="{{ route('compras.index') }}"
                    class="@if (isset($panel) && $panel == 'compras') list-group-item-action @else list-group-item @endif p-3 bg-primary text-white">
                    <i class="fas fa-money-bill-wave"></i>
                    <span>Compra</span>
                </a>
                <a href="{{ route('encomendas.index') }}"
                    class="@if (isset($panel) && $panel == 'encomendas') list-group-item-action @else list-group-item @endif p-3 bg-primary text-white">
                    <i class="fas fa-surprise"></i>
                    <span>Encomenda</span>
                </a>
                <a href="{{ route('loja.auth') }}"
                    class="@if (isset($panel) && $panel == 'loja') list-group-item-action @else list-group-item @endif p-3 bg-primary text-white">
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                    <span>Loja</span>
                </a>
            </div>
            <div class="div-logout">

            </div>
        </div>

        <div id="page-content-wrapper">

            <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
                <div class="container-fluid">
                    <div class="d-flex gap-1">
                        <button class="btn btn-warning rounded mr-1" id="sidebarToggle">
                            <i class="fas fa-bars"></i>
                            <span>Menu</span>
                        </button>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger rounded">
                                <i class="fas fa-power-off"></i>
                                <span>logaut</span>
                            </button>
                        </form>
                    </div>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation"><span
                            class="navbar-toggler-icon"></span></button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                        </ul>
                    </div>

                </div>
            </nav>
            <div class="container-fluid">
                @yield('painel')
            </div>
        </div>
    </div>
@endsection
@section('script')
    @parent

@endsection
