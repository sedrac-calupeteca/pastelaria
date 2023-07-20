<hr/>
<div class="row">
    <div class="col-md-6">
        @include('components.input', [
            'label' => 'Frequência de compra:',
            'icon' => 'fas fa-phone',
            'type' => 'number',
            'name' => 'frequencia_compra',
            'placeholder' => 'Digita a frequencia de compra',
            'value' => $user->cliente->frequencia_compra ?? '',
            'rounded' => $rounded ?? false,
            'inline' => $inline ?? false,
            'disabled' => $disabled ?? false,
        ])
    </div>
</div>
