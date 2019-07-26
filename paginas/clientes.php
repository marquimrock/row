<?php
require 'login/verifica_login.php';
require 'model/clientes_bo.php';

// -------------------------------------------------------------------
// PREENCHE OS CAMPOS CONFORME O CLIENTE SELECIONADO NO RELATORIO PARA EDIÇÃO 
// -------------------------------------------------------------------
if (!empty($_GET['cnpj'])) {    
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
$id_cidade = isset($_GET['cidade']) ? $_GET['cidade'] : '';
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
            <form id="frm_teste"class="form-horizontal" action="gravaClientes.php" method="POST" novalidate>
                <fieldset>
                    <legend class="text-center"><?php echo!empty($id) ? 'Editar Cliente' : 'Cadastrar Cliente'; ?></legend>

                    <!-- PRIMEIRA LINHA -->
                    <div class="form-group" style="padding-left: 50px;">  
                        <div class="col-md-3" style="width: 220px;">   
                            <label class="control-label" style="font-size: 12px; padding-bottom: 2px; padding-left: 5px;">Cnpj:</label>
                            <input id="cnpj" name="cnpj" type="text" class="form-control" maxlength="18" required autofocus="true" 
                                   value="<?php echo!empty($_GET['cnpj']) ? mask($cnpj, '##.###.###/####-##') : ''; ?>"
                                   onkeydown="autoTab(this, event);" onkeypress='return event.charCode >= 48 && event.charCode <= 57 && mascaraCnpj(this)' 
                                   style="width: 190px;">
                        </div> 
                        <div class="col-md-8">    
                            <label class="control-label" style="font-size: 12px; padding-bottom: 2px; padding-left: 5px;">Razão Social:</label>
                            <input  id="razao_social" name="razao_social" type="text" class="form-control" maxlength="50" required
                                    value="<?php echo!empty($_GET['razao_social']) ? $razao_social : ''; ?>"
                                    onkeydown="autoTab(this, event);" onkeyup="maiuscula(this)" 
                                    style="width: 510px;">
                        </div> 
                    </div>
                    <!-- PROXIMA LINHA -->
                    <div class="form-group" style="padding-left: 50px;">
                        <div class="col-md-3" style="width: 220px;">   
                            <label class="control-label" style="font-size: 12px; padding-bottom: 2px; padding-left: 5px;">Inscrição Estadual:</label>
                            <input id="inscricao_estadual" name="inscricao_estadual" type="text" class="form-control" maxlength="12" required
                                   value="<?php echo!empty($_GET['inscricao_estadual']) ? mask($inscricao_estadual, '##.###.###-#') : ''; ?>" 
                                   onkeydown="autoTab(this, event);" onkeypress='return event.charCode >= 48 && event.charCode <= 57 && mascaraInscricaoEstadual(this)'  
                                   style="width: 190px;">
                        </div> 
                        <div class="col-md-8">   
                            <label class="control-label" style="font-size: 12px; padding-bottom: 2px; padding-left: 5px;">Nome Fantasia:</label>
                            <input id="nome_fantasia" name="nome_fantasia" type="text" class="form-control" maxlength="50" required 
                                   value="<?php echo!empty($_GET['nome_fantasia']) ? $nome_fantasia : ''; ?>"
                                   onkeydown="autoTab(this, event);" onkeyup="maiuscula(this)" 
                                   style="width: 510px;">
                        </div>                        
                    </div>
                    <!-- PROXIMA LINHA -->
                    <div class="form-group" style="padding-left: 50px;">                 
                        <div class="col-md-3" style="width: 140px;">
                            <label class="control-label" style="font-size: 12px; padding-bottom: 2px; padding-left: 5px;">Cep:</label>
                            <input id="cep" name="cep" type="text" class="form-control" maxlength="10" required
                                   value="<?php echo!empty($_GET['cep']) ? mask($cep, '##.###-###') : ''; ?>"
                                   onkeydown="autoTab(this, event);" onkeypress='return event.charCode >= 48 && event.charCode <= 57 && mascaraCep(this)' 
                                   style="width: 110px;">
                        </div>  
                        <div class="col-md-3" style="width: 510px;">
                            <label class="control-label" style="font-size: 12px; padding-bottom: 2px; padding-left: 5px;">Logradouro:</label>
                            <input id="logradouro" name="logradouro" type="text" class="form-control" maxlength="45" required
                                   value="<?php echo!empty($_GET['logradouro']) ? $logradouro : ''; ?>"
                                   onkeydown="autoTab(this, event);" onkeyup="maiuscula(this)" 
                                   style="width: 480px;">
                        </div> 
                        <div class="col-md-3" style="width: 110px;">
                            <label class="control-label" style="font-size: 12px; padding-bottom: 2px; padding-left: 5px;">Nº:</label>
                            <input id="numero" name="numero" type="text" class="form-control" maxlength="4" required
                                   value="<?php echo!empty($_GET['numero']) ? $numero : ''; ?>" 
                                   onkeydown="autoTab(this, event);" onkeypress='return event.charCode >= 48 && event.charCode <= 57' 
                                   style="width: 80px;">
                        </div>
                    </div>                            
                    <!-- PROXIMA LINHA -->
                    <div class="form-group" style="padding-left: 50px;">
                        <?php
                        $res_uf = buscaUf();
                        ?>
                        <div class="col-md-3" style="width: 110px;">
                            <label class="control-label" style="font-size: 12px; padding-bottom: 2px; padding-left: 5px;">Uf:</label>
                            <select class="form-control" id="uf" name="uf" onkeydown="autoTab(this, event);" style="width: 80px;">
                                <option value="0">...</option>
                                <?php while ($cb_uf = mysqli_fetch_assoc($res_uf)): ?>
                                <option value="<?php echo $cb_uf['id']; ?>" <?php echo ($cb_uf['id'] == $id_uf) ? "selected='selected'" : ''; ?>><?php echo $cb_uf['uf']; ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <?php
                        $res_cidade = buscaCidade();
                        ?>
                        <div class="col-md-3" style="width: 320px;">
                            <label class="control-label" style="font-size: 12px; padding-bottom: 2px; padding-left: 5px;">Cidade:</label>
                            <select class="form-control" id="cidade" name="cidade" onkeydown="autoTab(this, event);" style="width: 290px;">
                                <option value="0">Selecione...</option>
                                <?php while ($cb_cidade = mysqli_fetch_assoc($res_cidade)): ?>
                                    <option value="<?php echo $cb_cidade['id']; ?>" <?php echo ($cb_cidade['id'] == $id_cidade) ? "selected='selected'" : ''; ?>><?php echo $cb_cidade['nome']; ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div> 
                        <div class="col-md-3" style="width: 330px;">
                            <label class="control-label" style="font-size: 12px; padding-bottom: 2px; padding-left: 5px;">Bairro:</label>
                            <input id="bairro" name="bairro" type="text" class="form-control" maxlength="25" required
                                   value="<?php echo!empty($_GET['bairro']) ? $bairro : ''; ?>"
                                   onkeydown="autoTab(this, event);" onkeyup="maiuscula(this)" echo 
                                   style="width: 300px;">
                        </div> 
                    </div>
                    <!-- PROXIMA LINHA -->
                    <div class="form-group" style="padding-left: 50px;">                         
                        <div class="col-md-3" style="width: 200px;"> 
                            <label class="control-label" style="font-size: 12px; padding-bottom: 2px; padding-left: 5px;">Telefone:</label>
                            <input id="telefone" name="telefone" type="text" class="form-control" maxlength="15" required
                                   value="<?php echo!empty($_GET['telefone']) ? mask($telefone, '(##) #### - ####') : ''; ?>" 
                                   onkeydown="autoTab(this, event);" onkeypress="mascaraTelefone(this)" 
                                   style="width: 170px;">
                        </div>
                        <div class="col-md-3" style="width: 200px;"> 
                            <label class="control-label" style="font-size: 12px; padding-bottom: 2px; padding-left: 5px;">Celular 1:</label>
                            <input id="celular1" name="celular1" type="text" class="form-control" maxlength="15" required  
                                   value="<?php echo!empty($_GET['celular1']) ? mask($celular1, '(##) ##### - ####') : ''; ?>"
                                   onkeydown="autoTab(this, event);" onkeypress="mascaraCelular(this)" 
                                   style="width: 170px;">
                        </div>
                        <div class="col-md-3" style="width: 200px;"> 
                            <label class="control-label" style="font-size: 12px; padding-bottom: 2px; padding-left: 5px;"><img src="./imagens/whatsapp.png" style="width: 17px; height: 17px;"> Whatsapp:</label>
                            <input id="celular2" name="celular2" type="text" class="form-control" maxlength="15" required
                                   value="<?php echo!empty($_GET['celular2']) ? mask($celular2, '(##) ##### - ####') : ''; ?>"
                                   onkeydown="autoTab(this, event);" onkeypress="mascaraCelular(this)" 
                                   style="width: 170px;">
                        </div>
                        <div class="col-md-2" style="width: 160px;"> 
                            <label class="control-label" style="font-size: 12px; padding-bottom: 2px; padding-left: 5px;">Quantidade PDVs:</label>
                            <input id="qnt_pdv" name="qnt_pdv" type="text" class="form-control" maxlength="3" required
                                   value="<?php echo!empty($_GET['qnt_pdv']) ? $qnt_pdv : ''; ?>" 
                                   onkeydown="autoTab(this, event);" onkeypress='return event.charCode >= 48 && event.charCode <= 57' 
                                   style="width: 130px;">
                        </div>                        
                    </div>                    
                    <!-- PROXIMA LINHA -->
                    <div class="form-group" style="padding-left: 50px;"> 
                        <div class="col-md-12" style="width: 140px;"> 
                            <label class="control-label" style="font-size: 12px; padding-bottom: 2px; padding-left: 5px;">E-mail:</label>
                            <input id="email" name="email" type="text" class="form-control" maxlength="50" required
                                   value="<?php echo!empty($_GET['email']) ? $email : ''; ?>"
                                   onkeydown="autoTab(this, event);" onkeyup="minuscula(this)" 
                                   style="width: 370px;">
                        </div>                        
                    </div>
                    <!-- PROXIMA LINHA -->
                    <div class="form-group" style="padding-left: 50px;">
                        <div class="col-md-11 text-right" style="width: 750px; padding-top: 15px;">
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