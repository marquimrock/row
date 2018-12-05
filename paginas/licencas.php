<?php
$con = conecta();

$res = mysqli_query($con, 'SELECT * FROM tb_tipo_licenca');
?>
<div class="page-header">
    <h3></h3>
</div>
<div class="row">
    <div class="col-md-9 col-md-offset-1">
        <div class="well well-sm">
            <form class="form-horizontal" action="gravaLicencas.php" method="post" novalidate>
                <fieldset>
                    <legend class="text-center">Criar Licença</legend>

                    <div class="form-group">
                        <label class="col-md-3 control-label" for="cnpj">CNPJ</label>
                        <div class="col-md-8">
                            <input id="cnpj" name="cnpj" type="text" placeholder="CNPJ" class="form-control" maxlength="18" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label" for="cnpj">Tipo Licenca</label>
                        <div class="col-md-8">
                            <select class="form-control" name="cmbItens">
                                <option id="0">Selecione...</option>
                                <?php while ($tipoLic = mysqli_fetch_assoc($res)): ?>
                                    <option ><?php echo $tipoLic['id'] . " - " . $tipoLic['sistema'] . " - " . $tipoLic['descricao']; ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label" for="serie">Série</label>
                        <div class="col-md-8">
                            <input id="serie" name="serie" min='0' type="number" placeholder="Série" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label" for="senha">Senha</label>
                        <div class="col-md-8">
                            <input id="senha" name="senha" type="text" placeholder="Senha" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label" for="dt_venc">Vencimento</label>
                        <div class="col-md-8">
                            <input id="dt_venc" name="dt_venc" type="date" placeholder="Data de vencimento" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-11 text-right">
                            <button type="submit" class="btn btn-primary btn-lg">Gravar</button>
                        </div>
                    </div>
                    <?php
                    $sucesso = isset($_GET['sucesso']) ? $_GET['sucesso'] : '';
                    if ($sucesso):
                        ?>
                        <div class="alert alert-success" role="alert">
                            <strong>Sucesso!</strong>
                            Licença gravada com sucesso.
                        </div>
                    <?php endif; ?>
                    <?php
                    $erro = isset($_GET['erro']) ? $_GET['erro'] : '';
                    if ($erro):
                        ?>
                        <div class="alert alert-danger" role="alert">
                            <strong>Erro!</strong>
                            Erro nos dados, verifique o formulario.
                        </div>
                    <?php endif; ?>
                </fieldset>
            </form>
        </div>
    </div>
</div>