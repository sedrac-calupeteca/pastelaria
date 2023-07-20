@if (isset($userCliente->cliente->id))
    <input type="hidden" name="cliente_id" value="{{ $userCliente->cliente->id }}">
    <input type="hidden" name="produto_id" value="" id="produto_compra_view">
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
            'disabled' => $disabled ?? false,
            'value' => $userCliente->name ?? null,
            'disabled' => $disabled ?? isset($userCliente),
        ])
    </div>
    <div class="col-md-12" id="col-cliente"></div>
</div>
<hr/>
<div class="row mt-1 pb-3">
    <div class="col-md-12">
        @include('components.input', [
            'label' => 'Digata o nome do produto',
            'icon' => 'fas fa-search',
            'type' => 'search',
            'name' => 'name_produto',
            'placeholder' => 'Digita o nome do produto para pesquisa',
            'rounded' => $rounded ?? false,
            'inline' => $inline ?? false,
            'disabled' => $disabled ?? isset($userCliente),
        ])
    </div>
    <div class="col-md-12" id="col-produto"></div>
</div>
<hr/>
<div class="row mt-1 pb-3">
    <div class="col-md-6">
        @include('components.input', [
            'label' => 'Quantidade(produto):',
            'icon' => 'fas fa-sort-numeric-up',
            'type' => 'number',
            'name' => 'quantidade_compra',
            'placeholder' => 'Digita a quantidade(produto) da compra',
            'require' => true,
            'value' => $compra->quantidade_compra ?? old('quantidade_compra'),
            'rounded' => $rounded ?? false,
            'inline' => $inline ?? false,
            'disabled' => $disabled ?? false,
            'min' => 1
        ])
    </div>
    <div class="col-md-6">
        @include('components.input', [
            'label' => 'Valor entrege:',
            'icon' => 'fas fa-money-bill',
            'type' => 'number',
            'name' => 'valor_compra',
            'placeholder' => 'valor para entrege',
            'require' => true,
            'value' => $compra->valor_compra ?? old('valor_compra'),
            'rounded' => $rounded ?? false,
            'inline' => $inline ?? false,
            'disabled' => $disabled ?? false,
            'min' => 1
        ])
    </div>
</div>
<div class="row mt-1 pb-3">
    <div class="col-md-6">
        @include('components.input', [
            'label' => 'Valor a pagar:',
            'icon' => 'fas fa-money-bill-alt',
            'type' => 'number',
            'name' => 'valor_compra_view',
            'placeholder' => 'valor para pagar',
            'value' =>  old('valor_compra_view'),
            'rounded' => $rounded ?? false,
            'inline' => $inline ?? false,
            'readonly' => true,
            'min' => 1
        ])
    </div>
    <div class="col-md-6">
        @include('components.input', [
            'label' => 'Comprovativo de pagamento:',
            'icon' => 'fas fa-file',
            'type' => 'file',
            'name' => 'file_compra',
            'placeholder' => 'valor para pagar',
            'value' =>  old('valor_compra_view'),
            'rounded' => $rounded ?? false,
            'inline' => $inline ?? false
        ])
    </div>   
</div>
