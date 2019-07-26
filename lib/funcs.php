<?php

function rotas($pagina) {
    //relatorio_licencas possui 18 caracteres, se estiver maior, é pq possui paginaçao
    if ((substr($pagina, 0, 18) == 'relatorio_licencas') && strlen($pagina) > 18) {
        require 'paginas/relatorio_licencas.php';
    } else if ((substr($pagina, 0, 9) == "relatorio") && (strlen($pagina) > 9) && (strlen($pagina) < 18)) {
        require 'paginas/relatorio.php';
    } else if ((substr($pagina, 0, 13) == 'licencas_full') && (strlen($pagina) > 13)){
        require 'paginas/licencas_full.php';
    } else if ((substr($pagina, 0, 18) == 'relatorio_usuarios') && (strlen($pagina) > 18)){
        require 'paginas/relatorio_usuarios.php';
    } else if ((substr($pagina, 0, 13) == 'relatorio_chamados') && (strlen($pagina) > 13)){
        require 'paginas/relatorio_chamados.php';
    } else {
        switch ($pagina) {
            case 'clientes':
            require 'paginas/clientes.php';
            break;
            case 'licencas':
            require 'paginas/licencas.php';
            break;
            case 'chamados':
            require 'paginas/chamados.php';
            break;
            case 'relatorio':
            require 'paginas/relatorio.php';
            break;
            case 'relatorio_usuarios':
            require 'paginas/relatorio_usuarios.php';
            break;
            case 'relatorio_licencas':
            require 'paginas/relatorio_licencas.php';
            break;
            case 'relatorio_chamados':
            require 'paginas/relatorio_chamados.php';
            break;
            case 'usuarios':
            require 'paginas/usuarios.php';
            break;
            case 'licencas_full':
            require 'paginas/licencas_full.php';
            break;
            default:
            require 'paginas/home.php';
        }
    }
}

function active($pagina, $link = '') {
    if ($pagina == $link) {
        return 'class="active"';
    }
    return '';
}

function conecta() {
    return mysqli_connect(HOST, USER, PASS, BANCO);
}

function formata_reais($valor) {
    return 'R$ ' . number_format($valor, 2, ',', '.');
}

function tiraEspecias($valor) {
    $valor = trim($valor);
    $valor = str_replace(".", "", $valor);
    $valor = str_replace(",", "", $valor);
    $valor = str_replace("-", "", $valor);
    $valor = str_replace("/", "", $valor);
    $valor = str_replace("(", "", $valor);
    $valor = str_replace(")", "", $valor);
    $valor = str_replace(" ", "", $valor);
    $valor = str_replace("'", "", $valor);
    return $valor;
}

function mask($val, $mask) {
    $maskared = '';
    $k = 0;
    for ($i = 0; $i <= strlen($mask) - 1; $i++) {
        if ($mask[$i] == '#') {
            if (isset($val[$k]))
                $maskared .= $val[$k++];
        } else {
          if (isset($mask[$i]))
            $maskared .= $mask[$i];
    }
}
return $maskared;
}

function verificaData($digData) {
    $bissexto = 0;
    $data = $digData;
    $tam = strlen($data);

    if ($tam == 10) {
        $dia = substr($data, 0, 2); 
        $mes = substr($data, 3, 2);
        $ano = substr($data, 6, 4);
        if (($ano > 1900) || ($ano < 2100)) {
            switch ($mes) {
                case '01':
                case '03':
                case '05':
                case '07':
                case '08':
                case '10':
                case '12':
                if ($dia <= 31) {
                    return true;
                }
                break;
                case '04':
                case '06':
                case '09':
                case '11':
                if ($dia <= 30) {
                    return true;
                }
                break;
                case '02':
                /* Validando ano Bissexto / fevereiro / dia */
                if (($ano % 4 == 0) || ($ano % 100 == 0) || ($ano % 400 == 0)) {
                    $bissexto = 1;
                }
                if (($bissexto == 1) && ($dia <= 29)) {
                    return true;
                }
                if (($bissexto != 1) && ($dia <= 28)) {
                    return true;
                }
                break;
            }
        }
    }
    echo "A Data " . $data . " é inválida!";
    return false;
}
