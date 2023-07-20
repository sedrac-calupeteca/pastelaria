<div class="modal fade m-2 p-1" id="modalAvisoAuth" tabindex="-1" aria-labelledby="modalUserTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div id="form-user" class="modal-content bg-white rounded">
            <div class="modal-header">
                <h5 class="modal-title" id="modalUserTitle">Aviso</h5>
            </div>
            <div class="modal-body">
                <p>Para a realização desta operação deves realizar autenticação ou cadastramento no nosso site.</p>
                <p>Caso não desejas fazer autenticação ou cadatramento podes entra em contacto com a nosso equipa pelos seguinte contacto</p>
                <ul>
                    <li>
                        email: pastelarialfamingo@gmail.com
                    </li>
                    <li>
                        contacto: 998234756/98433934
                    </li>
                </ul>
                <div class="d-flex flex-column gap-1">
                    <a class="text-primary t-d-n" href="{{ route('login') }}">
                        <i class="fas fa-user"></i>
                        <span class="ml-1">Já tenho uma conta</span>
                    </a>
                    <a class="text-info mt-2 t-d-n" href="{{ route('register') }}">
                        <i class="fas fa-file-alt"></i>
                        <span class="ml-1">Não tenho nenhuma conta.</span>
                    </a>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger rounded" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i>
                    <span>Cancelar</span>
                </button>
            </div>
        </div>
    </div>
</div>
