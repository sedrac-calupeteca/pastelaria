<div class="modal fade m-2 p-1" id="modalProdutoList" tabindex="-1" aria-labelledby="modalProdutoListTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
      <form id="form-produto" class="modal-content bg-white rounded" action="" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="modalProdutoListTitle"></h5>
        </div>
        <div class="modal-body" id="produtoModalBody">

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-outline-primary rounded" id="btn-cadastra-pro">
            <i class="fas fa-check"></i>
            <span id="span-operaction">Cadastra</span>
          </button>
          <button type="button" class="btn btn-outline-danger rounded" data-bs-dismiss="modal">
            <i class="fas fa-times"></i>
            <span>Cancelar</span>
          </button>
          <input type="hidden" name="encomenda_id" id="encomenda_id_produto">
        </div>
      </form>
    </div>
  </div>
