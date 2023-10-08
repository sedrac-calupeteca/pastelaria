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
    <button class="btn btn-outline-success rounded" id="btn-search-user" data-bs-toggle="modal" data-bs-target="#modalUserSearch"
        url="#" method="POST">
        <i class="fas fa-search"></i>
        <span>procurar</span>
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
    @foreach ($produtos as $item)
        <tr>
            <td class="text-center">
                @if ($item->image)
                    <a href="{{ url("storage/{$item->image}") }}">
                        <img src="{{ url("storage/{$item->image}") }}" alt="foto perfil" class="rounded-circle"
                            style="width: 40px; height: 40px;">
                    </a>
                @else
                    <a href="{{ asset('img/avatar.jpg') }}" class="m-2">
                        <img src="{{ asset('img/avatar.jpg') }}" alt="foto perfil" class="rounded-circle"
                            style="width: 35px; height: 35px;">
                    </a>
                    <br />
                    <button class="text-primary bg-none btn-file d-flex gap-1 align-items-center" data-bs-toggle="modal" data-bs-target="#modalFile"
                        url="{{ route('produtos.photo', $item->id) }}" method="PUT">
                        <i class="fas fa-plus"></i>
                        <span>adicionar</span>
                    </button>
                @endif
            </td>
            <td>{{ $item->nome }}</td>
            <td data-vd="{{ $item->categoria }}">{{ $item->categoria }}</td>
            <td>{{ $item->preco }}</td>
            <td>{{ $item->quantidade_stock }}</td>
            <td>{{ $item->descricao }}</td>
            @isset(Auth::user()->funcionario->id)
            <td>
                <a href="#" class="text-warning rounded btn-sm btn-user-tr d-flex gap-1 align-items-center" data-bs-toggle="modal"
                    data-bs-target="#modalProduto" url="{{ route($panel . '.update', $item->id) }}" method="PUT">
                    <i class="fas fa-user-edit"></i>
                    <span>editar</span>
                </a>
            </td>
            <td>
                <a href="#" class="text-danger rounded btn-sm btn-user-del d-flex gap-1 align-items-center" data-bs-toggle="modal"
                    data-bs-target="#modalProduto" url="{{ route($panel . '.destroy', $item->id) }}" method="DELETE">
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
    @include('components.modal.search',[
        'route' => route($panel . '.index'),
        'parmas' => ['nome' => 'Nome','preco' => 'Preço','categoria' => 'Categoria',' descricao' => 'Descrição',]
    ])
@endsection
@section('script')
    @parent
    <script src="{{ asset('js/help/clearForm.help.js') }}"></script>
    <script src="{{ asset('js/help/select.help.js') }}"></script>
    <script src="{{ asset('js/page/produto.js') }}"></script>
    <script src="{{ asset('js/fileupload.js') }}"></script>
@endsection
