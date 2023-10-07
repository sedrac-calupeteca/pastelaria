(function (doc) {
    "use strict";

    const btnListProduto = doc.querySelectorAll(".btn-produto-list");

    function createTable(html) {
        if (html == "") return "";
        return `<table class="table table-striped table-hover text-center">
        <thead>
            <tr>
                <th>Produto</th>
                <th>Preço</th>
                <th>Quantidade</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>${html}</tbody>
    </table>`;
    }

    btnListProduto.forEach(item => {

        item.addEventListener('click', (e) => {
            let url = item.getAttribute('url');
            let total = doc.querySelector("#totalPagarCompra");
            let body = doc.querySelector("#compraProdutoBody");
            fetch(url)
                .then(resp => resp.json())
                .then(data => {
                    let html = '';
                    let totalIt = 0;
                    data.forEach( it=> {
                        totalIt += it.total;
                        html += `<tr>
                            <td>${it.produto.nome}</td>
                            <td>${it.preco}</td>
                            <td>${it.qtd}</td>
                            <td>${it.total}</td>
                        </tr>`
                    })
                    body.innerHTML = createTable(html);
                    total.innerHTML = totalIt;
                });
        });

    });

})(document);
