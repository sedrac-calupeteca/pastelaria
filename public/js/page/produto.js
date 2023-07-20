(function (win, doc) {
    "use strict";

    const formUser = doc.querySelector('#form-user');
    const btnUserAdd = doc.querySelector("#btn-add-user");
    const modalUserTitle = doc.querySelector('#modalProdutoTitle');
    const spanOperaction = doc.querySelector("#span-operaction");

    const btnUpItems = doc.querySelectorAll('.btn-user-tr');
    const btnDelItems = doc.querySelectorAll('.btn-user-del');

    function modalOperaction(item, action=false){
        formUser.action = item.getAttribute('url');
        doc.querySelector("[name='_method']").setAttribute('value',item.getAttribute('method'));
        let row = item.parentElement.parentElement;
        let column = row.children;
        selectChange("categoria",column[2].dataset.vd, action);
        let userDatas = [
            {name:"nome", value: column[1].innerHTML, readonly: false},
            {name:"preco", value: column[3].innerHTML, readonly: false},
            {name:"quantidade_stock", value: column[4].innerHTML, readonly: false},
            {name:"descricao", value: column[5].innerHTML, readonly: false}
        ];
        userDatas.forEach(obj =>{
            let inptObj = doc.querySelector(`[name='${obj.name}']`);
            inptObj.setAttribute("value", obj.value);
            action ? inptObj.setAttribute('disabled','') : inptObj.removeAttribute('disabled');
        });
    }

    btnUserAdd.addEventListener("click", (e) => {
        modalUserTitle.innerHTML = "Adicionar";
        spanOperaction.innerHTML = "cadastrar";
        formUser.action = btnUserAdd.getAttribute('url');
        doc.querySelector("[name='_method']").setAttribute('value','POST');
        clearFormControlActive();
    });

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
