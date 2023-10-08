(function (doc) {
    "use strict";

    const formAvaliacao = doc.querySelector('#form-avaliacao');
    const modalAvaliacaoTitle = doc.querySelector('#modalAvaliacaoTitle');
    const spanOperaction = doc.querySelector("#span-operaction");

    const btnUpItems = doc.querySelectorAll('.btn-avaliacao-tr');
    const btnDelItems = doc.querySelectorAll('.btn-avaliacao-del');

    function modalOperaction(item, action=false){
        formAvaliacao.action = item.getAttribute('url');
        doc.querySelector("[name='_method']").setAttribute('value',item.getAttribute('method'));
        let row = item.parentElement.parentElement;
        let column = row.children;
        selectChange("tipo",column[1].dataset.vd, action);
        let userDatas = [
            {name:"assunto", value: column[0].innerHTML, readonly: false, txt: false},
            {name:"descricao", value: column[2].innerHTML, readonly: false, txt: true}
        ];
        userDatas.forEach(obj =>{
            let inptObj = doc.querySelector(`[name='${obj.name}']`);
            if(obj.txt){
                inptObj.innerHTML = obj.value;
            }else{
                inptObj.setAttribute("value", obj.value);
            }
            action ? inptObj.setAttribute('disabled','') : inptObj.removeAttribute('disabled');
        });
    }

    btnUpItems.forEach(item =>{
        item.addEventListener('click', (e)=>{
            modalAvaliacaoTitle.innerHTML = "Actualização";
            spanOperaction.innerHTML = "editar";
            modalOperaction(item);
        })
    });

    btnDelItems.forEach(item =>{
        item.addEventListener('click', (e)=>{
            modalAvaliacaoTitle.innerHTML = "Apagar";
            spanOperaction.innerHTML = "eliminar";
            modalOperaction(item, true);
        })
    });

})(document);
