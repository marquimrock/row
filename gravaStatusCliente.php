<?php

require 'model/clientes_bo.php';
require 'banco/conexao.php';
require 'lib/funcs.php';

$res = alterarStatusCliente($_GET['status'], $_GET['id_cliente']);

if ($res) {
    header('Location: index.php?pagina=relatorio');
}
