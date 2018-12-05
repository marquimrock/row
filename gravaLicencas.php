<?php

require 'banco/conexao.php';
require 'lib/funcs.php';

//função trim limpa os espaços excessivos...
$cnpj = formataCNPJ(trim($_POST['cnpj']));
$serie = trim($_POST['serie']);
$tipo_licenca = $_POST['cmbItens'];
$senha = trim($_POST['senha']);
$vencimento = trim($_POST['dt_venc']);
$id_tipo_licenca = substr($_POST['cmbItens'], 0, 1);
echo $rest;

/*
 * Validação dos campos
 * Falta validar campo data vencimento
 */
$erro = 0;
if (strlen($cnpj) < 14 || !is_numeric($cnpj))
    $erro++;
if (strlen(empty($serie)))
    $erro++;
if (strlen($tipo_licenca) == 'Selecione...')
    $erro++;
if (strlen(empty($senha)))
    $erro++;

if ($erro > 0) {
    header('Location: index.php?pagina=licencas&erro=1');
    exit;
}

$con = conecta();
$query = "SELECT * FROM tb_cliente WHERE cnpj = '$cnpj' ";

$result = mysqli_query($con, $query);
foreach ($result as $r) {
    $id_cnpj = $r['id'];
}
if (empty($id_cnpj)) {
    header('Location: index.php?pagina=licencas&erro=1');
} else {
    $insert = "INSERT INTO tb_licenca"
            . "(id_cliente, id_tipo_licenca, serie, senha, data_vencimento, data_inclusao, status)"
            . "VALUES ($id_cnpj,$id_tipo_licenca,'$serie', '$senha', '$vencimento','$vencimento', 'false')";

    $res = mysqli_query($con, $insert);
}

if ($res) {
    header('Location: index.php?pagina=licencas&sucesso=1');
}
