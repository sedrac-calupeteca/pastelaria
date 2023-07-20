@if (isset($userCliente->cliente->id))
    <input type="hidden" name="cliente_id" value="{{ $userCliente->cliente->id }}">
@endif
<div class="row mt-1 pb-3">
    <div class="col-md-12">
        @include('components.input', [
            'label' => 'Digata o nome do cliente',
            'icon' => 'fas fa-search',
            'type' => 'search',
            'name' => 'name_cliente',
            'placeholder' => 'Digita o nome do cliente para a pesquisa',
            'rounded' => $rounded ?? false,
            'inline' => $inline ?? false,
            'disabled' => $disabled ?? isset($userCliente),
            'value' => $userCliente->name ?? null,
        ])
    </div>
    <div class="col-md-12" id="col-cliente"></div>
</div>
<hr />
<div class="row mt-1 pb-3">
    <div class="col-md-6">
        @php use App\Utils\EncomendaUtil; @endphp
        @include('components.select', [
            'label' => 'Tipo(encomenda):',
            'icon' => 'fas fa-venus-mars',
            'name' => 'tipo_encomenda',
            'require' => true,
            'list' => EncomendaUtil::tiposEncomendas(),
            'init' => $encomenda->tipo_encomenda ?? '',
            'rounded' => $rounded ?? false,
            'inline' => $inline ?? false,
        ])
    </div>
    <div class="col-md-6">
        @include('components.input', [
            'label' => 'Tempo(entrega):',
            'icon' => 'fas fa-clock',
            'type' => 'datetime-local',
            'name' => 'tempo_entrega',
            'placeholder' => 'valor para entrege',
            'require' => true,
            'value' => $encomenda->tempo_entrega ?? old('tempo_entrega'),
            'rounded' => $rounded ?? false,
            'inline' => $inline ?? false,
            'disabled' => $disabled ?? false,
            'min' => 1,
        ])
    </div>
</div>
<div class="row mt-1 pb-3">
    <div class="col-md-6">
        @include('components.input', [
            'label' => 'Endereço de entrega:',
            'icon' => 'fas fa-map',
            'type' => 'text',
            'name' => 'local_entrega',
            'placeholder' => 'Digita o endereço de entrega',
            'require' => true,
            'value' => $encomenda->local_entrega ?? '',
            'rounded' => $rounded ?? false,
            'inline' => $inline ?? false,
            'disabled' => $disabled ?? false,
        ])
    </div>
</div>
@if (isset($joinProduto) && $joinProduto)
    <hr>
    <input type="hidden" name="produto_id" id="produto_encomenda_id"/>
    <div class="row mt-1 pb-3">
        <div class="col-md-6">
            @include('components.input', [
                'label' => 'Produto:',
                'icon' => 'fa fa-shopping-bag',
                'type' => 'text',
                'name' => 'produto_name',
                'placeholder' => '',
                'rounded' => $rounded ?? false,
                'inline' => $inline ?? false,
                'disabled' => true,
            ])
        </div>
        <div class="col-md-6">
            @include('components.input', [
                'label' => 'Preço:',
                'icon' => 'fa fa-money-bill',
                'type' => 'text',
                'name' => 'produto_preco',
                'placeholder' => '',
                'rounded' => $rounded ?? false,
                'inline' => $inline ?? false,
                'disabled' => true,
            ])
        </div>
        <div class="col-md-6">
            @include('components.input', [
                'label' => 'Quanridade:',
                'icon' => 'fas fa-sort-numeric-up',
                'type' => 'number',
                'name' => 'quantidade_produto',
                'placeholder' => 'Digita a quantidade',
                'require' => true,
                'value' => $encomenda->local_entrega ?? '',
                'rounded' => $rounded ?? false,
                'inline' => $inline ?? false,
                'disabled' => $disabled ?? false,
                'min' => 1
            ])
        </div>
    </div>
@endif
