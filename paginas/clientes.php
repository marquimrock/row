<div class="page-header">
    <h3></h3>
</div>
<div class="row">
    <div class="col-md-9 col-md-offset-1">
        <div class="well well-sm">
            <form class="form-horizontal" action="gravaClientes.php" method="post" novalidate>
                <fieldset>
                    <legend class="text-center">Cadastrar Cliente</legend>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="cnpj">CNPJ</label>
                        <div class="col-md-8">
                            <input id="cnpj" name="cnpj" type="text" placeholder="Número do CNPJ" class="form-control" maxlength="18" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="razao_social">Razão Social</label>
                        <div class="col-md-8">
                            <input id="razao_social" name="razao_social" type="text" placeholder="Razão Social" class="form-control" required>
                        </div>
                    </div>

                     <div class="form-group">
                        <label class="col-md-3 control-label" for="nome_fantasia">Nome Fantasia</label>
                        <div class="col-md-8">
                            <input id="nome_fantasia" name="nome_fantasia" type="text" placeholder="Nome Fantasia" class="form-control" required>
                        </div>
                    </div>

                     <div class="form-group">
                        <label class="col-md-3 control-label" for="Telefone">Telefone</label>
                        <div class="col-md-8">
                            <input id="telefone" name="telefone" type="text" placeholder="telefone" class="form-control" required>
                        </div>
                    </div>

                     <div class="form-group">
                        <label class="col-md-3 control-label" for="email">E-mail</label>
                        <div class="col-md-8">
                            <input id="email" name="email" type="text" placeholder="E-mail" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label" for="qnt_pdv">Qtd</label>
                        <div class="col-md-8">
                            <input id="qnt_pdv" name="qnt_pdv" type="number" placeholder="Quantidade de Pdvs" class="form-control" required>
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
                            Cliente gravado com sucesso.
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