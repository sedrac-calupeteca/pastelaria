(function (win, doc) {
    "use strict";

    const formUser = doc.querySelector('#form-user');
    const btnUserAdd = doc.querySelector("#btn-add-user");
    const modalUserTitle = doc.querySelector('#modalUserTitle');
    const spanOperaction = doc.querySelector("#span-operaction");

    const btnUpItems = doc.querySelectorAll('.btn-user-tr');
    const btnDelItems = doc.querySelectorAll('.btn-user-del');


    const formPasswords = [
        doc.querySelector("#password"),
        doc.querySelector("#password_confirmation")
    ];

    function openOrClosePassword(state){
        const panel = doc.querySelector("#password-input");
        state ? panel.classList.remove('d-none') : panel.classList.add('d-none');
        formPasswords.forEach( (item) =>{
            state ? item.removeAttribute('disabled') : item.setAttribute('disabled','');
        });
    }

    function modalOperaction(item, action=false){
        formUser.action = item.getAttribute('url');
        doc.querySelector("[name='_method']").setAttribute('value',item.getAttribute('method'));
        openOrClosePassword(false);
        let row = item.parentElement.parentElement;
        let column = row.children;
        selectChange("gender",column[3].dataset.vd, action);
        let userDatas = [
            {name:"name", value: column[1].innerHTML, readonly: false},
            {name:"email", value: column[2].innerHTML, readonly: true},
            {name:"phone", value: column[4].innerHTML, readonly: false},
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
        openOrClosePassword(true);
        clearFormControl();
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
