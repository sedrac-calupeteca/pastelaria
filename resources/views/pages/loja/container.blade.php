@php
    $isSearch = isset($search) && $search;
@endphp
<div class="container container-lg bg-white position-relative rounded p-2 m-2 m-auto w-100"
    style="margin-top: 2rem !important;">
    <div class="h5 mb-2 d-flex w-100">
        <div>
            <span>Cliente: </span>
            <span>{{ $cliente->user->name }}</span>
        </div>
        <div class="d-flex space">
            <div class="action-en compraAction" data-bs-toggle="modal" data-bs-target="#modaCompraProduto">
                compras(<span id="compraQtd">0</span>)
            </div>
            <div class="ml-1"> | </div>
            <div class="ml-1 action-en encomendaAction" data-bs-toggle="modal" data-bs-target="#modaEncomendaProduto">
                encomendas(<span id="encomendaQtd">0</span>)
            </div>
        </div>
    </div>
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
                <div class="card d-flex align-items-stretch mt-1" id="produtoCard{{ $produto->id }}">
                    <img src="{{ url("storage/{$produto->image}") }}" class="bd-placeholder-img card-img-top"
                        width="100%" height="170">
                    <div class="card-body">
                        <div class="card-title" id="card-title-{{ $loop->index }}">
                            <div id="produtoCardNome{{ $produto->id }}">{{ $produto->nome }}</div>
                            <div>
                                <strong>Preço:</strong>
                                <span id="produtoCardPreco{{ $produto->id }}">{{ $produto->preco }}</span>, Kz
                            </div>
                        </div>
                        <div class="card-text">{{ $produto->descricao }}</div>
                        <div>
                            <button class="btn btn-info btn-block rounded action-encomenda produtoEncomendaBtn{{ $produto->id }}" produto="{{ $produto->id }}">
                                <i class="fas fa-surprise"></i>
                                <span>Encomenda</span>
                            </button>
                            <button class="btn btn-warning btn-block rounded action-produto produtoCompraBtn{{ $produto->id }}" produto="{{ $produto->id }}">
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

    <div id="user-key">{{ $user->id }}</div>

    @include('components.modal.loja', [
        'url' => route('encomendas.store'),
        'panel' => 'modaEncomendaProduto',
        'panelId' => 'encomendaProdutoBody',
        'cliente' => $cliente,
        'title' => 'Encomendas',
        'panelPagar' => 'totalPagarEncomenda',
        'btnId' => 'btnEncomenda',
        'type' => 'encomenda',
        'hidden_comprovativo' => true,
    ])

    @include('components.modal.loja', [
        'url' => route('compras.store'),
        'panel' => 'modaCompraProduto',
        'panelId' => 'compraProdutoBody',
        'cliente' => $cliente,
        'title' => 'Compras',
        'panelPagar' => 'totalPagarCompra',
        'btnId' => 'btnCompra'
    ])

    <script src="{{ asset('js/page/loja/encomenda.js') }}"></script>
    <script src="{{ asset('js/page/loja/compra.js') }}"></script>
@else
    @include('components.modal.avisoautenticacao')
@endif
