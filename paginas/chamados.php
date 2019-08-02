<?php
require 'login/verifica_login.php';
require 'model/clientes_bo.php';
require 'model/chamados_bo.php';
require 'model/usuarios_bo.php';
$usuario = $_SESSION['usuario'];
$edicao = false;
$id='';
$status = '';

// -------------------------------------------------------------------
// PREENCHE OS CAMPOS CONFORME O CLIENTE SELECIONADO NO RELATORIO PARA EDIÇÃO 
// -------------------------------------------------------------------

if (!empty($_GET['id'])) {

   $id = $_GET['id'];
   $edicao = true;
   
   $result = buscaChamadosPorId($id);
   $edicao = true;
   while ($chamado = mysqli_fetch_assoc($result)) {
        $data_abertura = $chamado['data_abertura'];
        $hora_abertura = $chamado['hora_abertura'];
        $id_cliente = $chamado['id_cliente'];
        $solicitante = $chamado['solicitante'];
        $ocorrencia = $chamado['ocorrencia'];
    }
    $data_abertura = date('d/m/y', strtotime($data_abertura));
    $hora_abertura = date('H:m' , strtotime($hora_abertura));
}   

// -------------------------------------------------------------------
// MANTEM OS CAMPOS PREENCHIDOS DURANTE O RETORNO DE ERRO DE VALIDAÇÕES
// -------------------------------------------------------------------
//$solicitante = isset($_GET['solicitante']) ? $_GET['solicitante'] : '';
//$nome_fantasia = isset($_GET['nome_fantasia']) ? $_GET['nome_fantasia'] : '';
//$id_cliente = isset($_GET['cliente']) ? $_GET['cliente'] : '';
?>

<div class="page-header">
    <h3></h3>
    <?php 
    $res = buscaTodosClientes();
    while ($cb_cliente = mysqli_fetch_assoc($res)):
    endwhile
    ?>
