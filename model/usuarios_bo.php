<?php

function gravaUsuario($nome, $usuario, $senha) {
    $con = conecta();
    $insert = "INSERT INTO tb_usuario"
            . "(nome, usuario, senha, adm)"
            . "VALUES ('$nome', '$usuario', '$senha', '0')";

    return mysqli_query($con, $insert);
}

function alteraUsuario($nome, $usuario, $senha, $id, $adm) {
    $con = conecta();
    $update = "update tb_usuario set "
            . "nome ='$nome', usuario = '$usuario', senha = '$senha', adm = '$adm' "
            . "where id = '$id'";

    return mysqli_query($con, $update);
   
}

function buscaUsuario($usuario) {
    $con = conecta();
    $query = "SELECT * FROM tb_usuario WHERE usuario = '$usuario'";
    $res = mysqli_query($con, $query);
    $rows = mysqli_num_rows($res);

    if ($rows > 0) {
        return 1;
    } else {
        return 0;
    }
}

function buscaTodosUsuario() {
    $con = conecta();
    $query = "SELECT * FROM tb_usuario";

    return mysqli_query($con, $query);
}

function limiteUsuPorPagina($inicio_pag, $usuarios_por_pagina) {
    
    $con = conecta();
    $query = "SELECT * FROM tb_usuario LIMIT $inicio_pag, $usuarios_por_pagina";

    return mysqli_query($con, $query);
     
     
}
