<?php

require 'model/licencas_bo.php';
require 'model/clientes_bo.php';
require 'banco/conexao.php';
require 'lib/funcs.php';

// -------------------------------------------------------------------
// INICIALIZAÇÃO DOS CAMPOS
// -------------------------------------------------------------------
$erro = 0;
$cnpj = tiraEspecias(trim($_POST['cnpj']));
$tipo_sistema = $_POST['tipo_sistema'];
$codigo_licenca = $_POST['codigo_licenca'];
$serie = trim($_POST['serie']);
$senha = trim($_POST['senha']);
$inclusao = date('Y-m-d', strtotime('now'));

// -------------------------------------------------------------------
// VALIDAÇÕES
// -------------------------------------------------------------------
//verifica se a data é valida e maior que a data atual, considerando ano bissexto
if (verificaData($_POST['dt_venc'])) {    
    $data = str_replace("/", "-", $_POST['dt_venc']);   
    
    $data_venc = new DateTime(date('Y-m-d', strtotime($data)));
    $data_atual = new DateTime('now');
    
    $dif_data = $data_venc->diff($data_atual);
    
    //INVERT (RECURSO DO PHP) - retorna 1, se a data de vencimento for maior que a data atual 
    if ($dif_data->invert == 1) {
        $vencimento = $data_venc->format('Y-m-d');
    } else {
        $erro++;
        $erroData = 2;
        $vencimento = trim($_POST['dt_venc']);
    }
} else {
    $erro++;
    $erroData = 1;
    $vencimento = trim($_POST['dt_venc']);
}
if (strlen($cnpj) < 14 || !is_numeric($cnpj))
    $erro++;
if (strlen(empty($serie)) || $serie == 0)
    $erro++;
if (strlen(empty($senha)))
    $erro++;
if ($tipo_sistema == 0)
    $erro++;
if ($codigo_licenca == 0)
    $erro++;

// -------------------------------------------------------------------
// RETORNO DOS ERROS DE VALIDAÇÕES
// -------------------------------------------------------------------
if ($erro > 0) {
    header('Location: index.php?pagina=licencas&erro=1' 
            . '&cnpj=' . $cnpj
            . '&tipo_sistema=' . $tipo_sistema 
            . '&codigo_licenca=' . $codigo_licenca 
            . '&serie=' . $serie 
            . '&senha=' . $senha 
            . '&dt_venc=' . $vencimento 
            . '&erroData=' . $erroData);
    exit;
}

// -------------------------------------------------------------------
// TRATA A SERIE ANTES DE GRAVAR NO BANCO
// -------------------------------------------------------------------
if ($serie < 10) {
    $serie = "PDV00" . $serie;
} else {
    $serie = "PDV0" . $serie;
}

//CONEXAO E VALIDAÇÕES 
$result = buscaClientesPorCNPJ($cnpj);
foreach ($result as $r) {
    $id_cnpj = $r['id'];
}
$total = mysqli_num_rows($result);
if ($total === 0) {
    header("Location: index.php?pagina=clientes&cnpj= " . $cnpj);
    exit;
}

// -------------------------------------------------------------------
// GRAVAÇÃO DOS DADOS E MENSAGEM DE RETORNO
// -------------------------------------------------------------------
if (empty($id_cnpj)) {
    header('Location: index.php?pagina=licencas&erro=1');
} else {
    if (buscarSenha($senha) == 0) {
        //se a licença nao existir, grava no banco
        gravaLicenca($id_cnpj, $codigo_licenca, $tipo_sistema, $serie, $senha, $vencimento, $inclusao);
        header('Location: index.php?pagina=licencas&sucesso=1');
    } else {
        //a senha ja foi utilizada
        header("Location: index.php?pagina=licencas&erroSenha=1");
    }
}
