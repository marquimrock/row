<?php
require 'login/verifica_login.php';
require 'model/usuarios_bo.php';
$pag;

//verifica se o numero da pagina está sendo passada na URL, senão, atribui pagina 1;
if (substr($_GET['pagina'], 18, 19)) {
    $pag = substr($_GET['pagina'], 18, 19);
} else {
    $pag = 1;
}

//seleciona todos os clientes da tabela
$res = buscaTodosUsuario();

//conta o total de clientes encontrados no banco
$total_usuarios = mysqli_num_rows($res);

//seta a quantidade de clientes por pagina
$usuarios_por_pagina = 9;

//definir numero de paginas e arrendondar para o proximo numero inteiro acima
$numero_paginas = ceil($total_usuarios / $usuarios_por_pagina);

//calcular o inicio da visualização
$inicio_pag = ($usuarios_por_pagina * $pag) - $usuarios_por_pagina;

//selecionar os clientes a serem apresentados na pagina
$resultado = limiteUsuPorPagina($inicio_pag, $usuarios_por_pagina);
?>
<br>
<div class="row">
    <div class="panel panel-primary filterable">
        <div class="panel-heading">
            <h3 class="panel-title text-center">Relatório de Usuários</h3>
            <div class="pull-right">
                <button class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
            </div>
        </div>
        <?php if ($total_usuarios > 0): ?>
            <table class="table">
                <thead>
                    <tr class="filters">
                        <th><input class="text-center" type="text" class="form-control" placeholder="Código" disabled></th>
                        <th><input class="text-center" type="text" class="form-control" placeholder="Nome" disabled></th>
                        <th><input class="text-center" type="text" class="form-control" placeholder="Usuário" disabled></th>
                        <th><input class="text-center" type="text" class="form-control" placeholder="Nível" disabled></th>
                        <th><input class="text-center" type="text" class="form-control" placeholder="Ações" disabled></th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($usuarios = mysqli_fetch_assoc($resultado)): ?>
                    <tr class="text-center">
                            <td><?php echo $usuarios['id']; ?></td>
                            <td><?php echo $usuarios['nome']; ?></td>
                            <td><?php echo $usuarios['usuario']; ?></td>
                            <?php  base64_decode($usuarios['senha']); ?>
                            <td><?php if ($usuarios['adm'] == 1){echo "Admin";}else{echo "Usuário";} ?></td>
                            <td>
                                <a href="?pagina=usuarios&usuario='<?php echo $usuarios['usuario']; ?>'&nome='<?php echo $usuarios['nome']; ?>'&id='<?php echo $usuarios['id']; ?>'&senha='<?php echo $usuarios['senha']; ?>'&adm=<?php echo $usuarios['adm']; ?>">
                                    <button class="btn btn-primary">Editar</button>
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
    <nav aria-label="Navegação de página exemplo" align="center">
        <ul class="pagination">
            <!-- PAGINA ANTERIOR -->
            <li class="page-item">
                <?php if ($pagina_anterior != 0) { ?>
                    <a class="page-link" href="?pagina=relatorio_usuarios<?php echo $pagina_anterior; ?>" aria-label="Anterior">
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
                <li <?php echo $estilo; ?> class="page-item"><a class="page-link" href="?pagina=relatorio_usuarios<?php echo $i; ?>"><?php echo $i; ?></a></li>
            <?php endfor; ?>
            <!-- PAGINA POSTERIOR --> 
            <li class="page-item">
                <?php if ($pagina_posterior <= $numero_paginas) { ?> 
                    <a class="page-link" href="?pagina=relatorio_usuarios<?php echo $pagina_posterior; ?>" aria-label="Próximo">
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