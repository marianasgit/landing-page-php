<?php

require_once('modulo/config.php');

$form = (string) "router.php?component=produtos&action=inserir";
$foto = (string) null;

$idcategoria = (string) null;

if (session_status()) {
    if (!empty($_SESSION['dadosProduto'])) {
        $id                  = $_SESSION['dadosProduto']['id'];
        $nome                = $_SESSION['dadosProduto']['nome'];
        $descricao           = $_SESSION['dadosProduto']['descricao'];
        $preco               = $_SESSION['dadosProduto']['preco'];
        $destaque            = $_SESSION['dadosProduto']['destaque'];
        $percentual_promocao = $_SESSION['dadosProduto']['percentual_promocao'];
        $imagem              = $_SESSION['dadosProduto']['foto'];
        $idcategoria         = $_SESSION['dadosProduto']['idcategoria'];

        $form = "router.php?component=produtos&action=editar&id=" . $id . "&foto=" . $foto;

        unset($_SESSION['dadosProduto']);
    }
}

require_once('controller/controllerCategorias.php');

$listCategoria = listarCategoria();

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
                <li>produtos</li>
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
    <section class="sessao produtos">
        <h3 class="titulo-da-secao">Produtos</h3>
        <div class="cadastroUsuarios">
            <h3>Cadastro de Produtos</h3>
            <form action="<?= $form ?>" name="frmCadastro" method="post">
                <div class="campos">
                    <div class="cadastroInformacoesPessoais">
                        <label> Nome: </label>
                    </div>
                    <div class="cadastroEntradaDeDados">
                        <input type="text" name="txtNome" value="<?= isset($nome) ? $nome : null ?>" placeholder="Nome do Produto" maxlength="80">
                    </div>
                </div>
                <div class="campos">
                    <div class="cadastroInformacoesPessoais">
                        <label> Descrição: </label>
                    </div>
                    <div class="cadastroEntradaDeDados">
                        <input type="text" name="txtDescricao" value="<?= isset($descricao) ? $descricao : null ?>">
                    </div>
                </div>
                <div class="campos">
                    <div class="cadastroInformacoesPessoais">
                        <label> Preço: </label>
                    </div>
                    <div class="cadastroEntradaDeDados">
                        <input type="number" name="txtPreco" value="<?= isset($preco) ? $preco : null ?>" min="1" step="0.01">
                    </div>
                </div>
                <div class="campos">
                    <div class="cadastroInformacoesPessoais">
                        <label> Categoria: </label>
                    </div>
                    <div class="cadastroEntradaDeDados">
                        <select name="sltCategoria">
                            <option value="">Selecione uma categoria:</option>
                            <?php
                            foreach ($listCategoria as $item) :

                            ?>
                                <option <?= $idcategoria == $item['id'] ? 'selected' : null ?> value="<?= $item['id'] ?>">

                                    <?= $item['nome'] ?>

                                </option>
                            <?php
                            endforeach;
                            ?>
                        </select>
                    </div>
                </div>
                <div class="campos">
                    <div class="cadastroInformacoesPessoais">
                        <label> Adicione uma foto: </label>
                    </div>
                    <div class="cadastroEntradaDeDados">
                        <input type="file" name="fileFoto" accept=".jpg, .png, .jpeg, .gif"> <!-- O accept faz voce escolher qual arquivo pode fazer upload -->
                    </div>
                </div>
                <div class="campos">
                    <div class="cadastroInformacoesPessoais">
                        <label> Destaque? </label>
                    </div>
                    <div class="cadastroEntradaDeDados">
                        <input type="radio" name="rdoDestaque" value="1" checked /> Sim
                        <input type="radio" name="rdoDestaque" value="0" /> Não
                    </div>
                </div>
                <div class="campos">
                    <div class="cadastroInformacoesPessoais">
                        <label> Percentual de desconto </label>
                    </div>
                    <div class="cadastroEntradaDeDados">
                        <input type="number" name="txtDesconto" value="<?= isset($preco) ? $preco : null ?>" min="0" step="0.1">
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
                        <h1> Consulta de Dados</h1>
                    </td>
                </tr>
                <tr id="tblLinhas">
                    <td class="tblColunas destaque"> Nome </td>
                    <td class="tblColunas destaque"> Descricao </td>
                    <td class="tblColunas destaque"> Preço </td>
                    <td class="tblColunas destaque"> Destaque </td>
                    <td class="tblColunas destaque"> Promoção (%) </td>
                    <td class="tblColunas destaque"> Imagem </td>
                    <td class="tblColunas destaque"> Opções </td>
                </tr>

                <?php
                // Import do arquivo da controller para asolicitar a listagem dos dados
                require_once('controller/controllerProdutos.php');
                // Chama a função que retorna os dados de produtos
                if ($listProduto = listarProduto()) {

                    // Estrutura de repetição para retornar os dados do array e printar na tela
                    foreach ($listProduto as $item) {
                        $foto = $item['foto']; // Variavel para carregar a foto que veio do BD
                ?>
                        <tr id="tblLinhas">
                            <td class="tblColunas registros"><?= $item['nome'] ?></td>
                            <td class="tblColunas registros"><?= $item['descricao'] ?></td>
                            <td class="tblColunas registros"><?= $item['preco'] ?></td>
                            <td class="tblColunas registros"><?= $item['destaque'] ?></td>
                            <td class="tblColunas registros"><?= $item['percentual_promocao'] ?></td>
                            <td class="tblColunas registros">
                                <img src="arquivos/<?= $foto ?>" class="foto">
                            </td>
                            <td class="tblColunas registros">
                                <a href="router.php?component=produtos&action=buscar&id=<?= $item['id'] ?>">
                                    <img src="img/edit.png" alt="Editar" title="Editar" class="editar">
                                </a>
                                <a onclick="return confirm('Deseja excluir esse item?')" href="router.php?component=produtos&action=deletar&id=<?= $item['id'] ?>&foto=<?= $foto ?>">
                                    <img src="img/trash.png" alt="Excluir" title="Excluir" class="excluir">
                                </a>
                                <img src="img/search.png" alt="Visualizar" title="Visualizar" class="pesquisar">
                            </td>
                        </tr>
                <?php
                    }
                }
                ?>

            </table>
        </div>
    </section>
</body>

</html>