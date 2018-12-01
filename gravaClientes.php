<?php

require 'banco/conexao.php';
require 'lib/funcs.php';

//função trim limpa os espaços excessivos...
$cnpj = formataCNPJ($_POST['cnpj']);
$razao_social = trim($_POST['razao_social']);
$nome_fantasia = trim($_POST['nome_fantasia']);
$telefone = trim($_POST['telefone']);
$email = trim($_POST['email']);
$qnt_pdv = trim($_POST['qnt_pdv']);


//falta validar os campos nome fantasia, telefone e email
$erro = 0;
if(strlen($cnpj) < 14 || !is_numeric($cnpj)) $erro++;
if(strlen($razao_social) < 3) $erro++;
if(strlen($qnt_pdv) == 0 || !is_numeric($qnt_pdv)) $erro++;

if ($erro > 0) {
    header('Location: index.php?pagina=clientes&erro=1');
    exit;
}

$con = conecta();

$insert = "INSERT INTO tb_cliente"
        . "(cnpj, razao_social, nome_fantasia, telefone, email, qnt_pdv)"
        . "VALUES ('$cnpj','$razao_social','$nome_fantasia', '$telefone', '$email', '$qnt_pdv')";

$res = mysqli_query($con, $insert);

if ($res){
    header('Location: index.php?pagina=clientes&sucesso=1');
}