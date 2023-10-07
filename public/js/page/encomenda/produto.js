const btnProdutoAdd = document.querySelectorAll(".btn-produto-add");
const btnProdutoList = document.querySelectorAll(".btn-produto-list");

const modalProdutoTitle = document.querySelector("#modalProdutoListTitle");
const produtoModalBody = document.querySelector("#produtoModalBody");
const formProduto = document.querySelector("#form-produto");
const btnCadastra = document.querySelector("#btn-cadastra-pro");

function createFormSearch() {
    return `<div class="p-2 border-bottom" id="panel-search">
            <input class="form-control rounded" placeholder="Digita o nome do produto" name="produto" id="produto_search" onkeyup="searchProduto()">
        </div>`;
}

btnProdutoAdd.forEach((item) => {
    item.addEventListener("click", (e) => {
        modalProdutoTitle.innerHTML = item.getAttribute("title");
        produtoModalBody.innerHTML = createFormSearch();
        formProduto.action = item.getAttribute('url');
        if(btnCadastra.classList.contains('d-none')){
            btnCadastra.classList.remove('d-none');
        }
    });
});

btnProdutoList.forEach((item) => {
    item.addEventListener("click", (e) => {
        let inptEncomenda =  document.querySelector("#encomenda_id_produto");
        modalProdutoTitle.innerHTML = item.getAttribute("title");
        formProduto.action = item.getAttribute('url');
        produtoModalBody.innerHTML = "";
        inptEncomenda.value = item.getAttribute('encomenda_id');

        if(!btnCadastra.classList.contains('d-none')){
            btnCadastra.classList.add('d-none');
        }

        fetch(`${formProduto.action}`)
        .then((resp) => resp.json())
        .then((resp) => {
            let html = "";
            resp.produtos.forEach((element) => {
                html += `<tr class="text-center">
                    <td>${element.nome}</td>
                    <td>${element.preco}</td>
                    <td>${element.quantidade_produto}</td>
                    <td>${element.quantidade_produto * element.preco}</td>
                    <td>
                        <button class="btn btn-danger btn-sm rounded" type="submit" name="encomenda_produto_id" value="${element.id}">
                            <i class"fas fa-times"></i>
                            <span>eliminar</span>
                        </button>
                    </td>
                </tr>`
            });
            produtoModalBody.innerHTML = buildTableProdutoList(html,resp.total);
        })

    });
});

function buildTableProdutoList(line, total) {
   return `<div class="mt-1 mb-1">
        <i class="fas fa-money-bill"></i>
        <span>Total(Pagar): </span>
        <span id="totalPagarProdutos">${total}</span>
    </div>
    <div class="table-responsive" id="table-produto">
        <table class="table" >
        <thead>
        <tr>
            <th><div><i class="fas fa-signature"></i><span>Nome</span></div></th>
            <th><div><i class="fas fa-money-bill"></i><span>Preço</span></div></th>
            <th><div><i class="fas fa-sort-numeric-up"></i><span>Quantidade(Produto)</span></div></th>
            <th><div><i class="fas fa-money-bill"></i><span>Valor(Pagar)</span></div></th>
            <th><div><i class="fas fa-check-square"></i><span>Acção</span></div></th>
        </tr>
        </thead>
        <tbody>${line}</tbody>
        </table>
    </div>`
}

function buildTableProduto(line) {
    const tableProduto = document.querySelector("#table-produto");
    const badgePanel =`<div id="badgeInputs" class="badge_row m-1 p-1"></div>`;
    const table =`
    <div class="mt-1 mb-1">
        <i class="fas fa-money-bill"></i>
        <span>Total(Pagar): </span>
        <span id="totalPagarProdutos"></span>
    </div>
    <div class="table-responsive" id="table-produto">
        <table class="table" >
        <thead>
        <tr>
            <th><div><span>QTD(Produto)</span></div></th>
            <th><div><i class="fas fa-check"></i><span>Selecionar</span></div></th>
            <th><div><i class="fas fa-signature"></i><span>Nome</span></div></th>
            <th><div><i class="fas fa-money-bill"></i><span>Preço</span></div></th>
            <th><div><i class="fas fa-sort-numeric-up"></i><span>Quantidade(Stock)</span></div></th>
            <th><div><i class="fas fa-check-square"></i><span>Categoria</span></div></th>
        </tr>
        </thead>
        <tbody>${line}</tbody>
        </table>
    </div>`

    if(tableProduto){
        tableProduto.remove();
        let badge = document.querySelector("#badgeInputs").outerHTML;
        return createFormSearch()+badge+table;
    }
    return createFormSearch()+badgePanel+table;
}

