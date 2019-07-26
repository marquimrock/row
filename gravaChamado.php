<?php 

require 'login/verifica_login.php';
require 'model/licencas_bo.php';
require 'model/clientes_bo.php';
require 'model/chamados_bo.php';
require 'model/usuarios_bo.php';
require 'banco/conexao.php';
require 'lib/funcs.php';

$usuario = $_SESSION['usuario'];

$id_cliente = $_POST['cb_cliente'];
$solicitante = $_POST['solicitante'];
$ocorrencia = $_POST['ocorrencia'];

 $res = buscaClientesPorId($id_cliente);                           
    while ($cliente = mysqli_fetch_assoc($res)){
    }

    $res = buscaTodosChamados();
    while ($chamado = mysqli_fetch_assoc($res)){
    }

    $result = buscaTodosUsuario(); 
        while ($usuario = mysqli_fetch_assoc($result)) {
            if($usuario['nome'] === $_SESSION['usuario']){
                $id_usuario = $usuario['id'];
                }
            }

                
    $res = gravaChamado($solicitante, $ocorrencia, $id_usuario);
    echo $res;
