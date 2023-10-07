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
        <div><i class="fas fa-users"></i><span>Cliente</span></div>
    </th>
    <th>
        <div><i class="fas fa-money-bill"></i><span>Total(Pago)</span></div>
    </th>
    <th>
        <div><i class="fas fa-file"></i><span>Comprovativa</span></div>
    </th>
    <th>
        <div><i class="fas fa-calendar"></i><span>Data criação</span></div>
    </th>
    <th>
        <div><i class="fa fa-shopping-bag"></i><span>Produto</span></div>
    </th>
@endsection
@section('tbody')
    @foreach ($compras as $compra)
        <tr>
            <td cliente_id="{{ $compra->cliente_id }}" email="{{ $compra->cliente->user->email }}">
                {{ $compra->cliente->user->name }}
            </td>
            <td>{{ $compra->total }}</td>
            <td>
                @if ($compra->file)
                    <a href="{{ url("storage/{$compra->file}") }}">
                        <i class="fas fa-eye"></i>
                        <span>visualizar</span>
                    </a>
                @endif
            </td>
            <td>{{ $compra->created_at }}</td>
            <td class="text-center ml-4">
                <a href="#" class="text-info rounded btn-sm btn-produto-list d-flex gap-1 align-items-center"
                    url="{{ route('compra.produtos.json', $compra->id) }}" data-bs-toggle="modal"
                    data-bs-target="#modaCompraProduto">
                    <i class="fas fa-bars"></i>
                    <span>listar</span>
                    <sup>{{ count($compra->produtos) }}</sup>
                </a>
            </td>

        </tr>
    @endforeach
@endsection
@section('modal')
    <div hidden>
        <input type="hidden" id="url-json-cliente" value="{{ route('clientes.json.search') }}">
        <input type="hidden" id="url-json-produto" value="{{ route('produtos.json.search') }}">
    </div>

    @include('components.modal.loja', [
        'url' => '#',
        'panel' => 'modaCompraProduto',
        'panelId' => 'compraProdutoBody',
        'title' => 'Compras',
        'panelPagar' => 'totalPagarCompra',
        'hidden_comprovativo' => true,
    ])
@endsection
@section('script')
    @parent
    {{-- <script src="{{ asset('js/help/clearForm.help.js') }}"></script>
    <script src="{{ asset('js/page/compra/cliente.js') }}"></script>
    <script src="{{ asset('js/page/compra/produto.js') }}"></script> --}}
    <script src="{{ asset('js/page/compra.js') }}"></script>
@endsection
