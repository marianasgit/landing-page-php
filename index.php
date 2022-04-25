<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="./css/reset.css" />
  <link rel="stylesheet" href="./css/header.css" />
  <link rel="stylesheet" href="./css/sections.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" />
  <link rel="stylesheet" href="./css/section-destaque.css" />
  <script src="./main.js" defer></script>
  <title>Coffee Shop</title>
</head>

<body>
  <header>
    <div class="menu-burger">
      <input type="checkbox" id="checkbox-menu" />
      <label for="checkbox-menu">
        <span></span>
        <span></span>
        <span></span>
        <div class="menu">
          <ul class="dropdown-menu">
            <li class="item-menu"><a href="">Categorias</a></li>
            <li class="item-menu"><a href="">Café Moído</a></li>
            <li class="item-menu"><a href="">Café em Grãos</a></li>
            <li class="item-menu"><a href="">Café em Cápsulas</a></li>
          </ul>
        </div>
      </label>
    </div>
    <img src="img/logo.svg" alt="Logo" />
    <div></div>
    <nav>
      <ul class="navegacao">
        <li>DESTAQUES DA SEMANA</li>
        <li>CONHEÇA NOSSOS PRODUTOS</li>
        <li>PROMOÇÃO</li>
        <li>FALE CONOSCO</li>
      </ul>
    </nav>
  </header>
  <main>
    <section class="introducao">
      <h3>Coffee Making & Co.</h3>
      <div class="intro-text-img">
        <img class="img-intro" src="img/imagem-intro.svg" alt="">
        <div class="intro-text">
          <h5>Das mãos de especialistas em café para a sua casa ...</h5>
          <p>Uma marca desenvolvida por amantes de café e direcionada para um público tão apaixonado quanto nós por essa arte que é o café.
            Lorem Ipsum is simply dummy text of the printing and typesetting industry. <br> Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
        </div>
      </div>
    </section>
    <section class="destaques-semana">
      <h4>DESTAQUES DA SEMANA</h4>
      <div class="card-container-destaque">
        <div class="card"></div>
      </div>
      <div class="tarja-bege"></div>
      <img src="img/figura.svg" class="figura-destaques" alt="">
    </section>
    <section class="catalogo-produtos">
      <h4>CONHEÇA NOSSOS PRODUTOS</h4>
      <div class="card-container-catalogo">
        <div class="card"></div>
      </div>
      <button class="carregar-mais">Carregar Mais</button>
      <img src="img/gotadecafe.png" class="imagem-gota-de-cafe" alt="">
    </section>
    <section class="catalogo-promocoes">
      <h4>PROMOÇÃO!</h4>
      <div class="card-container-promocao">
        <div class="card"></div>
      </div>
    </section>
  </main>
  <footer>
    <form action="" method="post">
      <div class="campos">
        <div class="cadastroInformacoesPessoais">
          <label> Nome: </label>
        </div>
        <div class="cadastroEntradaDeDados">
          <input type="text" name="txtNome" value="" placeholder="Digite seu Nome" maxlength="100" />
        </div>
      </div>
      <div class="campos">
        <div class="cadastroInformacoesPessoais">
          <label> Email: </label>
        </div>
        <div class="cadastroEntradaDeDados">
          <input type="email" name="txtEmail" value="" />
        </div>
      </div>
      <div class="campos">
        <div class="cadastroInformacoesPessoais">
          <label> Mensagem: </label>
        </div>
        <div class="cadastroEntradaDeDados">
          <textarea name="txtObs" cols="50" rows="7"></textarea>
        </div>
      </div>
      <div class="enviar">
        <input type="submit" name="btnEnviar" value="Salvar" />
      </div>
      </div>
    </form>
  </footer>
</body>

</html>