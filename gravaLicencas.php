<?php

require 'banco/conexao.php';
require 'lib/funcs.php';

//função trim limpa os espaços excessivos...
//$id_cnpj = formataCNPJ($_POST['id_cnpj']);
//$id_tipo_licenca = trim($_POST['id_tipo_licenca']);
$serie = trim($_POST['serie']);
$senha = trim($_POST['senha']);
$vencimento = trim($_POST['dt_venc']);

/*PENDENCIAS....
 * Validação de todos os campos
 * Direcionar corretamente no INSERT, os seguintes campos: id_cliente, id_tipo_licenca e data_inclusao.
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