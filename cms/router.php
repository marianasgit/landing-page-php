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
        case 'CONTATOS':

            // Import da controller contato
            require_once('controller/controllerContatos.php');

            if ($action == 'INSERIR') {
                // Chama a funcao de inserir na controller
                $resposta = inserirContato($_POST);

                // Valida o tipo de dado que a controller retorna
                if (is_bool($resposta)) {
                    //Verificar se o retorno foi verdadeiro
                    if ($resposta)
                        echo ("<script>alert('Registro inserido com sucesso!');
                                    window.location.href = 'index.php';
                                </script>"); // Essa funcao retorna a pagina inicial apos a execução
                } elseif (is_array($resposta))
                    echo ("<script>
                                alert('" . $resposta['message'] . "');
                                window.history.back();
                            </script>");
            } elseif ($action == 'DELETAR') {
                // Recebendo o registro
                $idcontato = $_GET['id'];

                // Chamando a função de excluir na controller
                $resposta = excluirContato($idcontato);

                if (is_bool($resposta)) {
                    if ($resposta) {
                        echo ("<script>alert('Registro excluído com sucesso!');window.location.href = 'listaDeContatos.php';</script>");
                    } elseif (is_array($resposta)) {
                        echo ("<script>alert('" . $resposta['message'] . "');window.history.back();</script>");
                    }
                }
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

                } elseif (is_array($resposta))
                {
                    echo("<script>
                            alert('".$resposta['message']."');
                            window.history.back();
                            </script>");
                }

            } elseif ($action == 'DELETAR')
            {
                 // Recebe o id do registro que deverá ser excluído
                 $idcategoria = $_GET['id'];

                 // Chama a função de excluir na controller
                 $resposta = excluirCategoria($idcategoria);

                 if (is_bool($resposta)) 
                 {
                     if ($resposta)
                     {
                         echo ("<script>
                                 alert('Registro excluído com sucesso!');
                                 window.location.href = 'listaDeCategorias.php';
                                 </script>");
                     }
                 } elseif (is_array($resposta))
                 {
                     echo ("<script>
                             alert('".$resposta['message']."');
                             window.history.back();
                             </script>");
                 }

            } else if ($action == 'BUSCAR')
            {
                // Recebe o id do registro que deverá ser editado
                $idcategoria = $_GET['id'];

                // Chama a funçõa de editar na controller
                $dados = buscarCategoria($idcategoria);

                // Ativa a utilização de variáveis de sessão no servidor
                session_start();

                // Guarda em uma variável de sessão os dados que o BD retornou para a busca
                $_SESSION['dadosCategoria'] = $dados;

                require_once('listaDeCategorias.php');
            }
        break;
    }
}