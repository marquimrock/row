<?php

require 'model/clientes_bo.php';
require 'banco/conexao.php';
require 'lib/funcs.php';

// -------------------------------------------------------------------
// INICIALIZAÇÃO DOS CAMPOS
// -------------------------------------------------------------------
$cnpj = tiraEspecias($_POST['cnpj']);
$razao_social = trim($_POST['razao_social']);
$inscricao_estadual = tiraEspecias($_POST['inscricao_estadual']);
$nome_fantasia = trim($_POST['nome_fantasia']);
$cep = tiraEspecias($_POST['cep']);
$logradouro = trim($_POST['logradouro']);
$numero = trim($_POST['numero']);
$uf = $_POST['uf'];
$cidade = $_POST['cidade'];
$bairro = trim($_POST['bairro']);
$telefone = tiraEspecias(trim($_POST['telefone']));
$celular1 = tiraEspecias(trim($_POST['celular1']));
$celular2 = tiraEspecias(trim($_POST['celular2']));
$email = trim($_POST['email']);
$qnt_pdv = trim($_POST['qnt_pdv']);


// -------------------------------------------------------------------
// VALIDAÇÕES
// -------------------------------------------------------------------
$erro = 0;
if (strlen($cnpj) < 14 || !is_numeric($cnpj))
    $erro++;
if (strlen($razao_social) < 3)
    $erro++;
if (strlen($inscricao_estadual) < 9 || !is_numeric($inscricao_estadual))
    $erro++;
if (strlen($cep) < 8 || !is_numeric($cep))
    $erro++;
if (strlen($logradouro) < 3)
    $erro++;
if (strlen($bairro) < 3)
    $erro++;
if ($cidade == 0)
    $erro++;
if ($uf == 0)
    $erro++;
if (strlen($qnt_pdv) == 0 || !is_numeric($qnt_pdv) || $qnt_pdv == 0)
    $erro++;

// -------------------------------------------------------------------
// RETORNO DOS ERROS DE VALIDAÇÕES
// -------------------------------------------------------------------
if ($erro > 0) {
    header('Location: index.php?pagina=clientes&erro=1'
            . '&cnpj=' . $cnpj
            . '&razao_social=' . $razao_social
            . '&inscricao_estadual=' . $inscricao_estadual
            . '&nome_fantasia=' . $nome_fantasia
            . '&cep=' . $cep
            . '&logradouro=' . $logradouro
            . '&numero=' . $numero
            . '&bairro=' . $bairro
            . '&cidade=' . $cidade
            . '&uf=' . $uf
            . '&telefone=' . $telefone
            . '&celular1=' . $celular1
            . '&celular2=' . $celular2
            . '&email=' . $email
            . '&qnt_pdv=' . $qnt_pdv);
    exit;
}

// -------------------------------------------------------------------
// GRAVAÇÃO DOS DADOS E MENSAGEM DE RETORNO
// -------------------------------------------------------------------
$result = buscaClientesPorCNPJ($cnpj);
$total = mysqli_num_rows($result);
if ($total === 0) {
    $res = gravaCliente($cnpj, $razao_social, $inscricao_estadual, $nome_fantasia, $cep, 
        $logradouro, $numero, $bairro, $cidade, $uf, $telefone, $celular1, $celular2, $qnt_pdv, $email);
    header('Location: index.php?pagina=clientes&sucesso=1');
} else {
    header('Location: index.php?pagina=clientes&cliente=encontrado&erro=1&cnpj=' . $cnpj);
}
/*
  * 
  * $res = updateCliente($cnpj, $razao_social, $nome_fantasia, $telefone, $email, $qnt_pdv);
      header('Location: index.php?pagina=relatorio');
 * 
 */
