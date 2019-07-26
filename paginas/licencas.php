<?php
if ($_SESSION['acesso']==0){
	echo '<meta HTTP-EQUIV="Refresh" CONTENT="0; URL=index.php">';
	exit();
}
require 'login/verifica_login.php';
require 'model/licencas_bo.php';

// -------------------------------------------------------------------
// BUSCA OS CODIGOS DE LICENÇA PARA PREENCHER COMBOBOX
// -------------------------------------------------------------------
$res_codigo_licenca = buscaCodigoLicenca();

// -------------------------------------------------------------------
// BUSCA OS TIPOS DE SISTEMA PARA PREENCHER COMBOBOX
// -------------------------------------------------------------------
$res_tipo_sistema = buscaTiposSistema();

// -------------------------------------------------------------------
// MANTEM OS CAMPOS PREENCHIDOS DURANTE O RETORNO DE ERRO DE VALIDAÇÕES
// -------------------------------------------------------------------
$cnpj = isset($_GET['cnpj']) ? tiraEspecias($_GET['cnpj']) : '';
$id_tipo_sistema = isset($_GET['tipo_sistema']) ? $_GET['tipo_sistema'] : '';
$id_codigo_licenca = isset($_GET['codigo_licenca']) ? $_GET['codigo_licenca'] : '';
$serie = isset($_GET['serie']) ? $_GET['serie'] : '';
$senha = isset($_GET['senha']) ? $_GET['senha'] : '';
$vencimento = isset($_GET['dt_venc']) ? tiraEspecias($_GET['dt_venc']) : '';

?>
<div class="page-header">
    <h3></h3>
