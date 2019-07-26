<?php
require 'login/verifica_login.php';
require 'model/licencas_bo.php';
require 'model/clientes_bo.php';
$pag;

//verifica se o numero da pagina está sendo passada na URL, senão, atribui pagina 1;
if (substr($_GET['pagina'], 18, 19) >= 1) {
    $pag = substr($_GET['pagina'], 18, 19);
} else {
    $pag = 1;
}

//seleciona todas as licenças da tabela
$result_rows = buscaLicencas($_GET['cnpj']);

//conta o total de licenças encontradas no banco
$total_licencas = mysqli_num_rows($result_rows);

//Seta a quantidade de licenças por pagina
$itens_por_pagina = 9;

//definir numero de paginas e arrendondar para o proximo numero inteiro acima;
$num_paginas = ceil($total_licencas / $itens_por_pagina);

//calcular o inicio da visualização
$inicio = ($itens_por_pagina * $pag) - $itens_por_pagina;

//selecionar as licenças a serem apresentadas na paginas
$result = limiteLicPorPagina($inicio, $itens_por_pagina, $_GET['cnpj']);

//busca um cliente por cnpj
$buscaCliente = buscaClientesPorCNPJ(tiraEspecias($_GET['cnpj']));

$nomeCliente = '';
while ($cliente = mysqli_fetch_assoc($buscaCliente)) {
    $cnpjCliente = $cliente['cnpj'];
    $nomeCliente = $cliente['razao_social'];
}
?>

<br>
<div class="row">
    <legend class="text-right" style="font-size:17px;"><b><font color="gray"><?php echo $nomeCliente . (isset($cnpjCliente)? " - " . mask($cnpjCliente, '##.###.###/####-##'): ''); ?></font></b></legend>
    <div class="panel panel-primary filterable">
        <div class="panel-heading">

            <h3 class="panel-title text-center">Relatório de Licenças<?php //echo " - " . $nomeCliente . " - " . mask($cnpjCliente, '##.###.###/####-##');         ?></h3>
            <div class="pull-right">
                <button class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
            </div>
        </div>
        <?php if ($total_licencas > 0): ?>
            <table class="table">
                <thead>
                    <tr class="filters">
                        <th><input type="text" class="form-control text-center" placeholder="Serie" disabled style="width:120px;"></th>
                        <th><input type="text" class="form-control text-center" placeholder="Senha" disabled style="/*width:5px;*/"></th>
                        <th><input type="text" class="form-control text-center" placeholder="Inclusão" disabled style="width:180px;"></th>  
                        <th><input type="text" class="form-control text-center" placeholder="Vencimento" disabled style="width:180px;"></th>
                        <th><input type="text" class="form-control text-center" placeholder="Utilizado" disabled style="width:130px;"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($licenca = mysqli_fetch_assoc($result)): ?>
                        <?php
                        $data_venc = (new DateTime($licenca['data_vencimento']))->format('Y-m-d');
                        $data_atual = date('Y-m-d', strtotime('now'));

                        //CONVERTE AS DATAS PARA O FORMATO TIMESTAMP
                        $dt_venc = strtotime($data_venc);
                        $dt_atual = strtotime($data_atual);

                        //VERIFICA A DIFERENÇA EM SEGUNDOS ENTRE AS DUAS DATAS E DIVIDE PELO NUMERO DE SEGUNDOS QUE UM DIA POSSUI
                        $dif_data = ($dt_venc - $dt_atual) / 86400;

                        $bg_color = '';
                        if ($dif_data <= 5 && $dif_data >= 0) {
                            $bg_color = '#FF7F50';
                        } else if ($dif_data < 15 && $dif_data > 5) {
                            $bg_color = '#FFFF00';
                        } else if($dif_data < 0){
                            $bg_color = '#DCDCDC';
                        }
                        ?>
                        <tr style="background-color: <?php echo $bg_color; ?>">
                            <td class="text-center" style="width:120px;"><?php echo $licenca['serie']; ?></td>
                            <td class="text-center" style="/*width:5px;*/"><?php echo $licenca['senha']; ?></td>
                            <td class="text-center" style="width:180px;"><?php echo (new DateTime($licenca['data_inclusao']))->format('d/m/Y'); ?></td>
                            <td class="text-center" style="width:180px;"><?php echo (new DateTime($licenca['data_vencimento']))->format('d/m/Y'); ?></td>
                            <?php if ($licenca['utilizado'] == '1') { ?>
                                <td class="text-center" style="width:130px;"><font color="green"><b>Sim</b></font></td>
                            <?php } else { ?>
                                <td class="text-center" style="width:130px;"><font color="red"><b>Não</b></font></td>
                            <?php } ?>     
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
    <div class="pull-right" style="display: <?php echo empty($cnpjCliente) ? 'none' : 'show'; ?>">
        <a href="?pagina=licencas&cnpj=<?php echo $cnpjCliente; ?>">
            <button class="btn btn-primary">Novo</button>
        </a>
         <button  class="btn btn-primary btn-info" type="button"onClick="history.go(-1)">Voltar</button>
         
    </div>
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