</div>
<div class="row">
    <div class="col-md-9 col-md-offset-1">
        <div class="well well-sm">
            <form id="frm_teste"class="form-horizontal" action="gravaChamado.php" method="POST" novalidate>
                <fieldset>
                    <legend class="text-center"><?php echo!empty($id) ? 'Editar Chamado' : 'Adicionar Chamado'; ?></legend>
                    <!-- PRIMEIRA LINHA -->

                    <div class="form-group" style="padding-left: 50px;">                 
                        <div class="col-md-3" style="width: 140px;">
                            <label class="control-label" style="font-size: 12px; padding-bottom: 2px; padding-left: 5px;">Data:</label>
                              <label class="control-label" style="font-size: 12px; padding-bottom: 2px; padding-left: 5px;"><?php  echo date('d/m/y') . '<br />';?></label>
                        </div>  
                        <div class="col-md-3" style="width: 140px;">
                            <label class="control-label" style="font-size: 12px; padding-bottom: 2px; padding-left: 5px;">Hora:</label>
                              <label class="control-label" style="font-size: 12px; padding-bottom: 2px; padding-left: 5px;"><?php echo date('h:i:s');?></label>
                        </div> 
                        <div class="col-md-3" style="width: 140px;">
                            <label class="control-label" style="font-size: 12px; padding-bottom: 2px; padding-left: 5px;">Usuario:</label>
                              <label class="control-label" style="font-size: 12px; padding-bottom: 2px; padding-left: 5px;"><?php echo $usuario;?></label>
                        </div>
                        <div class="col-md-3" style="width: 140px;">
                            <label class="control-label" style="font-size: 12px; padding-bottom: 2px; padding-left: 5px;">Status:</label> 
                            <label class="control-label" style="font-size: 12px; padding-bottom: 2px; padding-left: 5px;" value="status" name="status" id="status"><?php echo empty($id) ? $status =  'Novo' : $Status ='Edição';?></label>
                        </div>  
                          
                    </div>
                        
                    <!-- PROXIMA LINHA -->
                    <div class="form-group" style="padding-left: 50px;"> 
                        <?php
                        $res = buscaTodosClientes();
                        ?>
                        <div class="col-md-5" style="width: 520px;">
                            <label class="control-label" style="font-size: 12px; padding-bottom: 2px; padding-left: 5px;">Razão Social:</label>
                            <select class="form-control" id="cb_cliente" name="cb_cliente" onkeydown="autoTab(this, event);" style="width: 490px;" 
                             >
                                <option value="0">Selecione...</option>
                                <?php while ($cb_cliente = mysqli_fetch_assoc($res)): ?>
                                    <option 
                                    value="<?php echo $cb_cliente['id']; ?>" 
                                <?php echo !empty($edicao) ? 'selected': '' ?>>
                                    <?php echo $cb_cliente['razao_social']; ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>

                         
                            <div class="col-md-3" style="width: 220px;">   
                                <label class="control-label" style="font-size: 12px; padding-bottom: 2px; padding-left: 5px;">Solicitante:</label>
                                <input id="solicitante" name="solicitante" type="text" class="form-control" maxlength="20" required 
                                       value="<?php echo!empty($solicitante) ? $solicitante : ''; ?>" <?php echo empty($edicao) ? 'false': 'readonly' ?> 
                                       onkeyup="maiuscula(this)" onkeydown="autoTab(this, event);" style="width: 190px;">
                            </div> 
                            <div class="col-md-8">   
                                <label class="control-label" style="font-size: 12px; padding-bottom: 2px; padding-left: 5px;">Ocorrência:</label>
                                <input id="ocorrencia" name="ocorrencia" type="text" class="form-control" required maxlength="200"
                                        value="<?php echo!empty($ocorrencia) ? $ocorrencia : ''; ?>"
                                        <?php echo empty($edicao) ? 'false': 'readonly' ?>
                                         onkeyup="maiuscula(this)" onkeydown="autoTab(this, event);" style="width: 710px;">
                            </div>

                            <div class="col-md-8" style="<?php echo empty($edicao) ? 'visibility: hidden': '' ;?>">   
                                <label class="control-label" style="font-size: 12px; padding-bottom: 2px; padding-left: 5px;">Solução:</label>
                                <input id="solucao" name="solucao" type="text" class="form-control" required 
                                         onkeyup="maiuscula(this)" onkeydown="autoTab(this, event);" style="width: 710px;" <?php echo empty($edicao) ? 'false': 'autofocus' ?> />
                                         <br />
                            </div>

                    <!-- BOTÕES -->
                    <div class="form-group" style="padding-left: 15px;">
                        <div class="col-md-8">
                            <button type="button" onclick = redireciona(<?php echo!empty($id) ? $id : '' ?>); class="btn btn-primary btn-primary">Gravar</button>                            
                            <button type="button"onClick="history.go(-1)"class="btn btn-primary btn-info">Voltar</button>
                        </div>
                    </div>
                </fieldset>
                 <?php
                    // -------------------------------------------------------------------
                    // MENSAGENS DE SUCESSO
                    // -------------------------------------------------------------------
                    if (isset($_GET['sucesso']) ? $_GET['sucesso'] : ''):
                        ?>
                        <div class="alert alert-success" role="alert">                            
                            Chamado gravado com <strong>Sucesso!</strong>.
                        </div>
                    <?php endif; ?>
                    <?php
                    // -------------------------------------------------------------------
                    // MENSAGENS DE ERRO
                    // -------------------------------------------------------------------
                    if (isset($_GET['erro']) ? $_GET['erro'] : ''):
                        ?>
                        <div class="alert alert-danger" role="alert">
                            <strong>Atenção!</strong>                               
                            <?php echo (!empty($_GET['solicitante'])) ?  '' :  'preencha o formulario'; ?>
                            <?php echo (!empty($_GET['ocorrencia'])) ?  '' :  'preencha o formulario'; ?>
                        </div>
                    <?php endif; ?>
            </form>
        </div>
    </div>
</div>
*/