</div>
<div class="row">
    <div class="col-md-9 col-md-offset-1">
        <div class="well well-sm">
            <form class="form-horizontal" action="gravaLicencas.php" method="post" novalidate>
                <fieldset>
                    <legend class="text-center">Cadastrar Licença</legend>
                    
                    <!-- PRIMEIRA LINHA -->
                    <div class="form-group" style="padding-left: 50px;">                        
                        <div class="col-md-3" style="width: 220px;">   
                            <label class="control-label" style="font-size: 12px; padding-bottom: 2px; padding-left: 5px;">Cnpj:</label>
                            <input id="cnpj" name="cnpj" type="text" class="form-control" maxlength="18" required autofocus="true" 
                                   value="<?php echo!empty($_GET['cnpj']) ? mask($cnpj, '##.###.###/####-##') : '' ?>" 
                                   onkeydown="autoTab(this, event);" onkeypress="return event.charCode >= 48 && event.charCode <= 57 && mascaraCnpj(this)"
                                   style="width: 190px;">
                        </div>                      
                        <div class="col-md-3" style="width: 240px;">
                            <label class="control-label" style="font-size: 12px; padding-bottom: 2px; padding-left: 5px;">Tipo Sistema:</label>
                            <select class="form-control" name="tipo_sistema" onkeydown="autoTab(this, event);">
                                <option value="0">Selecione...</option>
                                <?php while ($cb_tipo_sistema = mysqli_fetch_assoc($res_tipo_sistema)): ?>
                                    <option value="<?php echo $cb_tipo_sistema['id']; ?>" <?php echo ($cb_tipo_sistema['id'] == $id_tipo_sistema) ? "selected='selected'" : ''; ?>>
                                        <?php echo $cb_tipo_sistema['sistema']; ?>
                                    </option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="col-md-3" style="width: 290px;">
                            <label class="control-label" style="font-size: 12px; padding-bottom: 2px; padding-left: 5px;">Codigo Licenca:</label>
                            <select class="form-control" name="codigo_licenca" onkeydown="autoTab(this, event);" >
                                <option value="0">Selecione...</option>
                                <?php while ($cb_codigo_licenca = mysqli_fetch_assoc($res_codigo_licenca)): ?>
                                    <option value="<?php echo $cb_codigo_licenca['id']; ?>" <?php echo ($cb_codigo_licenca['id'] == $id_codigo_licenca) ? "selected='selected'" : ''; ?>>
                                        <?php echo "Codigo " . $cb_codigo_licenca['codigo'] . " - " . $cb_codigo_licenca['descricao']; ?>
                                    </option>
                                <?php endwhile; ?>
                            </select>
                        </div>                          
                    </div>
                    <!-- PROXIMA LINHA -->
                    <div class="form-group" style="padding-left: 50px;">                        
                        <div class="col-md-8" style="width: 460px;">
                            <label class="control-label" style="font-size: 12px; padding-bottom: 2px; padding-left: 5px;">Senha:</label>
                            <input id="senha" name="senha" type="text" maxlength="22" value="<?php echo!empty($_GET['senha']) ? $_GET['senha'] : '' ?>" placeholder="Senha" class="form-control" 
                                   onkeydown="autoTab(this, event);"  required>
                        </div>  
                        <div class="col-md-3" style="width: 110px;">
                            <label class="control-label" style="font-size: 12px; padding-bottom: 2px; padding-left: 5px;">Série:</label>
                            <input id="serie" name="serie" type="text" maxlength="3" value="<?php echo!empty($_GET['serie']) ? $_GET['serie'] : '' ?>" placeholder="Série" class="form-control" 
                                   onkeydown="autoTab(this, event);" onkeypress="return event.charCode >= 48 && event.charCode <= 57" required>
                        </div>
                        <div class="col-md-3" style="width: 180px;">     
                            <label class="control-label" style="font-size: 12px; padding-bottom: 2px; padding-left: 5px;">Vencimento:</label>
                            <input id="dt_venc" name="dt_venc" type="text" class="form-control" maxlength="10" required
                                   value="<?php echo!empty($_GET['dt_venc']) ? mask($vencimento, '##/##/####') : $vencimento ?>" 
                                   onkeydown="autoTab(this, event);" onkeypress="return event.charCode >= 48 && event.charCode <= 57 && mascaraData(this)" 
                                   style="width: 150px;">
                        </div>
                    </div>
                    <!-- PROXIMA LINHA -->
                    <div class="form-group" style="padding-left: 50px;">
                        <div class="col-md-11 text-right" style="width: 750px; padding-top: 15px;">
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
                            Licença gravada com sucesso.
                        </div>
                    <?php endif; ?>
                    <?php
                    //RETORNA VALIDAÇÃO DA SERIE
                    $erro = isset($_GET['erro']) ? $_GET['erro'] : '';
                    if (isset($_GET['erro']) && isset($_GET['serie'])) {
                        if ($_GET['serie'] == 0) {
                            $erroSerie = '<b>>>></b>  O número de série não pode ser igual a <b>zero</b>! ';
                        } else {
                            $erroSerie = '';
                        }
                    }
                    //RETORNA VALIDAÇÃO DA DATA
                    if (isset($_GET['erro']) && isset($_GET['erroData'])) {
                        switch ($_GET['erroData']){
                            case 1:
                                $erroData = '<b>>>></b> Data inválida! ';
                                break;
                            case 2:
                                $erroData = '<b>>>></b> A data de vencimento deve ser maior que a data atual! ';
                                break;
                            default:
                                $erroData = '';
                        }                        
                    }

                    if ($erro):
                        ?>
                        <div class="alert alert-danger" role="alert">
                            <strong>Erro!</strong>
                            Verifique o formulario: 
                            <?php
                            echo $erroSerie;
                            echo $erroData;
                            ?>  
                        </div>
                    <?php endif; ?>
                    <?php
                    $erroSenha = isset($_GET['erroSenha']) ? $_GET['erroSenha'] : '';
                    if ($erroSenha):
                        ?>
                        <div class="alert alert-danger" role="alert">
                            <strong>Atenção!</strong>
                            Esta senha já foi utilizada!
                        </div>
                    <?php endif; ?>
                </fieldset>
            </form>
        </div>
    </div>
</div>