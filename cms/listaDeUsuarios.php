<?php

// Variável para diferenciar a action entre inserir e editar
$form = (string) "router.php?component=usuarios&action=inserir";

// Valida se a utilização de variáveis de sessão está ativa no servidor
if (session_status())
{
    // Valida se a variável de sessão dadosUsuario não está vazia
    if(!empty($_SESSION['dadosUsuario']))
    {
        $id     = $_SESSION['dadosUsuario']['id'];
        $nome   = $_SESSION['dadosUsuario']['nome'];
        $login  = $_SESSION['dadosUsuario']['login'];
        $senha  = $_SESSION['dadosUsuario']['senha'];

        // Mudando a ação do form para editar o registro ao clicar em salvar
        $form = "router.php?component=usuarios&action=editar&id=".$id;

        // Destrói a variável de memória do servidor
        unset($_SESSION['dadosUsuario']);
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/listaDeUsuarios.css">
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
  <section class="sessao usuarios">
    <h3 class="titulo-da-secao">Usuarios</h3>
    <div class="cadastroUsuarios">
      <h3>Cadastro de Usuários</h3>
      <form action="<?=$form?>" name="frmCadastro" method="post">
        <div class="campos">
          <div class="cadastroInformacoesPessoais">
            <label> Nome: </label>
          </div>
          <div class="cadastroEntradaDeDados">
            <input type="text" name="txtNome" value="<?= isset($nome)? $nome:null?>" placeholder="Nome do Usuário" maxlength="100">
          </div>
        </div>
        <div class="campos">
            <div class="cadastroInformacoesPessoais">
                <label> login: </label>
            </div>
            <div class="cadastroEntradaDeDados">
                <input type="email" name="txtLogin" value="<?= isset($login)? $login:null?>">
            </div>
        </div>
        <div class="campos">
            <div class="cadastroInformacoesPessoais">
                <label> Senha: </label>
            </div>
            <div class="cadastroEntradaDeDados">
                <input type="password" name="txtSenha" value="<?= isset($senha)? $senha:null?>">
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
            <h1> Registro de Usuários </h1>
          </td>
        </tr>
        <tr id="tblLinhas">
          <td class="tblColunas destaque"> Nome </td>
          <td class="tblColunas destaque"> Login </td>
          <td class="tblColunas destaque"> Opções </td>
        </tr>

        <?php
        // Import do arquivo da controller para asolicitar a listagem dos dados 
        require_once('controller/controllerUsuarios.php');
        // Chama a função que retorna os dados de Usuarios
        $listUsuario = listarUsuario();
        // Estrutura de repetição para retornar os dados do array e printar na tela 
        foreach ($listUsuario as $item) {
        ?>
          <tr id="tblLinhas">
            <td class="tblColunas registros"><?= $item['nome'] ?></td>
            <td class="tblColunas registros"><?= $item['login'] ?></td>
            <td class="tblColunas registros">
              <a href="router.php?component=usuarios&action=buscar&id=<?= $item['id'] ?>">
                <img src="img/edit.png" alt="Editar" title="Editar" class="editar">
              </a>
              <a onclick="return confirm('Deseja excluir esse item?')" href="router.php?component=usuarios&action=deletar&id=<?= $item['id'] ?>">
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