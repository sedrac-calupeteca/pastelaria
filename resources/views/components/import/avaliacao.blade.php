<div class="row mt-1">
    <div class="col-md-6">
        @include('components.input', [
            'label' => 'Assunto:',
            'icon' => 'fas fa-signature',
            'type' => 'text',
            'name' => 'assunto',
            'placeholder' => 'Digita o assunto do avaliação',
            'require' => true,
            'value' => $avaliacao->assunto ?? old('assunto'),
        ])
    </div>
    <div class="col-md-6">
        @php use App\Utils\AvaliacaoUtil; @endphp
        @include('components.select', [
            'label' => 'Tipo:',
            'icon' => 'fas fa-check-square',
            'name' => 'tipo',
            'require' => true,
            'list' => AvaliacaoUtil::tiposAvaliacao(),
            'init' => $avaliacao->tipo ?? old('tipo'),
            'rounded' => $rounded ?? false,
            'inline' => $inline ?? false,
        ])
    </div>
</div>
<div class="row mt-1">
    <div class="col-md-12">
        @include('components.textaria', [
            'label' => 'Descrição:',
            'rows' => 6,
            'icon' => 'fas fa-comment',
            'name' => 'descricao',
            'placeholder' => 'Digita a Mensagem',
            'require' => true,
            'value' => $avaliacao->descricao ?? old('descricao'),
        ])
    </div>
</div>
