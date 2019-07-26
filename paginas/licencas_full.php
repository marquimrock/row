<?php
require 'login/verifica_login.php';
require 'model/licencas_bo.php';
require 'model/clientes_bo.php';
$pag;
$dt_inicial = '';
$dt_final = '';
//verifica se o numero da pagina está sendo passada na URL, senão, atribui pagina 1;
if (substr($_GET['pagina'], 13, 14) >= 1) {
    $pag = substr($_GET['pagina'], 13, 14);
} else {
    $pag = 1;
}
if (!empty($_POST['dt_inicial'])) {
    $dt_in = str_replace("/", "-", $_POST['dt_inicial']);
    $dt_inicial = (new DateTime(date('Y-m-d', strtotime($dt_in))))->format('Y-m-d');

    if ($_POST['dt_final']) {
        $dt_fi = str_replace("/", "-", $_POST['dt_final']);
        $dt_final = (new DateTime(date('Y-m-d', strtotime($dt_fi))))->format('Y-m-d');
    }
    $result_rows = buscaLicencasPorData($dt_inicial, $dt_final);
} else {
    //seleciona todas as licenças da tabela
    $result_rows = buscaLicencas();
}
//conta o total de licenças encontradas no banco
$total_licencas = mysqli_num_rows($result_rows);
//Seta a quantidade de licenças por pagina
$itens_por_pagina = 9;

//definir numero de paginas e arrendondar para o proximo numero inteiro acima;
$num_paginas = ceil($total_licencas / $itens_por_pagina);

//calcular o inicio da visualização
$inicio = ($itens_por_pagina * $pag) - $itens_por_pagina;

//selecionar as licenças a serem apresentadas na paginas
$result = limiteLicPorPagina($inicio, $itens_por_pagina, '', $dt_inicial, $dt_final);
?>

<div class="row">
    <div class="panel" style="height: 50px;">        
        <div class="panel-heading">  
            <fieldset>
                <div class="row">
                    <form method="post" action="index.php?pagina=licencas_full">  
                        <div class="form-group">
                            <!-- <div class="col-md-7"></div> -->  
                            <label class="col-md-7 control-label text-right" style="padding-top: 8px;"><i>Busca por data de vencimento:</i></label>
                            <div class="col-md-2">
                                <input id="dt_inicial" name="dt_inicial" type="text" maxlength="10" placeholder="data inicial" class="form-control" onkeydown="autoTab(this, event);" onkeypress="return event.charCode >= 48 && event.charCode <= 57 && mascaraData(this)">
                            </div>                            
                            <div class="col-md-2">
                                <input id="dt_final" name="dt_final" type="text" maxlength="10" placeholder="data final" class="form-control" onkeydown="autoTab(this, event);" onkeypress="return event.charCode >= 48 && event.charCode <= 57 && mascaraData(this)">
                            </div>  
                            <div class="col-md-1">
                                <button type="submit" class="btn btn-default btn-sm">Buscar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </fieldset> 
        </div>          
    </div>
    <hr>
    <div class="panel panel-primary filterable">
        <div class="panel-heading">
            <h3 class="panel-title text-center">Relatório de Licenças</h3>
            <div class="pull-right">
                <button class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
            </div>
        </div>

        <?php if ($total_licencas > 0): ?>        
            <table class="table">
                <thead>
                    <tr class="filters">
                        <th><input type="text" class="form-control text-center" placeholder="CNPJ" disabled style="width:80px;"></th>
                        <th><input type="text" class="form-control text-center" placeholder="Razão Social" disabled style="width:200px;"></th>
                        <th><input type="text" class="form-control text-center" placeholder="Serie" disabled style="width:90px;"></th>
                        <th><input type="text" class="form-control text-center" placeholder="Senha" disabled style="width:80px;"></th>
                        <th><input type="text" class="form-control text-center" placeholder="Inclusão" disabled style="width:80px;"></th>  
                        <th><input type="text" class="form-control text-center" placeholder="Vencimento" disabled style="width:80px;"></th>
                        <th><input type="text" class="form-control text-center" placeholder="Utilizado" disabled style="width:80px;"></th>
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
                        } else if ($dif_data < 0) {
                            $bg_color = '#DCDCDC';
                        }
                        ?>
                        <tr style="background-color: <?php echo $bg_color; ?>">
                            <td class="text-center" style="width:80px;"><?php
                                $cnpj = $licenca['cnpj'];
                                tiraEspecias($cnpj);
                                echo (strlen($cnpj) === 14 ? mask($cnpj, '##.###.###/####-##') : mask($cnpj, '########-####'));
                                ?></td>
                            <td class="text-center" style="width:200px;"><?php echo $licenca['razao_social']; ?></td>
                            <td class="text-center" style="width:90px;"><?php echo $licenca['serie']; ?></td>
                            <td class="text-center" style="width:80px;"><?php echo $licenca['senha']; ?></td>
                            <td class="text-center" style="width:80px;"><?php echo (new DateTime($licenca['data_inclusao']))->format('d/m/Y'); ?></td>
                            <td class="text-center" style="width:80px;"><?php echo (new DateTime($licenca['data_vencimento']))->format('d/m/Y'); ?></td>
                            <?php if ($licenca['utilizado'] == '1') { ?>
                                <td class="text-center" style="width:80px;"><font color="green"><b>Sim</b></font></td>
                            <?php } else { ?>
                                <td class="text-center" style="width:80px;"><font color="red"><b>Não</b></font></td>
                            <?php } ?>     
                        </tr>  
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>

    <!-- LEGENDA -->
    <div class="row">                  
        <div class="col-md-12 text-left" style="font-size: 12px;">
            <button class="btn" style="background-color: #FF7F50; padding-left: 20px;"></button> 05 ou menos dias para vencer &nbsp;&nbsp;&nbsp;
            <button class="btn" style="background-color: #FFFF00; padding-left: 20px;"></button> 15 ou menos dias para vencer &nbsp;&nbsp;&nbsp;
            <button class="btn" style="background-color: #DCDCDC; padding-left: 20px;"></button> Licenças expiradas &nbsp;&nbsp;&nbsp;
        </div>
    </div> 

    <!-- PAGINAÇÃO -->
    <?php
    //verificar a pagina anterior e posterior
    $pagina_anterior = $pag - 1;
    $pagina_posterior = $pag + 1;
    ?>    
    <nav aria-label="Navegação de página exemplo" class="text-center">
        <ul class="pagination">
            <!-- PAGINA ANTERIOR -->
            <li class="page-item">                
                <?php if ($pagina_anterior != 0) { ?>
                    <a class="page-link" href="?pagina=licencas_full<?php echo $pagina_anterior; ?>" aria-label="Anterior">
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
                <li <?php echo $estilo; ?> class="page-item"><a class="page-link" href="?pagina=licencas_full<?php echo $i; ?>"><?php echo $i; ?></a></li>
            <?php endfor; ?>
            <!-- PAGINA POSTERIOR -->    
            <li class="page-item">                
                <?php if ($pagina_posterior <= $num_paginas) { ?> 
                    <a class="page-link" href="?pagina=licencas_full<?php echo $pagina_posterior; ?>" aria-label="Próximo">
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