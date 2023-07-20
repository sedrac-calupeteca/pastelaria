<div class="row mt-1">
    <div class="col-md-6">
        @include('components.input', [
            'label' => 'Nome:',
            'icon' => 'fas fa-signature',
            'type' => 'text',
            'name' => 'nome',
            'placeholder' => 'Digita o nome do produto',
            'require' => true,
            'value' => $produto->nome ?? old('nome'),
        ])
    </div>
    <div class="col-md-6">
        @php use App\Utils\ProdutoUtil; @endphp
        @include('components.select', [
            'label' => 'Categoria:',
            'icon' => 'fas fa-check-square',
            'name' => 'categoria',
            'require' => true,
            'list' => ProdutoUtil::categorias(),
            'init' => $produto->categoria ?? old('categoria'),
            'rounded' => $rounded ?? false,
            'inline' => $inline ?? false,
        ])
    </div>
</div>
<div class="row mt-1 pb-3">
    <div class="col-md-6">
        @include('components.input', [
            'label' => 'Preço:',
            'icon' => 'fas fa-money-bill',
            'type' => 'number',
            'name' => 'preco',
            'placeholder' => 'Digita o preço do produto',
            'require' => true,
            'value' => $produto->preco ?? old('preco'),
            'rounded' => $rounded ?? false,
            'inline' => $inline ?? false,
            'disabled' => $disabled ?? false,
        ])
    </div>
    <div class="col-md-6">
        @include('components.input', [
            'label' => 'Quantidade(stock):',
            'icon' => 'fas fa-sort-numeric-up',
            'type' => 'number',
            'name' => 'quantidade_stock',
            'placeholder' => 'Digita a quantidade em stock',
            'require' => true,
            'value' => $produto->quantidade_stock ?? old('quantidade_stock'),
            'rounded' => $rounded ?? false,
            'inline' => $inline ?? false,
            'disabled' => $disabled ?? false,
        ])
    </div>
</div>
<div class="row mt-1 pb-3">
    <div class="col-md-6">
        @include('components.input', [
            'label' => 'Anexa a imagem do produto:',
            'icon' => 'fas fa-image',
            'type' => 'file',
            'name' => 'image',
            'placeholder' => 'Anexa a imagem',
            'value' => $produto->image ?? '',
            'rounded' => $rounded ?? false,
        ])
    </div>
    <div class="col-md-6">
        @include('components.input', [
            'label' => 'Faça uma descrição:',
            'icon' => 'fas fa-comment',
            'type' => 'text',
            'name' => 'descricao',
            'placeholder' => 'Escreva uma descrição curta',
            'require' => true,
            'value' => $produto->descricao ?? old('descricao'),
            'rounded' => $rounded ?? false,
            'inline' => $inline ?? false,
            'disabled' => $disabled ?? false,
        ])
    </div>
</div>
