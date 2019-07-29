<?php

//busca os codigos de licença para preencher a combobox
function buscaTodosChamados() {
    $con = conecta();
    $query = "SELECT * FROM tb_chamado";
    return mysqli_query($con, $query);
}

//busca os codigos de licença para preencher a combobox
function buscaChamadosPorId($id) {
    $con = conecta();
    $query = "SELECT * FROM tb_chamado WHERE id = $id" ;
    return mysqli_query($con, $query);
}

function gravaChamado($id_usuario, $solicitante, $ocorrencia, $status) {
    $data = date('Y-m-d');
    $hora = date('h:i');
    $con  = conecta();
    $insert = "INSERT INTO tb_chamado"
            . "(data, hora, id_usuario, solicitante, ocorrencia)"
            . "VALUES ('$data','$hora', $id_usuario, '$solicitante', '$ocorrencia', '$status')";
        echo $insert;    
        //return  mysqli_query($con, $insert);
}

function limiteChamPorPagina($inicio_pag, $chamados_por_pagina) {
    $con = conecta();
    $query = "SELECT * FROM tb_chamado LIMIT $inicio_pag, $chamados_por_pagina";
    return mysqli_query($con, $query);
}


//busca os tipos de sistema para preencher a combobox
function buscaTiposSistema() {
    $con = conecta();
    return mysqli_query($con, 'SELECT * FROM tb_tipo_sistema');
}

//utilizada no "relatorio de licenças" para encontrar quantidade total de licenças por cnpj
function buscaLicencas($cnpj = '') {
    $con = conecta();
    if (empty($cnpj)) {
        $query = "SELECT * FROM tb_licenca
    inner join tb_cliente on tb_cliente.id = tb_licenca.id_cliente order by data_vencimento";
    } else {
        $query = "SELECT * FROM tb_licenca
    inner join tb_cliente on tb_cliente.id = tb_licenca.id_cliente WHERE tb_cliente.cnpj = $cnpj order by data_vencimento";
    }
    return mysqli_query($con, $query);
}

function buscaLicencasPorData($dt_inicial = '', $dt_final = '') {
    $con = conecta();

    $query = "SELECT * FROM tb_licenca
    inner join tb_cliente on tb_cliente.id = tb_licenca.id_cliente WHERE tb_licenca.data_vencimento BETWEEN '$dt_inicial 00:00:00'  AND '$dt_final 23:59:59'  order by data_vencimento";

    return mysqli_query($con, $query);
}

function gravaLicenca($id_cnpj, $codigo_licenca, $tipo_sistema, $serie, $senha, $vencimento, $inclusao) {
    $con = conecta();
    $insert = "INSERT INTO tb_licenca"
            . "(id_cliente, id_codigo_licenca, id_tipo_sistema, serie, senha, data_vencimento, data_inclusao)"
            . "VALUES ($id_cnpj, $codigo_licenca, $tipo_sistema, '$serie', '$senha', '$vencimento','$inclusao')";

    return mysqli_query($con, $insert);
}

//utilizada para definir a quantidade de licenças por pagina
function limiteLicPorPagina($inicio, $itens_por_pagina, $cnpj = '', $dt_inicial = '', $dt_final = '') {
    $con = conecta();
    if (empty($cnpj)) {
        $query = "SELECT * FROM tb_licenca inner join tb_cliente on tb_cliente.id = tb_licenca.id_cliente "
                . "order by (CASE WHEN (data_vencimento - now()) < 0 THEN 0 ELSE 1 END) DESC, data_vencimento LIMIT $inicio, $itens_por_pagina";
    } else {
        $query = "SELECT * FROM tb_licenca inner join tb_cliente on tb_cliente.id = tb_licenca.id_cliente WHERE tb_cliente.cnpj = $cnpj "
                . "order by (CASE WHEN (data_vencimento - now()) < 0 THEN 0 ELSE 1 END) DESC, data_vencimento LIMIT $inicio, $itens_por_pagina";
    }
    if (!empty($dt_inicial)) {
        $query = "SELECT * FROM tb_licenca inner join tb_cliente on tb_cliente.id = tb_licenca.id_cliente "
                . "WHERE tb_licenca.data_vencimento BETWEEN '$dt_inicial 00:00:00'  AND '$dt_final 23:59:59' order by "
                . "(CASE WHEN (data_vencimento - now()) < 0 THEN 0 ELSE 1 END) DESC, data_vencimento LIMIT $inicio, $itens_por_pagina";
    }

    return mysqli_query($con, $query);
}

//verifica se a licença existe
function buscarSenha($senha) {
    $con = conecta();
    $query = "SELECT * FROM tb_licenca WHERE senha = '$senha'";
    $res = mysqli_query($con, $query);
    $rows = mysqli_num_rows($res);

    if ($rows > 0) {
        return 1;
    } else {
        return 0;
    }
}
