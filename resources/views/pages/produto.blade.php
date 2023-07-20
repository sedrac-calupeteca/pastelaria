@extends('layouts.page', ['list' => $produtos])
@section('page-container')
@endsection
@section('css')
    @parent
    <link rel="stylesheet" href="{{ asset('css/page/home.css') }}" />
@endsection
@isset(Auth::user()->funcionario->id)
@section('buttons')
    <button class="btn btn-outline-primary rounded" id="btn-add-user" data-bs-toggle="modal" data-bs-target="#modalProduto"
        url="{{ route($panel . '.store') }}" method="POST">
        <i class="fas fa-user-plus"></i>
        <span>adicionar</span>
    </button>
@endsection
@endisset
@section('thead')
    <th>
        <div><i class="fas fa-image"></i><span>Image</span></div>
    </th>
    <th>
        <div><i class="fas fa-signature"></i><span>Nome</span></div>
    </th>
    <th>
        <div><i class="fas fa-check-square" aria-hidden="true"></i><span>Categoria</span></div>
    </th>
    <th>
        <div><i class="fas fa-money-bill"></i><span>Preco</span></div>
    </th>
    <th>
        <div><i class="fas fa-sort-numeric-up"></i><span>Quantidade Stock</span></div>
    </th>
    <th>
        <div><i class="fas fa-comment"></i><span>Descricao</span></div>
    </th>
    @isset(Auth::user()->funcionario->id)
    <th colspan="2">
        <div><i class="fas fa-tools"></i><span>Acções</span></div>
    </th>
    @endisset
@endsection
@section('tbody')
    @foreach ($produtos as $produto)
        <tr>
            <td class="text-center">
                @if ($produto->image)
                    <a href="{{ url("storage/{$produto->image}") }}">
                        <img src="{{ url("storage/{$produto->image}") }}" alt="foto perfil" class="rounded-circle"
                            style="width: 40px; height: 40px;">
                    </a>
                @else
                    <a href="{{ asset('img/avatar.jpg') }}" class="m-2">
                        <img src="{{ asset('img/avatar.jpg') }}" alt="foto perfil" class="rounded-circle"
                            style="width: 35px; height: 35px;">
                    </a>
                    <br />
                    <button class="text-primary bg-none btn-file d-flex gap-1 align-items-center" data-bs-toggle="modal" data-bs-target="#modalFile"
                        url="{{ route('produtos.photo', $produto->id) }}" method="PUT">
                        <i class="fas fa-plus"></i>
                        <span>adicionar</span>
                    </button>
                @endif
            </td>
            <td>{{ $produto->nome }}</td>
            <td data-vd="{{ $produto->categoria }}">{{ $produto->categoria }}</td>
            <td>{{ $produto->preco }}</td>
            <td>{{ $produto->quantidade_stock }}</td>
            <td>{{ $produto->descricao }}</td>
            @isset(Auth::user()->funcionario->id)
            <td>
                <a href="#" class="text-warning rounded btn-sm btn-user-tr d-flex gap-1 align-items-center" data-bs-toggle="modal"
                    data-bs-target="#modalProduto" url="{{ route($panel . '.update', $produto->id) }}" method="PUT">
                    <i class="fas fa-user-edit"></i>
                    <span>editar</span>
                </a>
            </td>
            <td>
                <a href="#" class="text-danger rounded btn-sm btn-user-del d-flex gap-1 align-items-center" data-bs-toggle="modal"
                    data-bs-target="#modalProduto" url="{{ route($panel . '.destroy', $produto->id) }}" method="DELETE">
                    <i class="fas fa-user-times"></i>
                    <span>eliminar</span>
                </a>
            </td>
            @endisset
        </tr>
    @endforeach
@endsection
@section('modal')
    @include('components.modal.produto')
    @include('components.modal.fileupload')
@endsection
@section('script')
    @parent
    <script src="{{ asset('js/help/clearForm.help.js') }}"></script>
    <script src="{{ asset('js/help/select.help.js') }}"></script>
    <script src="{{ asset('js/page/produto.js') }}"></script>
    <script src="{{ asset('js/fileupload.js') }}"></script>
@endsection
