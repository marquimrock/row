<?php
$get = isset($_GET['pagina']) ? $_GET['pagina'] : '';

require 'banco/conexao.php';
require 'lib/funcs.php';
require 'template/header.php';
require 'template/menu.php';
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