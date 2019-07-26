<?php

function buscaTodosClientes() {
    $con = conecta();
    $query = "SELECT * FROM tb_cliente";
    return mysqli_query($con, $query);
}

function limiteCliPorPagina($inicio_pag, $clientes_por_pagina) {
    $con = conecta();
    $query = "SELECT * FROM tb_cliente LIMIT $inicio_pag, $clientes_por_pagina";
    return mysqli_query($con, $query);
}

function buscaClientesPorCNPJ($cnpj) {
    $con = conecta();
    $query = "SELECT * FROM tb_cliente WHERE cnpj = '$cnpj' ";
    return mysqli_query($con, $query);
}

function buscaClientesPorId($id) {
    $con = conecta();
    $query = "SELECT * FROM tb_cliente WHERE id = '$id' ";
    return mysqli_query($con, $query);
}

//busca os codigos de licença para preencher a combobox
function buscaUf() {
    $con = conecta();
    return mysqli_query($con, 'SELECT * FROM tb_estado');
}

//busca os codigos de licença para preencher a combobox
function buscaCidade() {
    $con = conecta();
    return mysqli_query($con, 'SELECT * FROM tb_cidade');
}

function gravaCliente($cnpj, $razao_social, $inscricao_estadual, $nome_fantasia, $cep, $logradouro, $numero, $bairro, $cidade, $uf, $telefone, $celular1, $celular2, $qnt_pdv, $email) {
    //status padrão para novo cliente    
    $status = 1;
    $con = conecta();
    $insert = "INSERT INTO tb_cliente"
            . "(id_cidade, id_uf, cnpj, inscricao_estadual, razao_social, nome_fantasia, cep, logradouro, numero, bairro, telefone, celular1, celular2, email, qnt_pdv, status)"
            . "VALUES ('$cidade', '$uf', '$cnpj', '$inscricao_estadual', '$razao_social', '$nome_fantasia', '$cep', '$logradouro', '$numero', '$bairro', '$telefone', '$celular1', '$celular2', '$email', '$qnt_pdv', '$status')";

    return mysqli_query($con, $insert);
}

function updateCliente($cnpj, $razao_social, $nome_fantasia, $telefone, $email, $qnt_pdv) {
    $con = conecta();
    $update = "UPDATE tb_cliente SET cnpj = '$cnpj', razao_social = '$razao_social', nome_fantasia = '$nome_fantasia', "
            . " telefone = '$telefone', email = '$email', qnt_pdv = '$qnt_pdv' WHERE cnpj = $cnpj";
    return mysqli_query($con, $update);
}

function alterarStatusCliente($status, $id_cliente) {
    $con = conecta();
    $res = "UPDATE tb_cliente SET status = $status WHERE id = $id_cliente";
    return mysqli_query($con, $res);
}

function consultaStatus($id_cliente) {
    $con = conecta();
    $consulta = "SELECT status FROM tb_cliente WHERE id = $id_cliente";
    $res = mysqli_query($con, $consulta);
    $result = mysqli_fetch_assoc($res);

    //verifica se encontrou alguma licença
    $rows = mysqli_num_rows($res);

    if (($result['status'] == 0) && ($rows > 0)) {
        return 0;
    } elseif (($result['status'] == 1) && ($rows > 0)) {
        return 1;
    } elseif ($rows == 0) {
        return 2;
    }
}
