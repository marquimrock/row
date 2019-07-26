<?php
require 'login/verifica_login.php';
require 'model/clientes_bo.php';
require 'model/licencas_bo.php';
$pag;

//verifica se o numero da pagina está sendo passada na URL, senão, atribui pagina 1;
if (substr($_GET['pagina'], 9, 10)) {
    $pag = substr($_GET['pagina'], 9, 10);
} else {
    $pag = 1;
}

//seleciona todos os clientes da tabela
$res = buscaTodosClientes();

//conta o total de clientes encontrados no banco
$total_clientes = mysqli_num_rows($res);

//seta a quantidade de clientes por pagina
$clientes_por_pagina = 9;

//definir numero de paginas e arrendondar para o proximo numero inteiro acima
$numero_paginas = ceil($total_clientes / $clientes_por_pagina);

//calcular o inicio da visualização
$inicio_pag = ($clientes_por_pagina * $pag) - $clientes_por_pagina;

//selecionar os clientes a serem apresentados na pagina
$resultado = limiteCliPorPagina($inicio_pag, $clientes_por_pagina);
?>
<br>
<div class="row">
    <div class="panel panel-primary filterable">
        <div class="panel-heading">
            <h3 class="panel-title text-center">Relatório de Clientes</h3>
            <div class="pull-right">
                <button class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
            </div>
        </div>
        <?php if ($total_clientes > 0): ?>
            <table class="table">
                <thead>
                    <tr class="filters">
                        <th><input class="text-center" type="text" class="form-control" placeholder="CNPJ" disabled style="width: 100px"></th>
                        <th><input class="text-center" type="text" class="form-control" placeholder="Razão Social" disabled style="width: 200px"></th>
                        <th><input class="text-center" type="text" class="form-control" placeholder="Telefone" disabled style="width: 110px"></th>
                        <th><input class="text-center" type="text" class="form-control" placeholder="Email" disabled></th>
                        <th><input class="text-center" type="text" class="form-control" placeholder="Ações" disabled style="width: 240px"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($cliente = mysqli_fetch_assoc($resultado)): ?>
                        <tr>
                            <td><?php
                                $cnpj = tiraEspecias($cliente['cnpj']);
                                echo (strlen($cnpj) === 14 ? mask($cnpj, '##.###.###/####-##') : mask($cnpj, '########-####'));
                                ?> 
                            </td>
                            <td><?php echo $cliente['razao_social']; ?></td>
                            <td><?php
                                $telefone = $cliente['telefone'];
                                echo (strlen($telefone) === 10 ? mask($telefone, "(##) ####-####") : mask($telefone, "(##) # ####-####"));
                                ?>
                            </td>
                            <td><?php echo $cliente['email']; ?></td>
                            <td>
                                <a href="?pagina=clientes&cnpj='<?php echo $cliente['cnpj']; ?>'">
                                    <button class="btn btn-primary">Editar</button>
                                </a>
                                <a href="?pagina=relatorio_licencas&cnpj='<?php echo tiraEspecias($cliente['cnpj']); ?>'">
                                    <button class="btn btn-primary">Licenças</button>
                                </a>
                                <!-- VERIFICA SE O CLIENTE ESTÁ BLOQUEADO -->  
                                <?php if (consultaStatus($cliente['id']) == 1 && ($_SESSION['acesso']==1)) { ?>
                                    <a href="./gravaStatusCliente.php?status=0&id_cliente=<?php echo $cliente['id']; ?>">
                                        <button class="btn btn-danger" style="width: 80px">Bloquear</button>
                                    </a>
                                <?php } elseif (consultaStatus($cliente['id']) == 0) { ?>
                                    <a href="./gravaStatusCliente.php?status=1&id_cliente=<?php echo $cliente['id']; ?>">
                                        <button class="btn btn-success" style="width: 80px">Liberar</button>
                                    </a>
                                <?php } elseif (consultaStatus($cliente['id']) == 2) { ?>
                                    <a href="#">
                                        <button class="btn btn-default" style="width: 80px">Inativo</button>
                                    </a>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>

    <?php
    //verificar a pagina anterior e posterior
    $pagina_anterior = $pag - 1;
    $pagina_posterior = $pag + 1;
    ?>
    <!-- PAGINAÇÃO -->
    <nav aria-label="Navegação de página exemplo" align="center">
        <ul class="pagination">
            <!-- PAGINA ANTERIOR -->
            <li class="page-item">
                <?php if ($pagina_anterior != 0) { ?>
                    <a class="page-link" href="?pagina=relatorio<?php echo $pagina_anterior; ?>" aria-label="Anterior">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                <?php } else { ?>
                    <span aria-hidden="true">&laquo;</span>
                <?php } ?>
            </li>
            <?php
            for ($i = 1; $i < $numero_paginas + 1; $i++):
                //ATIVA O BOTÃO DA PAGINA ATUAL
                $estilo = "";
                if ($pag == $i) {
                    $estilo = "class=\"active\"";
                }
                ?>
                <!-- APRESENTA A PAGINAÇÃO -->
                <li <?php echo $estilo; ?> class="page-item"><a class="page-link" href="?pagina=relatorio<?php echo $i; ?>"><?php echo $i; ?></a></li>
            <?php endfor; ?>
            <!-- PAGINA POSTERIOR --> 
            <li class="page-item">
                <?php if ($pagina_posterior <= $numero_paginas) { ?> 
                    <a class="page-link" href="?pagina=relatorio<?php echo $pagina_posterior; ?>" aria-label="Próximo">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                <?php } else { ?>
                    <span aria-hidden="true">&raquo;</span>
                <?php } ?>
            </li>
        </ul>
    </nav>
</div>

<br><br>