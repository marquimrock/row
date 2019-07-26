<?php
$acesso = $_SESSION['acesso'];
if ($acesso==0){$acesso = null;}
?>
<!-- Fixed navbar -->
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Navegação</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php"><img src="imagens/logo_pequena2.png"></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li <?php echo active($get); ?>><a href="index.php">Home</a></li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Cadastros<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="?pagina=clientes">Clientes</a></li>
                        <li style="display: <?php echo empty($acesso) ? 'none' : 'show'; ?>"><a href="?pagina=licencas">Licenças</a></li>
                        <li style="display: <?php echo empty($acesso) ? 'none' : 'show'; ?>"><a href="?pagina=usuarios">Usuários</a></li>
                    </ul>
                </li>
                <li><a href="?pagina=chamados">Chamados</a></li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Relatórios<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="?pagina=relatorio">Clientes</a></li>
                        <li><a href="?pagina=relatorio_chamados">Chamados</a></li>
                        <li><a href="?pagina=licencas_full">Licenças</a></li>
			<li style="display: <?php echo empty($acesso) ? 'none' : 'show'; ?>"><a href="?pagina=relatorio_usuarios">Usuários</a></li>
                    </ul>
                </li>
                <li><a href="login/logout.php">Sair</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>