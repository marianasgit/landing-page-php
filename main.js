"use strict";

const db = [
  {
    id: 1,
    nome: "Baggio Café Espresso Grão 500g",
    descricao: "Um café premium de alta qualidade com notas intensas",
    preco: 29.7,
    imagem: "./img/img-cafe.svg",
  },
  {
    id: 2,
    nome: "Baggio Café Espresso Grão 500g",
    descricao: "Um café premium de alta qualidade com notas intensas",
    preco: 29.7,
    imagem: "./img/img-cafe.svg",
  },
  {
    id: 3,
    nome: "Baggio Café Espresso Grão 500g",
    descricao: "Um café premium de alta qualidade com notas intensas",
    preco: 29.7,
    imagem: "./img/img-cafe.svg",
  },
  {
    id: 4,
    nome: "Baggio Café Espresso Grão 500g",
    descricao: "Um café premium de alta qualidade com notas intensas",
    preco: 29.7,
    imagem: "./img/img-cafe.svg",
  },
];

const criarCard = (produto) => {
  const card = document.createElement("div");
  card.classList.add("card");
  card.innerHTML = `
    <div class="card-image-container">
                    <img src="${produto.imagem}" alt="monitor" class="card-image">
                </div>
                <span class="card-produto">
                    ${produto.nome}
                </span>
                <span class="card-produto">
                    ${produto.descricao}
                </span>
                <span class="card-preco">
                    R$ ${produto.preco}
                </span>
                <button>Comprar<button>
    `;

  return card;
};

const carregarProdutos = (produtos) => {
  const container = document.querySelector(".card-container");
  const cards = produtos.map(criarCard);

  container.replaceChildren(...cards);
};

carregarProdutos(db);
