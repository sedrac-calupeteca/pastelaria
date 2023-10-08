<div class="modal fade m-2 p-1" id="modalUserSearch" tabindex="-1" aria-labelledby="modalUserSearchTitle" aria-hidden="true">
    <div class="modal-dialog">
      <form id="form-user" class="modal-content bg-white rounded" action="{{ $route }}" method="{{ $method ?? 'GET'}}" enctype="multipart/form-data">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="modalUserSearchTitle">Pesquisar</h5>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-4">
                    <select class="form-control" name="chave">
                        @foreach ($parmas as $key => $value)
                            <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-8">
                    <input class="form-control" name="valor"/>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-outline-primary rounded">
            <i class="fas fa-check"></i>
            <span id="span-operaction">Procurar</span>
          </button>
        </div>
      </form>
    </div>
  </div>
