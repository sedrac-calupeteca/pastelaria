@extends('layouts.template')
@section('body', 'bg-light')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/login-register.css') }}" />
@endsection
@section('content')
    <h3 class="float-lf mb-0 fwb h3 text-white">
        <i class="fas fa-cookie"></i>
        <span>Pastelaria El Flamingo\Registra</span>
    </h3>
    <form method="POST" action="{{ route('register') }}" class="w-75 bg-white register pt-4">
        @csrf
        <a class="back mb-1" href="/">
            <i class="fas fa-arrow-alt-circle-left fa-1x"></i>
            <span>voltar</span>
        </a>
        <hr>
        <h4>Faça o seu registro</h4>
        @include('components.message')
        @include('components.errors')

        @include('components.import.user')

        <div class="mt-4">
            <button class="btn btn-outline-success" type="submit">
                <i class="fas fa-file-alt"></i>
                <span>cadastramento</span>
            </button>
        </div>
        <div class="flex items-center justify-end mt-2 mb-2">
            <a class="text-primary t-d-n" href="{{ route('login') }}">
                <i class="fas fa-user"></i>
                <span class="ml-1">Fazer o login</span>
            </a>
        </div>

    </form>
@endsection
