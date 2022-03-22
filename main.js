"use strict";

const db = [
  {
    id: 1,
    nome: "Baggio Café Espresso Grão 500g",
    descricao: "Um café premium de alta qualidade com notas intensas",
    preco: "29.70",
    imagem: "./img/img-cafe.svg",
  },
  {
    id: 2,
    nome: "Baggio Café Espresso Grão 500g",
    descricao: "Um café premium de alta qualidade com notas intensas",
    preco: "29.70",
    imagem: "./img/img-cafe.svg",
  },
  {
    id: 3,
    nome: "Baggio Café Espresso Grão 500g",
    descricao: "Um café premium de alta qualidade com notas intensas",
    preco: "29.70",
    imagem: "./img/img-cafe.svg",
  },
  {
    id: 4,
    nome: "Baggio Café Espresso Grão 500g",
    descricao: "Um café premium de alta qualidade com notas intensas",
    preco: "29.70",
    imagem: "./img/img-cafe.svg",
  },
];

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

carregarProdutos(db);
carregarProdutos2(db);
carregarProdutos3(db);
