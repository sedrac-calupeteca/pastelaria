@php
    $isSearch = isset($search) && $search;
@endphp
<div class="container container-lg bg-white rounded p-2 m-2 m-auto w-100" style="margin-top: 2rem !important;">
    <div>
        <form action="{{ $route }}" class="d-flex gap-1">
            <input class="form-control rounded" type="search" name="search" id=""
                placeholder="Digita o produto a procura" required />
            <div @if ($isSearch) class="d-flex gap-1" @endif>
                @if ($isSearch)
                    <a class="btn btn-warning d-flex align-items-center gap-2 rounded" href="{{ $route }}">
                        <i class="fa fa-reply" aria-hidden="true"></i>
                        <span>recarregar</span>
                    </a>
                @endif
                <button class="btn btn-primary d-flex align-items-center gap-2 rounded" type="submit">
                    <i class="fa fa-search" aria-hidden="true"></i>
                    <span>pesquisar</span>
                </button>
            </div>
        </form>
    </div>
    <hr />
    <div class="row">
        @php $isAuth = isset(Auth::user()->id); @endphp
        @foreach ($produtos as $produto)
            <div class="col-md-4">
                <div class="card d-flex align-items-stretch">
                    <img src="{{ url("storage/{$produto->image}") }}" class="bd-placeholder-img card-img-top"
                        width="100%" height="170">
                    <div class="card-body">
                        <div class="card-title" id="card-title-{{ $loop->index }}">
                            <div class="">{{ $produto->nome }}</div>
                            <div> <strong>Preço:</strong> {{ $produto->preco }}, Kz</div>
                        </div>
                        <div class="card-text">{{ $produto->descricao }}</div>
                        <div>
                            <button class="btn btn-info btn-block rounded btn-encomenda" data-bs-toggle="modal"
                                @if ($isAuth) data-bs-target="#modalEncomenda"  produto_id="{{ $produto->id }}" produto="{{ $produto->nome }}" preco="{{ $produto->preco }}" @else data-bs-target="#modalAvisoAuth" @endif>
                                <i class="fas fa-surprise"></i>
                                <span>Encomenda</span>
                            </button>
                            <button class="btn btn-warning btn-block rounded btn-compra" data-bs-toggle="modal"
                                @if ($isAuth) data-bs-target="#modalCompra" produto_id="{{ $produto->id }}" produto="{{ $produto->nome }}" preco="{{ $produto->preco }}" @else data-bs-target="#modalAvisoAuth" @endif>
                                <i class="fas fa-money-bill-wave"></i>
                                <span>Compra</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div id="pag" class="mt-3">
        {{ $produtos->links() }}
    </div>
    @if ($produtos->total() == 0)
        <div class="msg-empty">
            Produto não foi encontrado
        </div>
    @endif
</div>

@if ($isAuth)
    @include('components.modal.encomenda', [
        'defaultUrl' => route('loja.encomenda'),
        'userCliente' => $auth ?? null,
        'joinProduto' => true,
    ])

    @include('components.modal.compra', [
        'defaultUrl' => route('compras.store'),
        'userCliente' => $auth ?? null,
        'joinProduto' => true,
    ])

    <script src="{{ asset('js/page/loja.js') }}"></script>
@else
    @include('components.modal.avisoautenticacao')
@endif
