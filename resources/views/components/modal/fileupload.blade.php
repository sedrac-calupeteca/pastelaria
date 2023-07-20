<div class="modal fade m-2 p-1" id="modalFile" tabindex="-1" aria-labelledby="modalFileTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <form id="form-file" class="modal-content bg-white rounded" action="" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="modal-header">
                <h5 class="modal-title" id="modalFileTitle">Actualizar o ficheiro</h5>
            </div>
            <div class="modal-body">
                @include('components.input', [
                    'label' => 'Anexa ficheiro:',
                    'icon' => 'fas fa-file-alt',
                    'type' => 'file',
                    'name' => 'file',
                    'placeholder' => 'Anexa um ficheiro',
                    'value' => $content->file ?? '',
                    'rounded' => $rounded ?? false,
                ])
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-outline-primary rounded">
                    <i class="fas fa-check"></i>
                    <span id="span-operaction">Actualizar</span>
                </button>
                <button type="button" class="btn btn-outline-danger rounded" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i>
                    <span>Cancelar</span>
                </button>
            </div>
        </form>
    </div>
</div>
