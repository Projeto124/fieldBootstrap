<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Denunciar</title>
  </head>
  <body>
      <h2>CADASTRO DE DENÚNCIA</h2><br>

      <a href="cadastroTerreno.php"><p>Cadastre o terreno que deseja denunciar</p></a><br>
      <form class="" action="processa.php" method="post"><br>

    <p> situação atual:  <select name="status">
     <option value="aberto">Aberto</option>
     <?php session_start();
       if($_SESSION['permissao']==='admin'){
          echo "<option value="."confirmado".">Confirmado</option>";
          echo "<option value="."notificado".">Notificado</option>";
          echo "<option value="."finalizado".">Finalizado</option>";
       }
     ?>


</select>
<br> </p>
          <p>Descreva abaixo a situação encontrada:</p>
     <textarea name="comentario" title="Máximo de 80 caracteres" rows="8" cols="80"></textarea>
</br>
<?php
      $fuso=new DateTimeZone('America/Campo_Grande');
      $data=new DateTime();
      $data->setTimeZone($fuso);

      echo  $data->format('d-m-Y H:i:s').'</br>';


 $dataDenuncia=date('d/m/y');
 echo $dataDenuncia.'</br>';
 echo date('h:i:s').'</br>';
?>

      <input type="hidden" id="fk" name="idT" value="">

          <input type="submit" name="enviar" value="Enviar">
      </form>

    </div>
  </body>
</html>
<script>

  var url = window.location.href;
  var id = url.split('=')[1];
  // alert(url); teste se pega a url
  // alert(id); teste mostra id terreno
  document.getElementById('fk').value = id;
</script>
