<hr/>
<div class="row">
    <div class="col-md-6">
        @php use App\Utils\FuncionarioUtil; @endphp
        @include('components.select', [
            'label' => 'Categoria:',
            'icon' => 'fas fa-list-ol',
            'name' => 'categoria',
            'placeholder' => 'Digita a categoria:',
            'init' => $user->funcionario->categoria ?? '',
            'inline' => $inline ?? false,
            'disabled' => $disabled ?? false,
            'list' => FuncionarioUtil::categorias(),
            'rounded' => $rounded ?? false,
            'inline' => $inline ?? false,
        ])
    </div>
</div>
