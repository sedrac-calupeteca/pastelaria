<div class="modal fade m-2 p-1" id="modalConfirm" tabindex="-1" aria-labelledby="modalConfirmTitle" aria-hidden="true">
    <div class="modal-dialog">
      <form id="form-confirm" class="modal-content bg-white rounded" action="{{ $action }}" method="{{ $method }}">
        @csrf
        @method($method)
        <div class="modal-header">
          <h5 class="modal-title" id="modalConfirmTitle">Confirmação</h5>
        </div>
        <div class="modal-body">
            {{ $message }}
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-outline-primary rounded">
            <i class="fas fa-check"></i>
            <span id="span-operaction">Confirmo</span>
          </button>
        </div>
      </form>
    </div>
  </div>
