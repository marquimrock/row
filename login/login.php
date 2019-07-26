<?php
session_start();
include('../banco/conexao.php');
$conexao = mysqli_connect(HOST, USER, PASS, BANCO) or die ('Não foi possível conectar ao banco');
if(empty($_POST['usuario']) || empty($_POST['senha'])) {
	header('Location: index.php');
	exit();
}
$id = mysqli_real_escape_string($conexao, $_POST['id']);
$usuario = mysqli_real_escape_string($conexao, $_POST['usuario']);
$senha = mysqli_real_escape_string($conexao, $_POST['senha']);
$senha = base64_encode($senha);

$query = "select id, usuario from tb_usuario where usuario = '{$usuario}' and senha = '{$senha}'";
$query2 = "select adm from tb_usuario where usuario = '{$usuario}' and senha = '{$senha}'";

$result = mysqli_query($conexao, $query);
$result2 = mysqli_query($conexao, $query2);

while ($linha = mysqli_fetch_assoc($result2)){
	$acesso = $linha['adm'];
}

$row = mysqli_num_rows($result);

if($row == 1) {
	$_SESSION['id'] = $id;
	$_SESSION['usuario'] = $usuario;
	$_SESSION['acesso'] = $acesso;
	header('Location: ../index.php');
	exit(); 	
} else {
	$_SESSION['nao_autenticado'] = true;
	header('Location: index.php');
	exit();
}