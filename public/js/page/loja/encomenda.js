((doc) => {

    const KEY = "encomendas";
    const btnEncomenda = doc.querySelector("#btnEncomenda");
    const encomendasActions = doc.querySelectorAll('.action-encomenda');
    const encomendaAction = doc.querySelector(".encomendaAction");

    intState();

    btnEncomenda.addEventListener('click',(e)=>{
        localStorage.setItem(KEY, JSON.stringify([]));
    });

    function selectedProdutos(){
        let produtos = getProdutoLocalStorage();
        produtos.forEach(it => {
            let btnProduto = doc.querySelector(`.produtoEncomendaBtn${it.key}`);
            if(!btnProduto.classList.contains('btn-seleted')){
                btnProduto.classList.add('btn-seleted');
            }
        })
    }

    encomendasActions.forEach(item => {
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
            doc.querySelector("#encomendaQtd").innerHTML = produtos.length;
            selectedProdutos();
        });
    })

    encomendaAction.addEventListener('click', (e) => {
        let html = "";
        let items = getProdutoLocalStorage();
        let encomendaProdutoBody = doc.querySelector("#encomendaProdutoBody");

        items.forEach((item, index) => {
            html += `<tr id="prod${index}" class="prodRowEncomenda${item.key}">
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
                    <button type="button" class="btn btn-danger btnDeleteProdutoEncomenda" value="${item.key}">
                        <i class="fas fa-trash"></i>
                        <span>eliminar</span>
                    </button>
                </td>
            </tr>`;
        });

        encomendaProdutoBody.innerHTML = createTable(html);
        totalPagarEncomenda();
        loadFuncition();
    });

    function val(key) {
        return doc.querySelector("#" + key).innerHTML.trim();
    }

    function intState() {
        let produtos = getProdutoLocalStorage();
        doc.querySelector("#encomendaQtd").innerHTML = produtos.length;
        totalPagarEncomenda()
        selectedProdutos();
    }

    function getProdutoLocalStorage() {
        const json = localStorage.getItem(KEY);
        return json ? JSON.parse(json) : [];
    }

    function loadFuncition(){
        const btnQtds = doc.querySelectorAll('.btnQtds');
        const btnDeleteProdutoEncomenda = doc.querySelectorAll('.btnDeleteProdutoEncomenda');

        btnQtds.forEach((item) => {
            item.addEventListener("change", (e) => {
                let produtos = getProdutoLocalStorage();
                let index = item.getAttribute('index');
                produtos[index].qtd = e.target.value;
                localStorage.setItem(KEY, JSON.stringify(produtos));
                totalPagarEncomenda();
            });
        })

        btnDeleteProdutoEncomenda.forEach((item) => {
            item.addEventListener('click',(e)=>{
                let produtosFilter = [];
                let produtos = getProdutoLocalStorage();
                produtos.forEach(it => {
                    if(it.key != item.value){
                        produtosFilter.push(it);
                    }else{
                        let btnProduto = doc.querySelector(`.produtoEncomendaBtn${it.key}`);
                        if(btnProduto.classList.contains('btn-seleted')){
                            btnProduto.classList.remove('btn-seleted');
                        }
                        doc.querySelector(`.prodRowEncomenda${it.key}`).remove();
                    }
                })
                localStorage.setItem(KEY, JSON.stringify(produtosFilter));
                intState();
            });
        })

    }

    function totalPagarEncomenda() {
        const totalPagarEncomenda = doc.querySelector("#totalPagarEncomenda");
        let items = getProdutoLocalStorage();
        let total = 0;
        items.forEach((item) => {
            total += item.preco * item.qtd;
        })
        totalPagarEncomenda.innerHTML = total;
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
