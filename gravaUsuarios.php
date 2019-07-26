<?php

require 'model/usuarios_bo.php';
require 'banco/conexao.php';
require 'lib/funcs.php';

$id = $_POST['id'];
$nome = $_POST['nome'];
$usuario = $_POST['usuario'];
$senha = base64_encode($_POST['senha']);
$adm = $_POST['adm'];


//VALIDA OS CAMPOS DO CADASTRO DE USUARIO
$erro = 0;
if (strlen($nome) < 3)
    $erro++;
if (strlen($usuario) < 3)
    $erro++;

//MENSAGEM DE RETORNO DE ERRO
if ($erro > 0) {
    header('Location: index.php?pagina=usuarios&erro=1');
    exit;
}

//VERIFICA SE O USUARIO JA EXISTE
if (buscaUsuario($usuario) == 0 && $id == null) {
    gravaUsuario($nome, $usuario, $senha, $id);
    //USUARIO CADASTRADO COM SUCESSO
    header('Location: index.php?pagina=usuarios&sucesso=1');
}
if ( $id == $id) {
    alteraUsuario($nome, $usuario, $senha, $id, $adm);
    //USUARIO GRAVADO COM SUCESSO
    header('Location: index.php?pagina=usuarios&sucesso=1');
}
else {
    //SENAO, INFORMA QUE O USUARIO JA FOI CADASTRADO
    header('Location: index.php?pagina=usuarios&userErro=1');
}

?>
