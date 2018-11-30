<div class="page-header">
    <h3></h3>
</div>
<div class="row">
    <div class="col-md-6 col-md-offset-1">
        <div class="well well-sm">
            <form class="form-horizontal" action="gravaClientes.php" method="post" novalidate>
                <fieldset>
                    <legend class="text-center">Criar Cliente</legend>
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="cnpj">CNPJ</label>
                        <div class="col-md-10">
                            <input id="cnpj" name="cnpj" type="text" placeholder="Número do CNPJ" class="form-control" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="nome">Nome</label>
                        <div class="col-md-10">
                            <input id="nome" name="nome" type="text" placeholder="Razão Social" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label" for="qtd">Qtd</label>
                        <div class="col-md-10">
                            <input id="qtd" name="qtd" type="number" placeholder="Quantidade de Pdvs" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12 text-right">
                            <button type="submit" class="btn btn-primary btn-lg">Gravar</button>
                        </div>
                    </div>
                    <?php
                    $sucesso = isset($_GET['sucesso']) ? $_GET['sucesso'] : '';
                    if ($sucesso):
                        ?>
                        <div class="alert alert-success" role="alert">
                            <strong>Sucesso!</strong>
                            Orçamento gravado com sucesso.
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