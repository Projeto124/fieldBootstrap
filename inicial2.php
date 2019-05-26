<?php
	session_start();

	if(isset($_SESSION['idUsuario']))
	{
		if($_SESSION['permissao']==='admin'){
		echo "Olá ".$_SESSION['permissao']." ".$_SESSION['nome']."!<br>";

		echo "<title>Página inicial</title><br>";
  echo "<h1>FIELD<h1><br>";
  echo "<a href='saida.php'>Sair<a><br>";
  // echo "<a href='cadastro.php'>Cadastrar</a><br>";
  echo "<a href='denuncia.php'>Denunciar</a><br>";
  echo "<a href='acompanhar.php'>Acompanhar</a><br>";
	echo "<a href='cadastroUsuario.php'>Cadastrar usuário</a><br>";
echo "<a href='cadastroTerreno.php'>Cadastrar terreno</a><br>";
echo "<a href='buscarData.php'>Buscar por data</a><br>";
echo "<a href='buscarEndereco.php'>Buscar por rua</a><br>";
}else{
	echo "Bem-vindo ".$_SESSION['nome']."!<br>";
	echo "<title>Página inicial</title><br>";
echo "<h1>FIELD<h1><br>";
echo "<a href='saida.php'>Sair<a><br>";
// echo "<a href='cadastro.php'>Cadastrar</a><br>";
echo "<a href='denuncia.php'>Denunciar</a><br>";
echo "<a href='acompanhar.php'>Acompanhar</a><br>";
echo "<a href='cadastroTerreno.php'>Cadastrar terreno</a><br>";
}







	}
	else
	{
		?>
		<script>
			alert("Você precisa estar logado para acessar o sistema.");
		</script>
		<?php
		// echo "Você precisa estar logado para acessar o sistema.";
		header("Refresh: 0; url='login.php'");
		exit(0);
	}
?>
