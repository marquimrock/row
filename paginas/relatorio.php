<?php
$con = conecta();

//$res = mysqli_query($con, 'SELECT * FROM tbl_orcamentos');
?>

<div class="page-header">
    <h3></h3>
</div>

<div class="row">
    <div class="panel panel-primary filterable">
        <div class="panel-heading">
            <h3 class="panel-title">Lista de Orçamentos</h3>
            <div class="pull-right">
                <button class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
            </div>
        </div>
        <table class="table">
            <thead>
                <tr class="filters">
                    <th><input type="text" class="form-control" placeholder="Nome do Cliente" disabled></th>
                    <th><input type="text" class="form-control" placeholder="Sistema" disabled></th>
                    <th><input type="text" class="form-control" placeholder="Licença" disabled></th>
                    <th><input type="text" class="form-control" placeholder="Data Venc." disabled></th>
                    <th><input type="text" class="form-control" placeholder="Data Incl." disabled></th>
                </tr>
            </thead>
            <tbody>
                <?php /* while ($orc = mysqli_fetch_assoc($res)): */ ?>
                <!--
                <tr>
                    <td><?php /* echo $orc['id'];  */?></td>
                    <td><?php /* echo $orc['cliente']; */?></td>
                    <td><?php /* echo $orc['totalhoras']; */?></td>
                    <td><?php /* echo formata_reais($orc['valorhora']); */?></td>
                    <td><?php /* echo formata_reais($orc['totalhoras'] * $orc['valorhora']); */?></td>
                </tr>
                -->
                <tr>
                    <td>Padre Cicero III</td>
                    <td>Gestão Enterprise</td>
                    <td>A4FDS5FA654F5DSA4A</td>
                    <td>31/01/2019</td>
                    <td>01/07/2018</td>
                </tr>
                <tr>
                    <td>Mini Mercado Cristalina</td>
                    <td>Gestão Enterprise</td>
                    <td>A4F775FA6E4F5BDA5C</td>
                    <td>31/03/2019</td>
                    <td>01/09/2018</td>
                </tr>
                <tr>
                    <td>Ivo Jorge da Silva</td>
                    <td>NFCe</td>
                    <td>A8F221EB6E4F5CCB10</td>
                    <td>30/04/2019</td>
                    <td>01/10/2018</td>
                </tr>
                <?php /* endwhile; */ ?>
            </tbody>
        </table>
    </div>
    <a href="?pagina=licencas">
        <button class="btn btn-primary">Nova Licença</button>
    </a>
</div>