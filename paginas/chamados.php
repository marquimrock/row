<?php
require 'login/verifica_login.php';
require 'model/clientes_bo.php';
require 'model/chamados_bo.php';
require 'model/usuarios_bo.php';
$usuario = $_SESSION['usuario'];
$edicao = false;
$id='';


// -------------------------------------------------------------------
// PREENCHE OS CAMPOS CONFORME O CLIENTE SELECIONADO NO RELATORIO PARA EDIÇÃO 
// -------------------------------------------------------------------

if (!empty($_GET['id'])) {
   
   $id = $_GET['id'];
   $result = buscaChamadosPorId($id);
   $edicao = true;
   while ($chamado = mysqli_fetch_assoc($result)) {
        $solicitante = $chamado['solicitante'];
        $ocorrencia = $chamado['ocorrencia'];
    }

}   
    /*
    while ($chamado= mysqli_fetch_assoc($result)):
        $id = $chamado['id'];
    endwhile;
}
 
    $cnpj = $_GET['cnpj'];
    $cnpj = tiraEspecias($cnpj);
    $result = buscaClientesPorCNPJ($cnpj);
    while ($cliente = mysqli_fetch_assoc($result)):
        $id = $cliente['id'];
        $razao_social = $cliente['razao_social'];
        $inscricao_estadual = $cliente['inscricao_estadual'];
        $nome_fantasia = $cliente['nome_fantasia'];
        $cep = tiraEspecias($cliente['cep']);
        $logradouro = $cliente['logradouro'];
        $numero = $cliente['numero'];
        $bairro = $cliente['bairro'];
        $id_cidade = $cliente['id_cidade'];
        $id_uf = $cliente['id_uf'];
        $telefone = tiraEspecias($cliente['telefone']);
        $celular1 = tiraEspecias($cliente['celular1']);
        $celular2 = tiraEspecias($cliente['celular2']);
        $email = $cliente['email'];
        $qnt_pdv = $cliente['qnt_pdv'];
    endwhile;
     
}
*/

// -------------------------------------------------------------------
// MANTEM OS CAMPOS PREENCHIDOS DURANTE O RETORNO DE ERRO DE VALIDAÇÕES
// -------------------------------------------------------------------
$cnpj = isset($_GET['cnpj']) ? $_GET['cnpj'] : '';
$razao_social = isset($_GET['razao_social']) ? $_GET['razao_social'] : '';
$inscricao_estadual = isset($_GET['inscricao_estadual']) ? $_GET['inscricao_estadual'] : '';
$nome_fantasia = isset($_GET['nome_fantasia']) ? $_GET['nome_fantasia'] : '';
$cep = isset($_GET['cep']) ? tiraEspecias($_GET['cep']) : '';
$logradouro = isset($_GET['logradouro']) ? $_GET['logradouro'] : '';
$numero = isset($_GET['numero']) ? $_GET['numero'] : '';
$bairro = isset($_GET['bairro']) ? $_GET['bairro'] : '';
$id_cliente = isset($_GET['cliente']) ? $_GET['cliente'] : '';
$id_uf = isset($_GET['uf']) ? $_GET['uf'] : '';
$telefone = isset($_GET['telefone']) ? $_GET['telefone'] : '';
$celular1 = isset($_GET['celular1']) ? $_GET['celular1'] : '';
$celular2 = isset($_GET['celular2']) ? $_GET['celular2'] : '';
$email = isset($_GET['email']) ? $_GET['email'] : '';
$qnt_pdv = isset($_GET['qnt_pdv']) ? $_GET['qnt_pdv'] : '';
?>

