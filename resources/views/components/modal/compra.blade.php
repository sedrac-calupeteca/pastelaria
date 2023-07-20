<div class="modal fade m-2 p-1" id="modalCompra" tabindex="-1" aria-labelledby="modalCompraTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
      <form id="form-user" class="modal-content bg-white rounded" action="{{ $defaultUrl ?? "" }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <div class="modal-header">
          <h5 class="modal-title" id="modalCompraTitle">Adicionar</h5>
        </div>
        <div class="modal-body">
            <input type="hidden" name="key" id="key"/>
            @include('components.import.compra',[
                'rounded' => true,
                'userCliente' => $userCliente ?? null,
                'joinProduto' => $joinProduto ?? false
            ])
            <input type="hidden" id="preco_guard" value="" disabled readonly>
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