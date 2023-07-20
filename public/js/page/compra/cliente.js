((doc) => {
    "use strict";

    const urlClinte = doc.querySelector("#url-json-cliente");
    const searchCliente = doc.querySelector("#name_cliente");
    const colCliente = doc.querySelector("#col-cliente");

    function notRegister() {
        return `<div class="msg-empty mt-4 min">Nenhum cliente com este nome foi encontrado.</div>`;
    }

    searchCliente.addEventListener("blur", function (e) {
        let html = "";
        fetch(`${urlClinte.value}?search=${searchCliente.value}`)
            .then((resp) => resp.json())
            .then((resp) => {
                resp.forEach((element, index) => {
                    html += `
                <tr class="text-center">
                    <td>
                        <input type="radio" id="sel_${index}" name="cliente_id"  class="form-check-input" value="${element.cliente_id}">
                    </td>
                    <td>${element.name}</td>
                    <td>${element.email}</td>
                </tr>
                `;
                });
                colCliente.innerHTML =
                    html != "" ? buildTableCliente(html) : notRegister();
            });
    });
})(document);



function buildTableCliente(line) {
    return `<div class="table-responsive">
    <table class="table">
        <thead>
        <tr>
            <th><div><i class="fas fa-check"></i><span>Selecionar</span></div></th>
            <th><div><i class="fas fa-signature"></i><span>Nome</span></div></th>
            <th><div><i class="fas fa-at"></i><span>Email</span></div></th>
        </tr>
        </thead>
        <tbody>${line}</tbody>
        </table>
    </div>`;
}
