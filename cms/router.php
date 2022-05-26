<?php

/*****************************************************************************
 * Objetivo: Arquivo de rota para seguimentar as ações encaminhadas pela View
 *           (dados de um form, listagem de dados, ação de excluir ou atualizar)
 *            Esse arquivo será responsável por encaminhar as solicitações para 
 *            a controller  
 * 
 * Autor: Mariana
 * Data: 05/04/2022
 * Versão: 1.0
 *******************************************/

$action = (string) null;
$component = (string) null;

if ($_SERVER['REQUEST_METHOD'] == 'POST' || $_SERVER['REQUEST_METHOD'] == 'GET') {
    // Recebendo os dados via URL
    $component = strtoupper($_GET['component']);
    $action = strtoupper($_GET['action']);

    // Validar quem está solicitando para o router
    switch ($component) {

        case 'USUARIOS':

            // Import da controller de usuarios
            require_once('controller/controllerUsuarios.php');

            if ($action == 'INSERIR') {
                // Chama a função de inserir na controller
                $resposta = inserirUsuario($_POST);

                // Valida o tipo de dado que a controller retorna
                if (is_bool($resposta)) {
                    if ($resposta) {
                        echo ("<script>alert('Registro inserido com sucesso!');
                                    window.location.href = 'listaDeUsuarios.php';
                                </script>"); // Essa funcao retorna a pagina inicial apos a execução
                    }
                } elseif (is_array($resposta)) {
                    echo ("<script>
                                alert('" . $resposta['message'] . "');
                                window.history.back();
                            </script>");
                }
            } elseif ($action == 'DELETAR') {
                // Recebe o id do registro que deverá ser excluído
                $idusuario = $_GET['id'];

                // Chama a função de excluir na controller
                $resposta = excluirUsuario($idusuario);

                if (is_bool($resposta)) {
                    if ($resposta) {
                        echo ("<script>
                                alert('Registro excluído com sucesso!');
                                window.location.href = 'listaDeUsuarios.php';
                            </script>");
                    }
                } elseif (is_array($resposta)) {
                    echo ("<script>
                            alert('" . $resposta['message'] . "');
                            window.history.back();
                        </script>");
                }
            } elseif ($action == 'BUSCAR') {
                $idusuario = $_GET['id'];

                $dados = buscarUsuario($idusuario);

                session_start();

                $_SESSION['dadosUsuario'] = $dados;

                require_once('listaDeUsuarios.php');
            } elseif ($action == 'EDITAR') {
                $idusuario = $_GET['id'];

                $resposta = atualizarUsuario($_POST, $idusuario);

                if (is_bool($resposta)) {
                    if ($resposta)
                        echo ("<script>alert('Registro atualizado com sucesso!');
                            window.location.href = 'listaDeUsuarios.php';
                            </script>");
                } elseif (is_array($resposta))
                    echo ("<script>alert('" . $resposta['message'] . "');
                            window.history.back();
                            </script>");
            }

            break;

        case 'CATEGORIAS':

            // Import da controller categoria
            require_once('controller/controllerCategorias.php');

            // Validação para identificar o tipo de ação que será realizada
            if ($action == 'INSERIR') {
                // Chama a função de inserir na controller
                $resposta = inserirCategoria($_POST);

                // Valida o tipo de dado que a controller retorna
                if (is_bool($resposta)) {
                    // Verificar se o retorno foi verdadeiro
                    if ($resposta)
                        echo ("<script>
                                alert('Registro inserido com sucesso!');
                                window.location.href = 'listaDeCategorias.php';
                                </script>");
                } elseif (is_array($resposta)) {
                    echo ("<script>
                            alert('" . $resposta['message'] . "');
                            window.history.back();
                            </script>");
                }
            } elseif ($action == 'DELETAR') {
                // Recebe o id do registro que deverá ser excluído
                $idcategoria = $_GET['id'];

                // Chama a função de excluir na controller
                $resposta = excluirCategoria($idcategoria);

                if (is_bool($resposta)) {
                    if ($resposta) {
                        echo ("<script>
                                 alert('Registro excluído com sucesso!');
                                 window.location.href = 'listaDeCategorias.php';
                                 </script>");
                    }
                } elseif (is_array($resposta)) {
                    echo ("<script>
                             alert('" . $resposta['message'] . "');
                             window.history.back();
                             </script>");
                }
            } elseif ($action == 'BUSCAR') {
                // Recebe o id do registro que deverá ser editado
                $idcategoria = $_GET['id'];

                // Chama a funçõa de editar na controller
                $dados = buscarCategoria($idcategoria);

                // Ativa a utilização de variáveis de sessão no servidor
                session_start();

                // Guarda em uma variável de sessão os dados que o BD retornou para a busca
                $_SESSION['dadosCategoria'] = $dados;

                require_once('listaDeCategorias.php');
            } elseif ($action == 'EDITAR') {
                // Recebe o id que foi encaminhado no action do form
                $idcategoria = $_GET['id'];

                // Chama a função de editar na controller
                $resposta = atualizarCategoria($_POST, $idcategoria);

                // Valida o tipo de dado que a controller retorna
                if (is_bool($resposta)) {
                    // Verificar se o retorno foi verdadeiro
                    if ($resposta)
                        echo ("<script>alert('Registro atualizado com sucesso!');
                                window.location.href = 'listaDeCategorias.php';
                            </script>");
                } elseif (is_array($resposta))
                    echo ("<script>alert('" . $resposta['message'] . "');
                                window.history.back();
                            </script>");
            }

            break;

        case 'PRODUTOS':

            require_once('controller/controllerProdutos.php');

            if ($action == 'INSERIR') {

                if (isset($_FILES) && !empty($_FILES)) {
                    //chama a funcao de inserir na controller
                    $resposta = inserirProduto($_POST, $_FILES);
                } else {
                    $resposta = inserirProduto($_POST, null);
                }

                if (is_bool($resposta)) //se for booleano
                {
                    //verificar se o retorno foi verdadeiro
                    if ($resposta)
                        echo ("<script> 
                                alert('Registro inserido com sucesso!');
                                window.location.href = 'listaDeProdutos.php'; 
                            </script>"); // essa funcao retorna a página inicial apos a execucao
                } elseif (is_array($resposta))
                    echo ("<script> 
                            alert('" . $resposta['message'] . "');
                            window.history.back(); 
                        </script>");
            } elseif ($action == 'DELETAR') {
                //Recebe o id do registro que devera ser excluido, e foi enviado pela url no link da imagem do excluir que foi acionado na index
                $idproduto = $_GET['id'];

                $foto = $_GET['foto'];

                $arrayDados = array(
                    "id"   => $idproduto,
                    "foto" => $foto  // Criamos um array para encaminhar os dados do BD para a controller 
                );

                //chama a funcao de excluir na controller
                $resposta = excluirProduto($arrayDados);

                if (is_bool($resposta)) {
                    if ($resposta) {
                        echo ("<script> 
                                alert('Registro excluído com sucesso!');
                                window.location.href = 'listaDeProdutos.php'; 
                             </script>");
                    }
                } elseif (is_array($resposta)) {
                    echo ("<script> 
                             alert('" . $resposta['message'] . "');
                            window.history.back(); 

                           </script>");
                }
            } elseif ($action == 'BUSCAR') {
                // Recebe o id do registro que devera ser editado, e foi enviado pela url no link da imagem do editar que foi acionado na index
                $idproduto = $_GET['id'];

                // Chama a funcao de buscar na controller
                $dados = buscarProduto($idproduto);

                // Ativa a ultilização de variaveis de sessao no servidor
                session_start();

                // Guarda em uma variavel de sessao os dados que o BD retornou para a busca do ID. 
                // Obs: essa variavel de sessao sera utilizada na index.php, para colocar os dados nas caixas de texto 
                $_SESSION['dadosProduto'] = $dados;

                // Utilizando o header tambem poderemos chamar a index.php, 
                // porem haverá uma ação de carregamento no navegador, piscando a tela novamente 
                //header('location: index.php');

                // Utilizando o require, iremos apenas importar a tela da index, assim não havendo um novo carregamento da página
                require_once('listaDeProdutos.php');
            } elseif ($action == 'EDITAR') {
                //Recebe o id que foi encaminhado no action do form
                $idproduto = $_GET['id'];

                //Recebe o nome da foto que foi enviada pelo get do form
                $foto = $_GET['foto'];

                // Cria array contendo id e nome da foto para enviar para a controller
                $arrayDados = array(
                    "id"   => $idproduto,
                    "foto" => $foto,
                    "file" => $_FILES
                );

                //chama a funcao de editar na controller
                $resposta = atualizarProduto($_POST, $arrayDados);

                //valida o tipo de dado que a controller retorna
                if (is_bool($resposta)) //se for booleano
                {
                    //verificar se o retorno foi verdadeiro
                    if ($resposta)
                        echo ("<script> 
                                 alert('Registro atualizado com sucesso!');
                                 window.location.href = 'listaDeProdutos.php'; 
                             </script>"); // essa funcao retorna a página inicial apos a execuca
                } elseif (is_array($resposta))

                    echo ("<script> 
                         alert('" . $resposta['message'] . "');
                         window.history.back(); 
                    </script>");
            } elseif ($action == "LISTAR") {

                $dados = listarProduto();
                print_r($dados);
            }


            break;
    }
}
