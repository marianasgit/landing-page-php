"use strict";

const listarProduto = async () => {
  const baseURL = window.location.host;
  const url = `http://${baseURL}/cms/router.php?component=produtos&action=listar`;
  const response = await fetch(url);
  const data = await response.json();

  return data;
};

const criarCard = (produto) => {
  const card = document.createElement("div");
  card.classList.add("card");
  card.innerHTML = `
    <div class="card-image-container">
                    <img src="${produto.imagem}" alt="foto do produto" class="card-image">
                </div>
                <span class="card-produto nome">
                    ${produto.nome}
                </span>
                <span class="card-produto descricao">
                    ${produto.descricao}
                </span>
                <span class="card-preco">
                    R$ ${produto.preco}
                </span>
                <button class="btn-comprar">Comprar</button>`;

  return card;
};

const carregarProdutos = (produtos) => {
  const container = document.querySelector(".card-container-destaque");
  const cards = produtos.map(criarCard);

  container.replaceChildren(...cards);
};

const carregarProdutos2 = (produtos) => {
  const catalogo = document.querySelector(".card-container-catalogo");
  const cards = produtos.map(criarCard);

  catalogo.replaceChildren(...cards);
};

const carregarProdutos3 = (produtos) => {
  const promocao = document.querySelector(".card-container-promocao");
  const cards = produtos.map(criarCard);

  promocao.replaceChildren(...cards);
};

listarProduto().then((produtos) => {
  200;
  carregarProdutos(produtos);
  carregarProdutos2(produtos);
  carregarProdutos3(produtos);
});
