<?php 

session_start();

require 'model/clientes_bo.php';
require 'model/chamados_bo.php';
require 'model/usuarios_bo.php';
require 'banco/conexao.php';
require 'lib/funcs.php';

// -------------------------------------------------------------------
// INICIALIZAÇÃO DOS CAMPOS
// -------------------------------------------------------------------

$id_cliente = $_POST['cb_cliente'];
$solicitante = $_POST['solicitante'];
$ocorrencia = $_POST['ocorrencia'];
$status = $_SESSION['status'];


// -------------------------------------------------------------------
// VALIDAÇÕES
// -------------------------------------------------------------------
$erro = 0;
if (strlen($solicitante) < 3)
    $erro++;
if (strlen($ocorrencia) < 3)
    $erro++;

// -------------------------------------------------------------------
// RETORNO DOS ERROS DE VALIDAÇÕES
// -------------------------------------------------------------------
if ($erro > 0) {
    header('Location: index.php?pagina=chamados&erro=1'
    	. '&solicitante=' . $solicitante);
    exit;
     header('Location: index.php?pagina=chamados&erro=1'
    	. '&ocorrencia=' . $ocorrencia);
    exit;
}


// -------------------------------------------------------------------
// GRAVAÇÃO DOS DADOS E MENSAGEM DE RETORNO
// -------------------------------------------------------------------

    $result = buscaTodosUsuario(); 
        while ($usuario = mysqli_fetch_assoc($result)) {
            if($usuario['nome'] === $_SESSION['usuario']){
                $id_usuario = $usuario['id'];
                }
            }

$total = mysqli_num_rows($result);
if ($total === 0) {
     header('Location: index.php?pagina=chamados&chamado=encontrado&erro=1&solicitante=' . $solicitante);
    
} else {	
	$res = gravaChamado($id_usuario,$id_cliente, $solicitante, $ocorrencia, $id_usuario, $status, null);
	
      if($res === true){	 	
	 	header('Location: index.php?pagina=chamados&sucesso=1'); 	
	 } else {
        header('Location: index.php?pagina=chamados&chamado=encontrado&erro=1');
     }
	
}

