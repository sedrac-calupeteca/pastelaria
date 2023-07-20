<div class="row pb-2" id="password-input">
    <div class="col-md-6">
        @include('components.input', [
            'label' => 'Senha utilizada:',
            'icon' => 'fas fa-user-lock',
            'type' => 'password',
            'name' => 'password',
            'placeholder' => 'Digita a sua senha utilizada',
            'require' => true,
            'rounded' => $rounded ?? false,
            'inline' => $inline ?? false,
            'disabled' => $disabled ?? false,
        ])
    </div>
    <div class="col-md-6">
        @include('components.input', [
            'label' => 'Confirma a senha utilizada:',
            'icon' => 'fas fa-keyboard',
            'type' => 'password',
            'name' => 'password_confirmation',
            'placeholder' => 'Confirma a sua senha utilizada',
            'require' => true,
            'rounded' => $rounded ?? false,
            'inline' => $inline ?? false,
            'disabled' => $disabled ?? false,
        ])
    </div>
</div>
<div class="row pb-3 pt-3 mt-2 mb-2" id="password-input-new">
    <div class="col-md-6">
        @include('components.input', [
            'label' => 'Senha nova:',
            'icon' => 'fas fa-lock',
            'type' => 'password',
            'name' => 'password_new',
            'placeholder' => 'Digita a sua senha nova',
            'require' => true,
            'rounded' => $rounded ?? false,
            'inline' => $inline ?? false,
            'disabled' => $disabled ?? false,
        ])
    </div>
    <div class="col-md-6">
        @include('components.input', [
            'label' => 'Confirma senha nova:',
            'icon' => 'fas fa-key',
            'type' => 'password',
            'name' => 'password_confirmation_new',
            'placeholder' => 'Confirma a sua senha nova',
            'require' => true,
            'rounded' => $rounded ?? false,
            'inline' => $inline ?? false,
            'disabled' => $disabled ?? false,
        ])
    </div>
</div>
