<?php
require 'login/verifica_login.php';
require 'model/clientes_bo.php';
require 'model/chamados_bo.php';
$pag;

//verifica se o numero da pagina está sendo passada na URL, senão, atribui pagina 1;
if (substr($_GET['pagina'], 18, 19) >= 1) {
    $pag = substr($_GET['pagina'], 18, 19);
} else {
    $pag = 1;
}

//seleciona todas as licenças da tabela
$result_rows = buscaTodosChamados();

//conta o total de licenças encontradas no banco
$total_chamados = mysqli_num_rows($result_rows);

//Seta a quantidade de licenças por pagina
$itens_por_pagina = 9;

//definir numero de paginas e arrendondar para o proximo numero inteiro acima;
$num_paginas = ceil($total_chamados / $itens_por_pagina);

//calcular o inicio da visualização
$inicio = ($itens_por_pagina * $pag) - $itens_por_pagina;

//selecionar as licenças a serem apresentadas na paginas
$result = limiteChamPorPagina($inicio, $itens_por_pagina);
?>
<br>
<div class="row">
    <div class="panel panel-primary filterable">
        <div class="panel-heading">
            <h3 class="panel-title text-center">Relatório de Chamados</h3>
            <div class="pull-right">
                <button class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
            </div>
        </div>
        <?php if ($total_chamados > 0): ?>
            <table class="table">
                <thead>
                    <tr class="filters">
                        <th><input class="text-center" type="text" class="form-control" placeholder="Id" disabled style="width: 100px"></th>
                        <th><input class="text-center" type="text" class="form-control" placeholder="Solicitante" disabled style="width: 200px"></th>
                        <th><input class="text-center" type="text" class="form-control" placeholder="Ocorrencia" disabled style="width: 110px"></th>
                        <th><input class="text-center" type="text" class="form-control" placeholder="Email" disabled></th>
                        <th><input class="text-center" type="text" class="form-control" placeholder="Ações" disabled style="width: 240px"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($chamado = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?php echo ($chamado['id']);?></td>
                            <td><?php echo ($chamado['solicitante'])?></td>
                            <td><?php echo ($chamado['ocorrencia']) ?></td>
                            <td><?php  ?></td>
                            <td>
                                <a href="?pagina=chamados&id='<?php echo $chamado['id']; ?>'">
                                    <button class="btn btn-primary">Editar</button>
                                </a>
                                <a href="?pagina=relatorio_chamados&id='<?php echo tiraEspecias($chamado['id']); ?>'">
                                    <button class="btn btn-primary">Chamados</button>
                                </a>
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
    <nav aria-label="Navegação de página exemplo" class="text-center">
        <ul class="pagination">
            <!-- PAGINA ANTERIOR -->
            <li class="page-item">                
                <?php if ($pagina_anterior != 0) { ?>
                    <a class="page-link" href="?pagina=relatorio_licencas<?php echo $pagina_anterior; ?>&cnpj=<?php echo $_GET['cnpj']; ?>" aria-label="Anterior">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                <?php } else { ?>
                    <span aria-hidden="true">&laquo;</span>
                <?php } ?>
            </li>
            <?php
            for ($i = 1; $i < $num_paginas + 1; $i++):
                //ATIVA O BOTÃO DA PAGINA ATUAL
                $estilo = "";
                if ($pag == $i) {
                    $estilo = "class=\"active\"";
                }
                ?>
                <!-- APRESENTA A PAGINAÇÃO -->
                <li <?php echo $estilo; ?> class="page-item"><a class="page-link" href="?pagina=relatorio_licencas<?php echo $i; ?>&cnpj=<?php echo $_GET['cnpj']; ?>"><?php echo $i; ?></a></li>
            <?php endfor; ?>
            <!-- PAGINA POSTERIOR -->    
            <li class="page-item">                
                <?php if ($pagina_posterior <= $num_paginas) { ?> 
                    <a class="page-link" href="?pagina=relatorio_licencas<?php echo $pagina_posterior; ?>&cnpj=<?php echo $_GET['cnpj']; ?>" aria-label="Próximo">
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

