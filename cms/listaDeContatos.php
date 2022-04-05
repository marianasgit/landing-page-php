<?php

// Valida se a utilização de variaveis de sessao esta ativa no servidor
if (session_status()) {

  // Valida se a variavel se sessao dadosContato nao esta vazia
  if (!empty($_SESSION['dadosContato'])) {
    $id         = $_SESSION['dadosContato']['id'];
    $nome       = $_SESSION['dadosContato']['nome'];
    $email      = $_SESSION['dadosContato']['email'];
    $obs        = $_SESSION['dadosContato']['obs'];
  }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="listaDeContatos.css" />
  <title>CMS</title>
</head>

<body>
  <header>
    <h3>C M S Coffee Shop</h3>
    <h5>GERENCIAMENTO DE CONTEÚDO DO SITE</h5>
    <img class="logo" src="../img/logo.svg" alt="" />
  </header>
  <section class="secao-navegacao">
    <nav class="navegacao">
      <ul>
        <img src="../img/novo-produto.png" alt="" />
        <li>Adm. de Produtos</li>
      </ul>
      <ul>
        <img src="../img/categorias.png" alt="" />
        <li>Adm. de Categorias</li>
      </ul>
      <ul>
        <img src="../img/mensagens.png" alt="" />
        <li>Contatos</li>
      </ul>
      <ul>
        <img src="../img/usuario-verificado.png" alt="" />
        <li>Usuários</li>
      </ul>
      <div class="logout">
        <p>Bem vindo usuário</p>
        <img src="../img/logout.png" alt="" />
        <p>Logout</p>
      </div>
    </nav>
  </section>
  <section class="sessao">
    <h3>Contatos</h3>
  </section>
  <div id="consultaDeDados">
    <table id="tblConsulta">
      <tr>
        <td id="tblTitulo" colspan="6">
          <h1> Registro de Contatos </h1>
        </td>
      </tr>
      <tr id="tblLinhas">
        <td class="tblColunas destaque"> Nome </td>
        <td class="tblColunas destaque"> Email </td>
        <td class="tblColunas destaque"> Mensagem </td>
        <td class="tblColunas destaque"> Opções </td>
      </tr>

      <?php
      // Import do arquivo da controller para asolicitar a listagem dos dados 
      require_once('controller/controllerContatos.php');
      // Chama a função que retorna os dados de contatos 
      $listContato = listarContato();
      // Estrutura de repetição para retornar os dados do array e printar na tela 
      foreach ($listContato as $item) {
      ?>
        <tr id="tblLinhas">
          <td class="tblColunas registros"><?= $item['nome'] ?></td>
          <td class="tblColunas registros"><?= $item['email'] ?></td>
          <td class="tblColunas registros"><?= $item['obs'] ?></td>

          <td class="tblColunas registros">
            <a onclick="return confirm('Deseja excluir esse item?')" href="router.php?component=contatos&action=deletar&id=<?= $item['id'] ?>">
              <img src="./landing-page-php/img/excluir.png" alt="Excluir" title="Excluir" class="excluir">
            </a>
          </td>    
        </tr>
      <?php
      }
      ?>
    </table>
  </div>
</body>

</html>