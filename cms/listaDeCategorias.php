<?php

// Valida se a utilização de variaveis de sessao esta ativa no servidor
if (session_status()) {

  // Valida se a variavel se sessao dadosCategoria nao esta vazia
  if (!empty($_SESSION['dadosCategoria'])) 
  {
    $id   = $_SESSION['dadosCategoria']['id'];
    $nome = $_SESSION['dadosCategoria']['nome'];
  }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="./css/listaDeCategorias.css" />
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
        <li>Categorias</li>
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

  <section class="sessao categorias">
    <h3>Categorias</h3>
    <div class="cadastroCategorias">
      <h3>Cadastro de Categorias</h3>
      <form action="router.php?component=categorias&action=inserir" name="frmCadastro" method="post">
        <div class="campos">
          <div class="cadastroInformacoesPessoais">
            <label> Nome: </label>
          </div>
          <div class="cadastroEntradaDeDados">
            <input type="text" name="txtNome" value="<?=$nome?>" placeholder="Digite a Categoria" maxlength="100">
          </div>
        </div>
        <div class="enviar">
          <div class="enviar">
            <input type="submit" name="btnEnviar" value="Salvar">
          </div>
        </div>
      </form>
    </div>

    <div id="consultaDeDados">
      <table id="tblConsulta">
        <tr>
          <td id="tblTitulo" colspan="6">
            <h1> Registro de Categorias </h1>
          </td>
        </tr>
        <tr id="tblLinhas">
          <td class="tblColunas destaque"> Nome </td>
          <td class="tblColunas destaque"> Opções </td>
        </tr>

        <?php
        // Import do arquivo da controller para asolicitar a listagem dos dados 
        require_once('controller/controllerCategorias.php');
        // Chama a função que retorna os dados de Categorias 
        $listCategoria = listarCategoria();
        // Estrutura de repetição para retornar os dados do array e printar na tela 
        foreach ($listCategoria as $item) {
        ?>
          <tr id="tblLinhas">
            <td class="tblColunas registros"><?= $item['nome'] ?></td>
            <td class="tblColunas registros">
              <a href="router.php?component=categorias&action=buscar&id=<?= $item['id'] ?>">
                <img src="img/edit.png" alt="Editar" title="Editar" class="editar">
              </a>
              <a onclick="return confirm('Deseja excluir esse item?')" href="router.php?component=categorias&action=deletar&id=<?= $item['id'] ?>">
                <img src="./landing-page-php/img/excluir.png" alt="Excluir" title="Excluir" class="excluir">
              </a>
            </td>
          </tr>
        <?php 
        }
        ?>
      </table>
    </div>
  </section>
</body>

</html>