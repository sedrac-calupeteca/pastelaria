<div class="row mt-3 pb-3">
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
    @isset($show_comprovativo)
        <div class="col-md-6">
            @include('components.input', [
                'label' => 'Conprovativo:',
                'icon' => 'fas fa-file',
                'type' => 'file',
                'name' => 'file',
                'placeholder' => 'Digita o endereço de entrega',
                'require' => true,
                'value' => $encomenda->local_entrega ?? '',
                'rounded' => $rounded ?? false,
                'inline' => $inline ?? false,
                'disabled' => $disabled ?? false,
            ])
        </div>
    @endisset
</div>