function badge(index, nome,qtd, preco){
    const codigo= document.querySelector("#code_"+index);
    const valor = codigo.value+"@"+qtd;
    return `<div class="h5 rounded-pill bg-primary p-1 badgeItemProduto" id="badge_item_${index}" preco="${preco}" qtd="${qtd}">
        <span class="badge">${nome}</span>
        <span onclick="deleteBadge(${index})"><i class="fas fa-times text-danger bg-white p-1 mr-1 pl-1 rounded"></i></span>
        <input type="checkbox" name="produtosQtd[]" id="prod_${index}" value="${valor}" checked hidden>
    </div>`
}

function calculateTotal(){
    const elementsProduto = document.querySelectorAll('.badgeItemProduto');
    const spanTotal = document.querySelector("#totalPagarProdutos");
    let valorPagar = 0;
    elementsProduto.forEach(produto => {
        valorPagar += produto.getAttribute('qtd') * produto.getAttribute('preco');
    });
    spanTotal.innerHTML = valorPagar;
}

function deleteBadge(index){
    const badgeDel = document.querySelector(`#badge_item_${index}`);
    badgeDel.remove();
    calculateTotal();
}

function badgeProduto(index){
    const badgeInputs = document.querySelector("#badgeInputs");
    const codeQtd = document.querySelector(`#code_qtd_${index}`);
    const codeNome = document.querySelector(`#code_nome_${index}`);
    const codePreco = document.querySelector(`#code_preco_${index}`);
    // const codeStock = document.querySelector(`#code_stock_${index}`);
    if(!document.querySelector("#badge_item_"+index)){
        badgeInputs.innerHTML += badge(index,codeNome.innerHTML, codeQtd.value, codePreco.innerHTML);
        calculateTotal();
    }
}

function qtdProdutoChange(index){
    const produtoBadge = document.querySelector(`#badge_item_${index}`);
    const codeQtd = document.querySelector(`#code_qtd_${index}`);
    const codigo= document.querySelector("#code_"+index);
    const produto = document.querySelector(`#prod_${index}`);
    if(produtoBadge){
        produtoBadge.setAttribute('qtd', codeQtd.value);
        produto.value = codigo.value+"@"+codeQtd.value;
        calculateTotal();
    }else{
        const spanTotal = document.querySelector("#totalPagarProdutos");
        spanTotal.innerHTML = `<span class="text-danger">Seleciona o produto</span>`;
    }
}

function searchProduto() {
    const urlProduto = document.querySelector("#url-json-produto");
    const search = document.querySelector("#produto_search").value;
    fetch(`${urlProduto.value}?search=${search}`)
        .then((resp) => resp.json())
        .then((resp) => {
            let html = "";
            resp.forEach((element) => {
                html += `
        <tr class="text-center">
            <td>
                <input type="number" id="code_qtd_${element.id}" min="1" name="produto_radio"   class="form-control rounded" value="1" onchange="qtdProdutoChange(${element.id})">
            </td>
            <td>
                <input type="radio" id="code_${element.id}"   class="form-check-input" value="${element.id}" onclick="badgeProduto(${element.id})">
            </td>
            <td id="code_nome_${element.id}">${element.nome}</td>
            <td id="code_preco_${element.id}">${element.preco}</td>
            <td id="code_stock_${element.id}">${element.quantidade_stock}</td>
            <td>${element.categoria}</td>
        </tr>
        `;
            });
            produtoModalBody.innerHTML = buildTableProduto(html);
        });
}

