<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Dicas de Acompanhamento</title>
  </head>
  <body>

    <input id="cod"/>
        <button onclick="copiarTexto()">Copiar</button>
        <script>
            let copiarTexto = () =>{
                //captura o elemento input
                const inputTest = document.querySelector("cod");

                //seleciona todo o texto do elemento
                inputTest.select();
                //executa o comando copy
                //aqui é feito o ato de copiar para a area de trabalho com base na seleção
                document.execCommand('copy');
            };
        </script>
  </body>
</html>
<script type="text/javascript">

  var url = window.location.href;
  var id = url.split('=')[1];
   alert(url); teste se pega a url
   alert(id); teste mostra id terreno
  document.getElementById('cod').value = id;
</script>
