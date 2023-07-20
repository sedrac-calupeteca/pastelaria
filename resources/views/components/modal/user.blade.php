<div class="modal fade m-2 p-1" id="modalUser" tabindex="-1" aria-labelledby="modalUserTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form id="form-user" class="modal-content bg-white rounded" action="" method="POST">
            @csrf
            @method('POST')
            <div class="modal-header">
                <h5 class="modal-title" id="modalUserTitle"></h5>
            </div>
            <div class="modal-body">
                <input type="hidden" name="key" id="key" />
                @include('components.import.user', [
                    'rounded' => true,
                ])
                @isset($type)
                    @if ($type == 'funcionarios')
                        @include('components.import.user.funcionario')
                    @elseif($type == 'clientes')
                        @include('components.import.user.cliente')
                    @endif
                @endisset
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-outline-primary rounded">
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
