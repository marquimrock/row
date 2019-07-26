<script language="JavaScript" type="text/javascript">
    function autoTab(input, e)  {
          var ind = 0;
          var isNN = (navigator.appName.indexOf("Netscape") != -1);
          var keyCode = (isNN) ? e.which : e.keyCode;
          var nKeyCode = e.keyCode;
          if (keyCode == 13) {
                if (!isNN) {
                window.event.keyCode = 0;
            } // evitar o beep
                ind = getIndex(input);
                if (input.form[ind].type == 'textarea') {
                      return;
                }
                ind++;
                input.form[ind].focus();
                if (input.form[ind].type == 'text') {
                      input.form[ind].select();
                }
          }

          function getIndex(input) {
                var index = -1, i = 0, found = false;
                while (i < input.form.length && index == - 1)
                      if (input.form[i] == input) {
                            index = i;
                              if (i < (input.form.length - 1)) {
                                   if (input.form[i + 1].type == 'hidden') {
                                   index++;
                             }
                             if (input.form[i + 1].type == 'button' && input.form[i + 1].id == 'tabstopfalse') {
                                   index++;
                             }
                       }
                      }
                      else
                       i++;
                return index;
          }
    }

    function mascaraData(data) {
        if (data.value.length == 2)
            data.value = data.value + '/';
        if (data.value.length == 5)
            data.value = data.value + '/';
    }
    function mascaraCnpj(cnpj) {
        if (cnpj.value.length == 2)
            cnpj.value = cnpj.value + '.';
        if (cnpj.value.length == 6)
            cnpj.value = cnpj.value + '.';
        if (cnpj.value.length == 10)
            cnpj.value = cnpj.value + '/';
        if (cnpj.value.length == 15)
            cnpj.value = cnpj.value + '-';
    }
    function mascaraInscricaoEstadual(InscricaoEstadual) {
        if (InscricaoEstadual.value.length == 2)
            InscricaoEstadual.value = InscricaoEstadual.value + '.';
        if (InscricaoEstadual.value.length == 6)
            InscricaoEstadual.value = InscricaoEstadual.value + '.';
        if (InscricaoEstadual.value.length == 10)
            InscricaoEstadual.value = InscricaoEstadual.value + '-';
    }
    function mascaraCep(cep) {
        if (cep.value.length == 2)
            cep.value = cep.value + '.';
        if (cep.value.length == 6)
            cep.value = cep.value + '-';
    }
    function maiuscula(z) {
        v = z.value.toUpperCase();
        z.value = v;
    }
    function minuscula(z) {
        v = z.value.toLowerCase();
        z.value = v;
    }

    function mascaraTelefone() {
        // Bind no input e propertychange para pegar ctrl-v
// e outras formas de input
        $("#telefone").bind('input propertychange', function () {
            // pego o valor do telefone
            var texto = $(this).val();
            // Tiro tudo que não é numero
            texto = texto.replace(/[^\d]/g, '');
            // Se tiver alguma coisa
            if (texto.length > 0)
            {
                // Ponho o primeiro parenteses do DDD    
                texto = "(" + texto;
                if (texto.length > 3)
                {
                    // Fecha o parenteses do DDD
                    texto = [texto.slice(0, 3), ") ", texto.slice(3)].join('');
                }
                if (texto.length > 12)
                {
                    // Se for 12 digitos ( DDD + 8 digitos) ponhe o traço no quarto digito
                    texto = [texto.slice(0, 9), "-", texto.slice(9)].join('');
                }
                // Não adianta digitar mais digitos!
                if (texto.length > 14)
                    texto = texto.substr(0, 14);
            }
            // Retorna o texto
            $(this).val(texto);
        })
    }

    function mascaraCelular() {
        // Bind no input e propertychange para pegar ctrl-v
// e outras formas de input
        $("#celular1").bind('input propertychange', function () {
            // pego o valor do celular
            var texto = $(this).val();
            // Tiro tudo que não é numero
            texto = texto.replace(/[^\d]/g, '');
            // Se tiver alguma coisa
            if (texto.length > 0)
            {
                // Ponho o primeiro parenteses do DDD    
                texto = "(" + texto;
                if (texto.length > 3)
                {
                    // Fecha o parenteses do DDD
                    texto = [texto.slice(0, 3), ") ", texto.slice(3)].join('');
                }
                if (texto.length > 12)
                {
                    // Se for 13 digitos ( DDD + 9 digitos) coloca o traço no quinto digito            
                    if (texto.length > 13)
                        texto = [texto.slice(0, 10), "-", texto.slice(10)].join('');
                }
                // Não adianta digitar mais digitos!
                if (texto.length > 15)
                    texto = texto.substr(0, 15);
            }
            // Retorna o texto
            $(this).val(texto);
        })

        $("#celular2").bind('input propertychange', function () {
            // pego o valor do celular
            var texto = $(this).val();
            // Tiro tudo que não é numero
            texto = texto.replace(/[^\d]/g, '');
            // Se tiver alguma coisa
            if (texto.length > 0)
            {
                // Ponho o primeiro parenteses do DDD    
                texto = "(" + texto;
                if (texto.length > 3)
                {
                    // Fecha o parenteses do DDD
                    texto = [texto.slice(0, 3), ") ", texto.slice(3)].join('');
                }
                if (texto.length > 12)
                {
                    // Se for 13 digitos ( DDD + 9 digitos) coloca o traço no quinto digito            
                    if (texto.length > 13)
                        texto = [texto.slice(0, 10), "-", texto.slice(10)].join('');
                }
                // Não adianta digitar mais digitos!
                if (texto.length > 15)
                    texto = texto.substr(0, 15);
            }
            // Retorna o texto
            $(this).val(texto);
        })
    }

    function redireciona($id) {
        if ($id) {

            document.getElementById("frm_teste").submit($id);

        } else {
            document.getElementById("frm_teste").submit();
        }
    }
</script>