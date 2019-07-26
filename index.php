<?php
session_start();
require 'login/verifica_login.php';
$get = isset($_GET['pagina']) ? $_GET['pagina'] : '';

require 'banco/conexao.php';
require 'lib/funcs.php';
require 'template/header.php';
require 'template/menu.php';
require 'lib/funcsJS.php';
?>
<div class="container">
    <?php
    //direciona a pagina desejada...
    rotas($get);
    ?> 
</div> <!-- /container -->
<?php
require 'template/footer.php';
?>