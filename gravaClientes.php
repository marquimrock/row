<?php

require 'banco/conexao.php';
require 'lib/funcs.php';

//função trim limpa os espaços excessivos...
$cnpj = formataCNPJ($_POST['cnpj']);
$nome = trim($_POST['nome']);
$qtd = trim($_POST['qtd']);

$erro = 0;
if(strlen($cnpj) < 14 || !is_numeric($cnpj)) $erro++;
if(strlen($nome) < 3) $erro++;
if(strlen($qtd) == 0 || !is_numeric($qtd)) $erro++;

if ($erro > 0) {
    header('Location: index.php?pagina=clientes&erro=1');
    exit;
}

$con = conecta();

$insert = "INSERT INTO tb_clientes"
        . "(cnpj, nome, qtd)"
        . "VALUES ('$cnpj','$nome','$qtd')";

$res = mysqli_query($con, $insert);

if ($res){
    header('Location: index.php?pagina=clientes&sucesso=1');
}