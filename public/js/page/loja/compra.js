((doc) => {

    const KEY = "compras";
    const btnCompra = doc.querySelector("#btnCompra");
    const comprasActions = doc.querySelectorAll('.action-produto');
    const compraAction = doc.querySelector(".compraAction");

    intState();

    btnCompra.addEventListener('click',(e)=>{
        localStorage.setItem(KEY, JSON.stringify([]));
    });

    comprasActions.forEach(item => {
        item.addEventListener('click', () => {
            let produtos = getProdutoLocalStorage();
            let chave = item.getAttribute('produto');

            let produto = {
                key: chave,
                name: val(`produtoCardNome${chave}`),
                preco: val(`produtoCardPreco${chave}`),
                user: val(`user-key`),
                qtd: 1
            };

            const produtoFind = produtos.filter((n) => n.key == chave);

            if (produtoFind.length == 0) {
                produtos.push(produto);
            } else {
                produtos.forEach((n) => { if (n.key == chave) { n.qtd++; } });
            }

            localStorage.setItem(KEY, JSON.stringify(produtos));
            doc.querySelector("#compraQtd").innerHTML = produtos.length;
            selectedProdutos();
        });
    })

    compraAction.addEventListener('click', (e) => {
        let html = "";
        let items = getProdutoLocalStorage();
        let compraProdutoBody = doc.querySelector("#compraProdutoBody");

        items.forEach((item, index) => {
            html += `<tr id="prod${index}" class="prodRowCompra${item.key}">
                <td>
                    <span>${item.name}</span>
                    <input class="form-control" type="hidden" value="${item.name}" name="produto[]" />
                </td>
                <td>
                    <span>${item.preco}</span>
                    <input class="form-control" type="hidden" value="${item.preco}" name="preco[]" />
                </td>
                <td>
                    <input class="form-control btnQtds" type="number" min="1" value="${item.qtd}" name="qtd[]" index="${index}"/>
                    <input class="form-control" type="hidden" value="${item.key}" name="produto_id[]" />
                </td>
                <td>
                    <button type="button" class="btn btn-danger btnDeleteProdutoCompra" value="${item.key}">
                        <i class="fas fa-trash"></i>
                        <span>eliminar</span>
                    </button>
                </td>
            </tr>`;
        });

        compraProdutoBody.innerHTML = createTable(html);
        totalPagarCompra();
        loadFuncition();
    });

    function val(key) {
        return doc.querySelector("#" + key).innerHTML.trim();
    }

    function intState() {
        let produtos = getProdutoLocalStorage();
        doc.querySelector("#compraQtd").innerHTML = produtos.length;
        totalPagarCompra();
        selectedProdutos();
    }

    function selectedProdutos(){
        let produtos = getProdutoLocalStorage();
        produtos.forEach(it => {
            let btnProduto = doc.querySelector(`.produtoCompraBtn${it.key}`);
            if(!btnProduto.classList.contains('btn-seleted')){
                btnProduto.classList.add('btn-seleted');
            }
        })
    }

    function getProdutoLocalStorage() {
        const json = localStorage.getItem(KEY);
        return json ? JSON.parse(json) : [];
    }

    function loadFuncition(){
        const btnQtds = doc.querySelectorAll('.btnQtds');
        const btnDeleteProdutoCompra = doc.querySelectorAll('.btnDeleteProdutoCompra');

        btnQtds.forEach((item) => {
            item.addEventListener("change", (e) => {
                let produtos = getProdutoLocalStorage();
                let index = item.getAttribute('index');
                produtos[index].qtd = e.target.value;
                localStorage.setItem(KEY, JSON.stringify(produtos));
                totalPagarCompra();
            });
        })

        btnDeleteProdutoCompra.forEach((item) => {
            item.addEventListener('click',(e)=>{
                let produtosFilter = [];
                let produtos = getProdutoLocalStorage();
                produtos.forEach(it => {
                    if(it.key != item.value){
                        produtosFilter.push(it);
                    }else{
                        let btnProduto = doc.querySelector(`.produtoCompraBtn${it.key}`);
                        if(btnProduto.classList.contains('btn-seleted')){
                            btnProduto.classList.remove('btn-seleted');
                        }
                        doc.querySelector(`.prodRowCompra${it.key}`).remove();
                    }
                })
                localStorage.setItem(KEY, JSON.stringify(produtosFilter));
                intState();
            });
        })

    }

    function totalPagarCompra() {
        const totalPagarCompra = doc.querySelector("#totalPagarCompra");
        let items = getProdutoLocalStorage();
        let total = 0;
        items.forEach((item) => {
            total += item.preco * item.qtd;
        })
        totalPagarCompra.innerHTML = total;
    }

    function createTable(html) {
        if (html == "") return "";
        return `<table class="table table-striped table-hover text-center">
            <thead>
                <tr>
                    <th>Produto</th>
                    <th>Preço</th>
                    <th>Quantidade</th>
                    <th>Acções</th>
                </tr>
            </thead>
            <tbody>${html}</tbody>
        </table>`;
    }

})(document);
