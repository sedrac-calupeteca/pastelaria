<div class="modal fade m-2 p-1" id="{{ $panel }}" tabindex="-1" aria-labelledby="{{ $panel }}Title"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <form id="form-user" class="modal-content bg-white rounded" action="{{ $url ?? '' }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="modal-header">
                <h5 class="modal-title" id="{{ $panel }}Title">{{ $title }}</h5>
            </div>
            <div class="modal-body">
                <div class="mb-2">
                    <span>Total(Pagar): </span>
                    <span id="{{ $panelPagar }}">0</span>
                </div>
                @if (!isset($hidden_comprovativo))
                    <div class="mb-2">
                        <label>Comprovativo:</label>
                        <input class="form-control" type="file" value="" name="file" />
                    </div>
                @endif
                @isset($type)
                    @if ($type == "encomenda")
                    @include('components.import.encomenda',[
                        'rounded' => true,
                        'userCliente' => $user,
                        'show_comprovativo' => true
                    ])
                    @endif
                @endisset
                <div class="mt-1" id="{{ $panelId }}"></div>
                <input class="form-control" type="hidden" value="{{ $cliente->id ?? '' }}" name="cliente_id" />
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-outline-primary rounded" id="{{ $btnId ?? ''}}">
                    <i class="fas fa-check"></i>
                    <span id="span-operaction">Cadastra</span>
                </button>
                <button type="button" class="btn btn-outline-danger rounded" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i>
                    <span>Cancelar</span>
                </button>
            </div>
        </form>
    </div>
</div>
