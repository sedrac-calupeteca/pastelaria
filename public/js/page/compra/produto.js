((doc) => {
    "use strict";

    const urlProduto = doc.querySelector("#url-json-produto");
    const searchProduto = doc.querySelector("#name_produto");
    const colProduto = doc.querySelector("#col-produto");

    function notRegister() {
        return `<div class="msg-empty mt-4 min">Nenhum produto com este nome foi encontrado.</div>`;
    }

    searchProduto.addEventListener("blur", function (e) {
        let html = "";
        fetch(`${urlProduto.value}?search=${searchProduto.value}`)
            .then((resp) => resp.json())
            .then((resp) => {
                resp.forEach((element, index) => {
                    html += `
                <tr class="text-center">
                    <td>
                        <input type="radio" id="sel_${index}" name="produto_id"  class="form-check-input produto" value="${element.id}" onclick="quantidadeStock(${element.quantidade_stock},${element.preco})">
                    </td>
                    <td>${element.nome}</td>
                    <td>${element.preco}</td>
                    <td>${element.quantidade_stock}</td>
                    <td>${element.categoria}</td>
                </tr>
                `;
                });
                colProduto.innerHTML =
                    html != "" ? buildTableProduto(html) : notRegister();
            });
    });
})(document);

let precoPagar = -1;
const inputQtdCompra = document.querySelector("#quantidade_compra");
const inputValorCompra = document.querySelector("#valor_compra_view");

function buildTableProduto(line) {
    return `<div class="table-responsive">
        <table class="table" id="table-produto">
        <thead>
        <tr>
            <th><div><i class="fas fa-check"></i><span>Selecionar</span></div></th>
            <th><div><i class="fas fa-signature"></i><span>Nome</span></div></th>
            <th><div><i class="fas fa-money-bill"></i><span>Preço</span></div></th>
            <th><div><i class="fas fa-sort-numeric-up"></i><span>Quantidade(Stock)</span></div></th>
            <th><div><i class="fas fa-check-square"></i><span>Categoria</span></div></th>
        </tr>
        </thead>
        <tbody>${line}</tbody>
        </table>
    </div>`;
}

function quantidadeStock(qtd, precoProduto){
    inputQtdCompra.setAttribute('max',qtd);
    if(inputQtdCompra.value >= qtd){
        inputQtdCompra.value = qtd;
    }
    document.querySelector("#preco_guard").value = precoProduto;
    inputValorCompra.value = inputQtdCompra.value * precoProduto;
}

inputQtdCompra.addEventListener('change',(e) => {
    const precoQuard = document.querySelector("#preco_guard");
    inputValorCompra.value =  inputQtdCompra.value * precoQuard.value;

});

