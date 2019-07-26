<?php
require 'login/verifica_login.php';
require 'model/clientes_bo.php';

$cnpj = '';
$razao_social = '';
$nome_fantasia = '';
$telefone = '';
$email = '';
$qnt_pdv = '';
if (!empty($_GET['cnpj'])) {
    $cnpj = $_GET['cnpj'];
    $cnpj = tiraEspecias($cnpj);
    $result = buscaClientesPorCNPJ($cnpj);
    while ($cliente = mysqli_fetch_assoc($result)):
        $id = $cliente['id'];
        //$cnpj = mask($cnpj = $cliente['cnpj'], '##.###.###/####-##');
        $razao_social = $cliente['razao_social'];
        $nome_fantasia = $cliente['nome_fantasia'];
        $telefone = $cliente['telefone'];
        $telefone = tiraEspecias($telefone);
        $telefone = mask($telefone, '(##) #### ####');
        $email = $cliente['email'];
        $qnt_pdv = $cliente['qnt_pdv'];
    endwhile;
}
?>

<div class="page-header">
    <h3></h3>
</div>
<div class="row">
    <div class="col-md-9 col-md-offset-1">
        <div class="well well-sm">
            <form id="frm_teste"class="form-horizontal" action="gravaClientes.php" method="post" novalidate>
                <fieldset>
                    <legend class="text-center"><?php echo!empty($id) ? 'Editar Cliente' : 'Cadastrar Cliente'; ?></legend>
                    
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="cnpj">Cnpj:</label>
                        <div class="col-md-8">                            
                            <input id="cnpj" name="cnpj" type="text" value="<?php echo!empty($_GET['cnpj']) ? mask($cnpj, '##.###.###/####-##') : '' ?>" placeholder="Número do CNPJ" class="form-control" maxlength="18" required size="25"
                                   onkeydown="autoTab(this, event);" onkeypress='return event.charCode >= 48 && event.charCode <= 57 && mascaraCnpj(this)' autofocus="true">
                        </div>
                    </div>
                    <div class="form-group">  
                        <label class="col-md-3 control-label" for="razao_social" >Razão Social:</label>
                        <div class="col-md-8">                            
                            <input  id="razao_social" name="razao_social" type="text"  maxlength="50" placeholder="Razão Social" value="<?php echo!empty($_GET['razao_social']) ? $_GET['razao_social'] : $razao_social ?>" class="form-control" onkeydown="autoTab(this, event);"
                                    onkeyup="maiuscula(this)"  >
                        </div>                        
                    </div>
                    <div class="form-group"> 
                        <label class="col-md-3 control-label" for="nome_fantasia">Nome Fantasia:</label>
                        <div class="col-md-8">                            
                            <input id="nome_fantasia" name="nome_fantasia" type="text"  maxlength="50" placeholder="Nome Fantasia" value="<?php echo!empty($_GET['nome_fantasia']) ? $_GET['nome_fantasia'] : $nome_fantasia ?>" class="form-control" onkeydown="autoTab(this, event);" onkeyup="maiuscula(this)" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="cidade">Cidade:</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" placeholder="Cidade">
                        </div>                        
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="uf">Uf:</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" placeholder="Uf">
                        </div>                        
                    </div>
                    
                    <div class="form-group">
                        <label  class="col-md-3 control-label" for="telefone">Telefone:</label>
                        <div class="col-md-8">                            
                            <?php
                            if (isset($_GET['telefone'])) {
                                if (strlen($_GET['telefone']) > 10) {
                                    $telefone = mask($_GET['telefone'], '(##) ##### - ####');
                                } else {
                                    $telefone = mask($_GET['telefone'], '(##) #### - ####');
                                }
                            }
                            ?>
                            <input type="text" name="telefone" id="telefone" placeholder="telefone" value="<?php echo!empty($_GET['telefone']) ? $telefone : $telefone ?>" class="form-control" required size="20" maxlength="15" onkeypress="mascaraTelefone(this)" onkeydown="autoTab(this, event);">
                        </div>
                    </div>
                    
                    
                    <div class="form-group">
                        <label  class="col-md-3 control-label" for="celular1">Celular 1:</label>
                        <div class="col-md-8">                            
                            <?php
                            if (isset($_GET['celular1'])) {
                                if (strlen($_GET['celular1']) > 10) {
                                    $telefone = mask($_GET['celular1'], '(##) ##### - ####');
                                } else {
                                    $telefone = mask($_GET['celular1'], '(##) #### - ####');
                                }
                            }
                            ?>
                            <input type="text" name="celular1" id="telefone" placeholder="celular1" value="" class="form-control" required size="20" maxlength="15" onkeypress="mascaraTelefone(this)" onkeydown="autoTab(this, event);">
                        </div>
                    </div>
                    <div class="form-group">
                        <label  class="col-md-3 control-label" for="celular2">Celular 2:</label>
                        <div class="col-md-8">                            
                            <?php
                            if (isset($_GET['celular2'])) {
                                if (strlen($_GET['celular2']) > 10) {
                                    $telefone = mask($_GET['celular2'], '(##) ##### - ####');
                                } else {
                                    $telefone = mask($_GET['celular2'], '(##) #### - ####');
                                }
                            }
                            ?>
                            <input type="text" name="celular2" id="telefone" placeholder="celular2" value="" class="form-control" required size="20" maxlength="15" onkeypress="mascaraTelefone(this)" onkeydown="autoTab(this, event);">
                        </div>
                    </div>
                    
                    
                    

                    <div class="form-group">  
                        <label class="col-md-3 control-label" for="email">E-mail:</label>
                        <div class="col-md-8">                            
                            <input id="email" name="email" type="text"  maxlength="50" placeholder="E-mail" value="<?php echo!empty($_GET['email']) ? $_GET['email'] : $email ?>" class="form-control" onkeydown="autoTab(this, event);" onkeyup="minuscula(this)"  required>
                        </div>                        
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="qnt_pdv">Número de PDVs:</label>
                        <div class="col-md-8">                            
                            <input id="qnt_pdv" name="qnt_pdv" type="text" maxlength="3" placeholder="Quantidade de Pdvs" value="<?php echo!empty($_GET['qnt_pdv']) ? $_GET['qnt_pdv'] : $qnt_pdv ?>" class="form-control" onkeydown="autoTab(this, event);" 
                                   onkeypress="return event.charCode >= 48 && event.charCode <= 57" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-11 text-right">
                            <button type="button" onclick = redireciona(<?php echo !empty($id) ? $id : '' ?>); class="btn btn-primary btn-primary">Gravar</button>
                            
                            <button type="button"onClick="history.go(-1)"class="btn btn-primary btn-info">Voltar</button>
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
                    if (isset($_GET['erro']) && isset($_GET['qnt_pdv'])) {
                        if ($_GET['qnt_pdv'] == 0) {
                            $erroNumPdv = 'O número de PDVs não pode ser igual a <b>zero</b>!';
                        }
                    }

                    if ($erro):
                        ?>
                        <div class="alert alert-danger" role="alert">
                            <strong>Erro!</strong>
                            Verifique o formulario. <?php echo $erroNumPdv; ?>                           
                        </div>
                    <?php endif; ?>
                </fieldset>
            </form>
        </div>
    </div>
</div>