<div class="page-header">
    <h3></h3>
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
                              <label class="control-label" style="font-size: 12px; padding-bottom: 2px; padding-left: 5px;"><?php echo date('d/m/y') . '<br />';?></label>
                        </div>  
                        <div class="col-md-3" style="width: 140px;">
                            <label class="control-label" style="font-size: 12px; padding-bottom: 2px; padding-left: 5px;">Hora:</label>
                              <label class="control-label" style="font-size: 12px; padding-bottom: 2px; padding-left: 5px;"><?php echo date('h:i:s');?></label>
                        </div> 
                        <div class="col-md-3" style="width: 140px;">
                            <label class="control-label" style="font-size: 12px; padding-bottom: 2px; padding-left: 5px;">Usuario:</label>
                              <label class="control-label" style="font-size: 12px; padding-bottom: 2px; padding-left: 5px;"><?php echo $usuario;?></label>
                        </div>                        
                    </div>  
                        
                    <!-- PROXIMA LINHA -->
                    <div class="form-group" style="padding-left: 50px;"> 
                        <?php
                        $res = buscaTodosClientes();
                        ?>
                        <div class="col-md-5" style="width: 520px;">
                            <label class="control-label" style="font-size: 12px; padding-bottom: 2px; padding-left: 5px;">Razão Social:</label>
                            <select class="form-control" id="cb_cliente" name="cb_cliente" onkeydown="autoTab(this, event);" style="width: 490px;">
                                <option value="0">Selecione...</option>
                                <?php while ($cb_cliente = mysqli_fetch_assoc($res)): ?>
                                    <option value="<?php echo $cb_cliente['id']; ?>" <?php echo ($cb_cliente['id'] == $id_cliente) ? "selected='selected'" : ''; ?>><?php echo $cb_cliente['razao_social']; ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                            <div class="col-md-3" style="width: 220px;">   
                                <label class="control-label" style="font-size: 12px; padding-bottom: 2px; padding-left: 5px;">Solicitante:</label>
                                <input id="solicitante" name="solicitante" type="text" class="form-control" maxlength="50" required 
                                       value="<?php echo!empty($solicitante) ? $solicitante : ''; ?>" <?php echo empty($edicao) ? 'false': 'readonly' ?> 
                                       onkeyup="maiuscula(this)" onkeydown="autoTab(this, event);" style="width: 190px;">
                            </div> 
                            <div class="col-md-8">   
                                <label class="control-label" style="font-size: 12px; padding-bottom: 2px; padding-left: 5px;">Ocorrencia:</label>
                                <input id="ocorrencia" name="ocorrencia" type="text" class="form-control" required 
                                        value="<?php echo!empty($ocorrencia) ? $ocorrencia : ''; ?>"
                                        <?php echo empty($edicao) ? 'false': 'readonly' ?>
                                         onkeyup="maiuscula(this)" onkeydown="autoTab(this, event);" style="width: 710px;">
                            </div>

                            <div class="col-md-8" style="<?php echo empty($edicao) ? 'visibility: hidden': '' ;?>">   
                                <label class="control-label" style="font-size: 12px; padding-bottom: 2px; padding-left: 5px;">Solução:</label>
                                <input id="solucao" name="solucao" type="text" class="form-control" required 
                                         onkeyup="maiuscula(this)" onkeydown="autoTab(this, event);" style="width: 710px;" />
                                         <br />
                            </div>

                    <!-- BOTÕES -->
                    <div class="form-group" style="padding-left: 15px;">
                        <div class="col-md-8">
                            <button type="button" onclick = redireciona(<?php echo!empty($id) ? $id : '' ?>); class="btn btn-primary btn-primary">Gravar</button>                            
                            <button type="button"onClick="history.go(-1)"class="btn btn-primary btn-info">Voltar</button>
                        </div>
                    </div>

                    <?php
                    // -------------------------------------------------------------------
                    // MENSAGENS DE SUCESSO
                    // -------------------------------------------------------------------
                    if (isset($_GET['sucesso']) ? $_GET['sucesso'] : ''):
                        ?>
                        <div class="alert alert-success" role="alert">                            
                            Cliente gravado com <strong>Sucesso!</strong>.
                        </div>
                    <?php endif; ?>
                    <?php
                    // -------------------------------------------------------------------
                    // MENSAGENS DE ERRO
                    // -------------------------------------------------------------------
                    $msgNumPdv = 'O número de PDVs não pode ser igual a <b>zero</b>!';
                    $msgCliente = 'Já existe um cliente cadastrado com esse cnpj!';

                    if (isset($_GET['erro']) ? $_GET['erro'] : ''):
                        ?>
                        <div class="alert alert-danger" role="alert">
                            <strong>Atenção!</strong>                               
                            <?php echo (!isset($_GET['cliente'])) ? 'Preencha todo o formulário' : ''; ?> 
                            <?php echo (isset($_GET['qnt_pdv']) && $_GET['qnt_pdv'] == 0 && strlen($_GET['qnt_pdv']) > 0) ? $msgNumPdv : ''; ?> 
                            <?php echo (isset($_GET['cliente']) && $_GET['cliente'] == 'encontrado') ? $msgCliente : ''; ?> 
                        </div>
                    <?php endif; ?>

                </fieldset>
            </form>
        </div>
    </div>
</div>
