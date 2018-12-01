<?php

require 'banco/conexao.php';
require 'lib/funcs.php';

//função trim limpa os espaços excessivos...
//$id_cnpj = formataCNPJ($_POST['id_cnpj']);
//$id_tipo_licenca = trim($_POST['id_tipo_licenca']);
$serie = trim($_POST['serie']);
$senha = trim($_POST['senha']);
$vencimento = trim($_POST['dt_venc']);


//falta fazer a validacao dos campos
/*
$erro = 0;
if(strlen($cnpj) < 14 || !is_numeric($cnpj)) $erro++;
if(strlen($razao_social) < 3) $erro++;
if(strlen($qnt_pdv) == 0 || !is_numeric($qnt_pdv)) $erro++;

if ($erro > 0) {
    header('Location: index.php?pagina=clientes&erro=1');
    exit;
}
*/

$con = conecta();

$insert = "INSERT INTO tb_licenca"
        . "(id_cliente, id_tipo_licenca, serie, senha, data_vencimento, data_inclusao, status)"
        . "VALUES (1,1,'$serie', '$senha', '$vencimento','$vencimento', 'true')";

        var_dump($insert);

$res = mysqli_query($con, $insert);
if ($res){
    header('Location: index.php?pagina=licencas&sucesso=1');
}