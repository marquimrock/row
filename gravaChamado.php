<?php 

require 'model/licencas_bo.php';
require 'model/clientes_bo.php';
require 'model/chamados_bo.php';
require 'banco/conexao.php';
require 'lib/funcs.php';

$id_cliente = $_POST['cb_cliente'];
$solicitante = $_POST['solicitante'];
$ocorrencia = $_POST['ocorrencia'];

 $res = buscaClientesPorId($id_cliente);                           
    while ($cliente = mysqli_fetch_assoc($res)){
    }

    $res = buscaTodosChamados();
    while ($chamado = mysqli_fetch_assoc($res)){
    }

    $res = gravaChamado($solicitante, $ocorrencia);
    echo $res;
