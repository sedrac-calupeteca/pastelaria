(function (win, doc) {
    "use strict";

    const formUser = doc.querySelector('#form-user');
    const btnUserAdd = doc.querySelector("#btn-add-user");
    const modalUserTitle = doc.querySelector('#modalCompraTitle');
    const spanOperaction = doc.querySelector("#span-operaction");
    const colCliente = doc.querySelector("#col-cliente");
    const colProduto = doc.querySelector("#col-produto");

    const btnUpItems = doc.querySelectorAll('.btn-user-tr');
    const btnDelItems = doc.querySelectorAll('.btn-user-del');

    function modalOperaction(item, action=false){
        formUser.action = item.getAttribute('url');
        doc.querySelector("[name='_method']").setAttribute('value',item.getAttribute('method'));
        let row = item.parentElement.parentElement;
        let column = row.children;
        let total = parseFloat(column[3].innerHTML) * parseFloat(column[2].innerHTML)
        let userDatas = [
            {name:"quantidade_compra", value: column[3].innerHTML, readonly: false},
            {name:"valor_compra", value: column[4].innerHTML, readonly: false},
            {name:"valor_compra_view",value: total, readonly: false}
        ];
        userDatas.forEach(obj =>{
            let inptObj = doc.querySelector(`[name='${obj.name}']`);
            inptObj.value = obj.value;
            action ? inptObj.setAttribute('disabled','') : inptObj.removeAttribute('disabled');
        });
        document.querySelector("#preco_guard").value = parseFloat(column[2].innerHTML);
        buildTable(column);
    }

    function buildTable(column){
        colCliente.innerHTML = buildTableCliente(`<tr class="text-center">
        <td><input type="radio" name="cliente_id"  class="form-check-input" value="${column[1].getAttribute('cliente_id')}" checked></td>
        <td>${column[1].innerHTML}</td>
        <td>${column[1].getAttribute('email')}</td>
    </tr>`);
        colProduto.innerHTML = buildTableProduto(`<tr class="text-center">
            <td>
            <input type="radio" name="produto_id"  class="form-check-input produto" value="${column[0].getAttribute('produto_id')}" onclick="quantidadeStock(${column[0].getAttribute('stock')},${column[2].innerHTML})" checked>
            </td>
            <td>${column[0].innerHTML}</td>
            <td>${column[2].innerHTML}</td>
            <td>${column[0].getAttribute('stock')}</td>
            <td>${column[0].getAttribute('categoria')}</td>
        </tr>`);
    }

    if(btnUserAdd){
    btnUserAdd.addEventListener("click", (e) => {
        modalUserTitle.innerHTML = "Adicionar";
        spanOperaction.innerHTML = "cadastrar";
        formUser.action = btnUserAdd.getAttribute('url');
        doc.querySelector("[name='_method']").setAttribute('value','POST');
        colCliente.innerHTML = colProduto.innerHTML = "";
        clearFormControlActiveDifferentId(['valor_compra_view']);
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
