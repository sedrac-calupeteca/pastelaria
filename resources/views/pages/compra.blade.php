@extends('layouts.page', ['list' => $compras])
@section('page-container')
@endsection
@section('css')
    @parent
    <link rel="stylesheet" href="{{ asset('css/page/home.css') }}" />
@endsection
@isset(Auth::user()->funcionario->id)
@section('buttons')
    <button class="btn btn-outline-primary rounded" id="btn-add-user" data-bs-toggle="modal" data-bs-target="#modalCompra"
        url="{{ route($panel . '.store') }}" method="POST">
        <i class="fas fa-user-plus"></i>
        <span>adicionar</span>
    </button>
@endsection
@endisset
@section('thead')
    <th>
        <div><i class="fas fa-signature"></i><span>Produto</span></div>
    </th>
    <th>
        <div><i class="fas fa-users"></i><span>Cliente</span></div>
    </th>
    <th>
        <div><i class="fa fa-shopping-bag"></i><span>Preco(Produto)</span></div>
    </th>
    <th>
        <div><i class="fas fa-sort-numeric-up"></i><span>Quantidade(Produto)</span></div>
    </th>
    <th>
        <div><i class="fas fa-money-bill"></i><span>Valor(Pago)</span></div>
    </th>
    <th>
        <div><i class="fas fa-file"></i><span>Comprovativa</span></div>
    </th>
    <th colspan="2">
        <div><i class="fas fa-tools"></i><span>Acções</span></div>
    </th>
@endsection
@section('tbody')
    @foreach ($compras as $compra)
        <tr>
            <td produto_id="{{ $compra->produto_id }}" stock="{{ $compra->produto->quantidade_stock }}" categoria="{{ $compra->produto->categoria }}">{{ $compra->produto->nome }}</td>
            <td cliente_id="{{ $compra->cliente_id }}" email="{{ $compra->cliente->user->email }}">{{ $compra->cliente->user->name }}</td>
            <td>{{ $compra->produto->preco }}</td>
            <td>{{ $compra->quantidade_compra }}</td>
            <td>{{ $compra->valor_compra }}</td>
            <td>
            @if ($compra->file)
                <a href="{{ url("storage/{$compra->file}") }}">
                   <i class="fas fa-eye"></i>
                    <span>visualizar</span>    
                </a>
            @endif
            </td>
            <td>
                <a href="#" class="text-warning rounded btn-sm btn-user-tr d-flex gap-1" data-bs-toggle="modal"
                    data-bs-target="#modalCompra" url="{{ route($panel . '.update', $compra->id) }}" method="PUT">
                    <i class="fas fa-user-edit"></i>
                    <span>editar</span>
                </a>
            </td>
            <td>
                <a href="#" class="text-danger rounded btn-sm btn-user-del d-flex gap-1" data-bs-toggle="modal"
                    data-bs-target="#modalCompra" url="{{ route($panel . '.destroy', $compra->id) }}" method="DELETE">
                    <i class="fas fa-user-times"></i>
                    <span>eliminar</span>
                </a>
            </td>
        </tr>
    @endforeach
@endsection
@section('modal')
    @include('components.modal.compra')
    <div hidden>
        <input type="hidden" id="url-json-cliente" value="{{ route("clientes.json.search") }}">
        <input type="hidden" id="url-json-produto" value="{{ route("produtos.json.search") }}">
    </div>
@endsection
@section('script')
    @parent
    <script src="{{ asset('js/help/clearForm.help.js') }}"></script>
    <script src="{{ asset('js/page/compra/cliente.js') }}"></script>
    <script src="{{ asset('js/page/compra/produto.js') }}"></script>
    <script src="{{ asset('js/page/compra.js') }}"></script>
@endsection
