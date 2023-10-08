(function (win, doc) {
    "use strict";

    const formUser = doc.querySelector('#form-user');
    const btnUserAdd = doc.querySelector("#btn-add-user");
    const modalUserTitle = doc.querySelector('#modalEncomendaTitle');
    const spanOperaction = doc.querySelector("#span-operaction");
    const colCliente = doc.querySelector("#col-cliente");

    const btnUpItems = doc.querySelectorAll('.btn-user-tr');
    const btnDelItems = doc.querySelectorAll('.btn-user-del');
    const encomendaEmCursos = doc.querySelectorAll('.encomendaEmCurso');
    const btnAvaliacoes = doc.querySelectorAll('.btn-avaliacao-add');

    function modalOperaction(item, action = false) {
        formUser.action = item.getAttribute('url');
        doc.querySelector("[name='_method']").setAttribute('value', item.getAttribute('method'));
        let row = item.parentElement.parentElement;
        let column = row.children;
        selectChange("tipo_encomenda", column[1].dataset.vd, action);
        let userDatas = [
            { name: "tempo_entrega", value: column[3].innerHTML, readonly: false },
            { name: "local_entrega", value: column[4].innerHTML, readonly: false }
        ];
        userDatas.forEach(obj => {
            let inptObj = doc.querySelector(`[name='${obj.name}']`);
            inptObj.value = obj.value;
            action ? inptObj.setAttribute('disabled', '') : inptObj.removeAttribute('disabled');
        });

        buildTable(column);
    }

    function buildTable(column) {
        colCliente.innerHTML = buildTableCliente(`<tr class="text-center">
        <td><input type="radio" name="cliente_id"  class="form-check-input" value="${column[0].getAttribute('cliente_id')}" checked></td>
        <td>${column[0].innerHTML}</td>
        <td>${column[0].getAttribute('email')}</td>
    </tr>`);
    }

    if (btnUserAdd) {
        btnUserAdd.addEventListener("click", (e) => {
            modalUserTitle.innerHTML = "Adicionar";
            spanOperaction.innerHTML = "cadastrar";
            formUser.action = btnUserAdd.getAttribute('url');
            doc.querySelector("[name='_method']").setAttribute('value', 'POST');
            colCliente.innerHTML = "";
            clearFormControlActive();
        });
    }

    btnUpItems.forEach(item => {
        item.addEventListener('click', (e) => {
            modalUserTitle.innerHTML = "Actualização";
            spanOperaction.innerHTML = "editar";
            modalOperaction(item);
        })
    });

    btnDelItems.forEach(item => {
        item.addEventListener('click', (e) => {
            modalUserTitle.innerHTML = "Apagar";
            spanOperaction.innerHTML = "eliminar";
            modalOperaction(item, true);
        })
    });

    function openConfirm(url, cls_add,cls_rem, message){
        let modal = doc.querySelector("#modalConfirm");
        let header = modal.querySelector(".modal-header");
        let body = modal.querySelector('.modal-body');
        let form = modal.querySelector('form');

        if(!header.classList.contains("text-white")){
            header.classList.add("text-white")
        }

        if(!header.classList.contains(cls_add)){
            header.classList.add(cls_add)
        }
        header.classList.remove(cls_rem);
        body.innerHTML = message;
        form.action = url;
    }

    encomendaEmCursos.forEach(item =>{
        item.addEventListener('click',(e)=>{
            let url = item.getAttribute('url'),
                     cls_add = "", cls_rem = "", message = "";
            console.log(item.value)
            if(item.value == 0){
                cls_add = "bg-warning";
                cls_rem = "bg-danger";
                message = "Tens certeza que desejas atender esta encomenda?"
            }else{
                cls_add = "bg-danger";
                cls_rem = "bg-warning";
                message = "Tens certeza que desejas cancelar esta encomenda?"
            }
            openConfirm(url,cls_add,cls_rem,message);
        });
    })

    btnAvaliacoes.forEach(item=>{
        item.addEventListener('click',(e)=>{
            const modal = doc.querySelector('#modalAvaliacao');
            const form = modal.querySelector('form');
            form.action = item.getAttribute('url');
        })
    });

})(window, document);
