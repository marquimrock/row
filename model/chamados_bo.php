<?php

$var = $_SESSION['status'];
echo $var;

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

function gravaChamado($id_usuario, $id_cliente, $solicitante, $ocorrencia, $var,$tecnico_fechamento) {
    $data_abertura = date('Y-m-d');
    $hora_abertura = date('h:i');
    $con  = conecta();
    $insert = "INSERT INTO tb_chamado"
            . "(data_abertura, hora_abertura, id_usuario, id_cliente, solicitante, ocorrencia, status, tecnico_fechamento)"
            . "VALUES ('$data_abertura','$hora_abertura', $id_usuario, $id_cliente, '$solicitante', '$ocorrencia', '$var',6)";
           return  mysqli_query($con, $insert);
                
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

