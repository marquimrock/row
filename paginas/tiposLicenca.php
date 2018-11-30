<div class="page-header">
    <h3></h3>
</div>
<div class="row">
    <div class="col-md-6 col-md-offset-1">
        <div class="well well-sm">
            <form class="form-horizontal" action="#" method="post" novalidate>
                <fieldset>
                    <legend class="text-center">Criar Tipos de Licença</legend>
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="tp_senha">Tipo</label>
                        <div class="col-md-10">
                            <input id="tp_senha" name="tp_senha" type="text" placeholder="Tipo de senha" class="form-control" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="codigo">Código</label>
                        <div class="col-md-10">
                            <input id="codigo" name="codigo" type="number" placeholder="Código" class="form-control" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="sistema">Sistema</label>
                        <div class="col-md-10">
                            <input id="sistema" name="sistema" type="text" placeholder="Versão de Sistema" class="form-control" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="desc">Descrição</label>
                        <div class="col-md-10">
                            <input id="desc" name="desc" type="text" placeholder="Descrição" class="form-control" required>
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