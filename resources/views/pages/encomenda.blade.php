@extends('layouts.page', ['list' => $encomendas])
@section('page-container')
@endsection
@section('css')
    @parent
    <link rel="stylesheet" href="{{ asset('css/page/home.css') }}" />
    <style>
        .badge_row{display: flex; gap: 0.04rem;}
    </style>
@endsection
@isset(Auth::user()->funcionario->id)
@section('buttons')
    <button class="btn btn-outline-primary rounded" id="btn-add-user" data-bs-toggle="modal" data-bs-target="#modalEncomenda"
        url="{{ route($panel . '.store') }}" method="POST">
        <i class="fas fa-user-plus"></i>
        <span>adicionar</span>
    </button>
@endsection
@endisset
@section('thead')
    <th>
        <div><i class="fas fa-users"></i><span>Cliente</span></div>
    </th>
    <th>
        <div><i class="fa fa-shopping-bag"></i><span>Tipo</span></div>
    </th>
    <th>
        <div><i class="fas fa-file"></i><span>Comprovativa</span></div>
    </th>
    <th>
        <div><i class="fas fa-clock"></i><span>Tempo(Entrega)</span></div>
    </th>
    <th>
        <div><i class="fas fa-map"></i><span>Local(Entrega)</span></div>
    </th>
    <th colspan="2">
        <div><i class="fa fa-shopping-bag"></i><span>Produto</span></div>
    </th>
    <th colspan="2">
        <div><i class="fas fa-tools"></i><span>Acções</span></div>
    </th>
@endsection
@section('tbody')
    @foreach ($encomendas as $encomenda)
        <tr>
            <td cliente_id="{{ $encomenda->cliente_id }}" email="{{ $encomenda->cliente->user->email }}">{{ $encomenda->cliente->user->name }}</td>
            <td data-vd="{{ $encomenda->tipo_encomenda }}">{{ $encomenda->tipo_encomenda }}</td>
            <td>
                @if ($encomenda->file)
                    <a href="{{ url("storage/{$encomenda->file}") }}">
                        <i class="fas fa-eye"></i>
                        <span>visualizar</span>
                    </a>
                @endif
            </td>
            <td>{{ $encomenda->tempo_entrega }}</td>
            <td>{{ $encomenda->local_entrega }}</td>
            <td>
                <a href="#" class="text-success rounded btn-sm btn-produto-add d-flex gap-1 align-items-center" data-bs-toggle="modal"
                    data-bs-target="#modalProdutoList" code="" title="Adicionar\Produto"
                    url="{{ route('produto.encomenda.add', $encomenda->id) }}">
                    <i class="fas fa-plus"></i>
                    <span>adicionar</span>
                </a>
            </td>
            <td>
                <a href="#" class="text-info rounded btn-sm btn-produto-list d-flex gap-1 align-items-center" data-bs-toggle="modal"
                    data-bs-target="#modalProdutoList"  code="" title="Listar\Produto"
                    url="{{ route('produto.encomenda.list', $encomenda->id) }}" encomenda_id="{{ $encomenda->id }}">
                    <i class="fas fa-bars"></i>
                    <span>listar</span>
                    <sup>{{ count($encomenda->produtos) }}</sup>
                </a>
            </td>
            <td>
                <a href="#" class="text-warning rounded btn-sm btn-user-tr d-flex gap-1 align-items-center" data-bs-toggle="modal"
                    data-bs-target="#modalEncomenda" url="{{ route($panel . '.update', $encomenda->id) }}" method="PUT">
                    <i class="fas fa-user-edit"></i>
                    <span>editar</span>
                </a>
            </td>
            <td>
                <a href="#" class="text-danger rounded btn-sm btn-user-del d-flex gap-1 align-items-center" data-bs-toggle="modal"
                    data-bs-target="#modalEncomenda" url="{{ route($panel . '.destroy', $encomenda->id) }}" method="DELETE">
                    <i class="fas fa-user-times"></i>
                    <span>eliminar</span>
                </a>
            </td>
        </tr>
    @endforeach
@endsection
@section('modal')
    @include('components.modal.encomenda')
    @include('components.modal.encomenda.produto')
    <div hidden>
        <input type="hidden" id="url-json-cliente" value="{{ route("clientes.json.search") }}">
        <input type="hidden" id="url-json-produto" value="{{ route("produtos.json.search") }}">
    </div>
@endsection
@section('script')
    @parent
    <script src="{{ asset('js/help/clearForm.help.js') }}"></script>
    <script src="{{ asset('js/help/select.help.js') }}"></script>
    <script src="{{ asset('js/page/compra/cliente.js') }}"></script>
    <script src="{{ asset('js/page/encomenda/produto.js') }}"></script>
    <script src="{{ asset('js/page/encomenda.js') }}"></script>
@endsection
