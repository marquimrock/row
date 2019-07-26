<?php
if ($_SESSION['acesso']==0){
	echo '<meta HTTP-EQUIV="Refresh" CONTENT="0; URL=index.php">';
	exit();
}
if(!empty($_GET['nome'])){
    $nome = $_GET['nome'];
    $usuario = $_GET['usuario'];
    $id = $_GET['id'];
    $senha = $_GET['senha'];
    $adm = $_GET['adm'];
    $senha = base64_decode($senha);
} else {
    $nome = '';
    $usuario = '';
    $id = '';
    $adm = 0;
}

?>

<div class="page-header">
    <h3></h3>
</div>

<div class="row">
    <div class="col-md-9 col-md-offset-1">
        <div class="well well-sm">
            <form class="form-horizontal" action="gravaUsuarios.php" method="post" novalidate>
                <fieldset>
                    <legend class="text-center">Cadastrar Usuários</legend>
                    
                    <!-- PRIMEIRA LINHA -->
                    <div class="form-group" style="padding-left: 50px;">                        
                        <div class="col-md-2" style="width: 130px;">
                            <label class="control-label" style="font-size: 12px; padding-bottom: 2px; padding-left: 5px;">Código:</label>
                            <input  id="id" name="id" type="text" class="form-control" maxlength="50" readonly="true"
                                    value="<?php echo!empty('$id') ? tiraEspecias($id) : '' ?>" 
                                    onkeydown="autoTab(this, event);" onkeyup="maiuscula(this)"  
                                    style="width: 100px;">
                        </div>
                        <div class="col-md-8" style="width: 620px;">
                            <label class="control-label" style="font-size: 12px; padding-bottom: 2px; padding-left: 5px;">Nome completo:</label>
                            <input  id="razao_social" name="nome" type="text" class="form-control" maxlength="50" autofocus="true" 
                                    value="<?php echo!empty($nome) ? tiraEspecias($nome) : '' ?>" 
                                    onkeydown="autoTab(this, event);" onkeyup="maiuscula(this)"  
                                    style="width: 590px;">
                        </div>
                    </div>     
                    <!-- PROXIMA LINHA -->
                    <div class="form-group" style="padding-left: 50px;">                        
                        <div class="col-md-3" style="width: 260px;">
                            <label class="control-label" style="font-size: 12px; padding-bottom: 2px; padding-left: 5px;">Usuário:</label>
                            <input id="nome_fantasia" name="usuario" type="text" class="form-control" maxlength="15" required
                                   value="<?php echo!empty($usuario) ? tiraEspecias($usuario) : '' ?>" 
                                   onkeydown="autoTab(this, event);" onkeyup="maiuscula(this)" 
                                   style="width: 230px;">
                        </div>
                        <div class="col-md-3" style="width: 260px;">
                            <label class="control-label" style="font-size: 12px; padding-bottom: 2px; padding-left: 5px;">Senha:</label>
                            <input id="senha" name="senha" type="password" class="form-control" maxlength="15" required
                                   value="<?php echo!empty($senha) ? tiraEspecias($senha) : '' ?>" 
                                   onkeydown="autoTab(this, event);" 
                                   style="width: 230px;">
                        </div>
                        <div class="col-md-3" style="width: 220px;">
                            <label class="control-label" style="font-size: 12px; padding-bottom: 2px; padding-left: 5px;">Acesso:</label>
                            <select name="adm" class="form-control" onkeydown="autoTab(this, event);" style="width: 200px;">
                               <option value="0" selected="selected">Usuário</option>
                               <option value="1" <?php if($adm == 1){ echo 'selected="selected"';} ?>>Admin</option>
                            </select>
                            
                        </div>
                    </div>
                    <!-- PROXIMA LINHA -->
                    <div class="form-group" style="width: 220px;">
                        <div class="col-md-11 text-right" style="width: 800px; padding-top: 15px;">
                            <button type="button" onclick = this.form.submit(); class="btn btn-primary btn-primary">Gravar</button>
                            <button type="button"onClick="history.go(-1)" class="btn btn-primary btn-info">Voltar</button>
                        </div>
                    </div>

                    <?php
                    $sucesso = isset($_GET['sucesso']) ? $_GET['sucesso'] : '';
                    if ($sucesso):
                        ?>
                        <div class="alert alert-success" role="alert">
                            <strong>Sucesso!</strong>
                            Usuário gravado com sucesso.
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
                    <?php
                    $userEncontrado = isset($_GET['userErro']) ? $_GET['userErro'] : '';
                    if ($userEncontrado):
                        ?>
                        <div class="alert alert-danger" role="alert">
                            <strong>Erro!</strong>
                            Este usuário já foi cadastrado!
                        </div>
                    <?php endif; ?>
                </fieldset>
            </form>
        </div>
    </div>
</div>
