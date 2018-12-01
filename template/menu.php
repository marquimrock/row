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
            <a class="navbar-brand" href="index.php"><img src="imagens/logo_pequena.png"></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li <?php echo active($get); ?>><a href="index.php">Home</a></li>
                <li <?php echo active($get, 'clientes'); ?>><a href="?pagina=clientes">Clientes</a></li>
                <li <?php echo active($get, 'licencas'); ?>><a href="?pagina=licencas">Licencas</a></li>
                <li <?php echo active($get, 'relatorio'); ?>><a href="?pagina=relatorio">Relatório</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>