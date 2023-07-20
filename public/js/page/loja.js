(function (win, doc) {
    "use strict";

    const btnCompras = doc.querySelectorAll('.btn-compra');
    const btnEncomendas = doc.querySelectorAll('.btn-encomenda');

    const valorView = doc.querySelector("#valor_compra_view");

    const quantidadeCompra = doc.querySelector("#quantidade_compra");
    const quantidadeProduto = doc.querySelector('#quantidade_produto');
    const produtoPreco = doc.querySelector("#produto_preco");

    let preco = -1;

    quantidadeProduto.addEventListener('change', (e) => {
        if(preco > 0 ){
            produtoPreco.value = preco * quantidadeProduto.value;
        }
    });

    quantidadeCompra.addEventListener('change', (e) => {
        if(preco > 0 ){
            valorView.value = preco * quantidadeCompra.value;
        }
    });

    btnEncomendas.forEach((item) => {
        item.addEventListener('click', (e) => {
            const produtoName = doc.querySelector("#produto_name");
            const produtoId = doc.querySelector("#produto_encomenda_id");

            produtoId.value = item.getAttribute('produto_id');
            produtoName.value = item.getAttribute('produto');
            produtoPreco.value = preco = item.getAttribute('preco');
            quantidadeProduto.value = 1;
            quantidadeProduto.min = 1;
        });
    });

    btnCompras.forEach((item) => {
        item.addEventListener('click', (e) => {
            const produtoName = doc.querySelector("#name_produto");
            const produtoCompra = doc.querySelector("#produto_compra_view");


            valorView.value = preco = item.getAttribute('preco');
            produtoName.value = item.getAttribute('produto');
            produtoCompra.value = item.getAttribute('produto_id');

            quantidadeCompra.value = quantidadeCompra.min = 1;

        });
    });

})(window, document);
