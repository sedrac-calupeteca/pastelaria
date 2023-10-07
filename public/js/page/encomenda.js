(function (win, doc) {
    "use strict";

    const formUser = doc.querySelector('#form-user');
    const btnUserAdd = doc.querySelector("#btn-add-user");
    const modalUserTitle = doc.querySelector('#modalEncomendaTitle');
    const spanOperaction = doc.querySelector("#span-operaction");
    const colCliente = doc.querySelector("#col-cliente");

    const btnUpItems = doc.querySelectorAll('.btn-user-tr');
    const btnDelItems = doc.querySelectorAll('.btn-user-del');

    function modalOperaction(item, action=false){
        formUser.action = item.getAttribute('url');
        doc.querySelector("[name='_method']").setAttribute('value',item.getAttribute('method'));
        let row = item.parentElement.parentElement;
        let column = row.children;
        selectChange("tipo_encomenda",column[1].dataset.vd, action);
        let userDatas = [
            {name:"tempo_entrega", value: column[3].innerHTML, readonly: false},
            {name:"local_entrega",value: column[4].innerHTML, readonly: false}
        ];
        userDatas.forEach(obj =>{
            let inptObj = doc.querySelector(`[name='${obj.name}']`);
            inptObj.value = obj.value;
            action ? inptObj.setAttribute('disabled','') : inptObj.removeAttribute('disabled');
        });

        buildTable(column);
    }

    function buildTable(column){
        colCliente.innerHTML = buildTableCliente(`<tr class="text-center">
        <td><input type="radio" name="cliente_id"  class="form-check-input" value="${column[0].getAttribute('cliente_id')}" checked></td>
        <td>${column[0].innerHTML}</td>
        <td>${column[0].getAttribute('email')}</td>
    </tr>`);
    }

    if(btnUserAdd){
    btnUserAdd.addEventListener("click", (e) => {
        modalUserTitle.innerHTML = "Adicionar";
        spanOperaction.innerHTML = "cadastrar";
        formUser.action = btnUserAdd.getAttribute('url');
        doc.querySelector("[name='_method']").setAttribute('value','POST');
        colCliente.innerHTML = "";
        clearFormControlActive();
    });
    }

    btnUpItems.forEach(item =>{
        item.addEventListener('click', (e)=>{
            modalUserTitle.innerHTML = "Actualização";
            spanOperaction.innerHTML = "editar";
            modalOperaction(item);
        })
    });

    btnDelItems.forEach(item =>{
        item.addEventListener('click', (e)=>{
            modalUserTitle.innerHTML = "Apagar";
            spanOperaction.innerHTML = "eliminar";
            modalOperaction(item, true);
        })
    });

})(window, document);
