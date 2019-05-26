<?php
include_once "config.php";
include_once "connection.php";

session_start();

$conexao = new Connection($host, $user, $password, $database);

//--------------------------------------------------------------------------- Login  ----------------------------------------------------

if($_SERVER['HTTP_REFERER'] === $url.'login.php')
{
	$login = $_POST['login'];
	$senha = $_POST['senha'];
	$senha = sha1($senha);

	if( (empty($login) == TRUE) || (empty($senha) == TRUE) )
	{
		?>
		<script>
		alert("Você deve preencher todos os campos corretamente!");
		</script>
		<?php
		// echo "Você deve preencher todos os campos corretamente!";
		header("Refresh: 0; url=login.php");
		exit(0);
	}
	else
	{
		$sql = "SELECT * FROM usuario WHERE login = '$login'";

		$conexao->query($sql);

		if($conexao->num_rows() > 0)
		{
			$sql = "SELECT permissao,idUsuario, nome AS n FROM usuario WHERE login = '$login' AND
			senha = '$senha'";

			$conexao->query($sql);

			if($conexao->num_rows() > 0)
			{
				$tupla = $conexao->fetch_assoc();
				$idUsuario = $tupla['idUsuario'];
				$nome = $tupla['n'];
				$perm=$tupla['permissao'];

				$_SESSION['idUsuario'] = $idUsuario;
				$_SESSION['nome'] = $nome;
				$_SESSION['permissao'] = $perm;

				header("Refresh: 0; url=inicial2.php");
			}
			else
			{
				?>
				<script>
				alert("Login e senha não correspondem");
				</script>
				<?php
				// echo "Login e senha não correspondem";
				header("Refresh: 0; url=login.php");
				exit(0);
			}

		} else{
			?>
			<script>
			alert("Login inexistente");
			</script>
			<?php
			// echo "login inexistente";
			header("Refresh: 0; url=login.php");
		}
	}
}
else
{

	//--------------------------------------------------------------------------- Cadastro de Usuario admin----------------------------------------------------
	if($_SERVER['HTTP_REFERER'] === $url.'cadastroUsuario.php')
	{
		$login = $_POST['login'];
		$senha = $_POST['senha'];
		$confirmarSenha = $_POST['confirmarSenha'];
		$nome = $_POST['nome'];
		$CPF= $_POST['CPF'];
		$email = $_POST['email'];
		$permissao=$_POST['permissao'];

		if( (empty($login) == TRUE) || (empty($senha) == TRUE) || (empty($nome) == TRUE) || (empty($CPF) == TRUE) || (empty($email) == TRUE) || (empty($permissao) == TRUE))
		{
			?>
			<script>
			alert("Você deve preencher todos os campos corretamente!");
			</script>
			<?php
			// echo "Você deve preencher todos os campos corretamente!";
			header("Refresh: 0; url=cadastroUsuario.php");
			exit(0);
		}

		if($senha !== $confirmarSenha)
		{
			?>
			<script>
			alert("Senhas não correspondem");
			</script>
			<?php
			// echo "Senhas não correspondem";
			header("Refresh: 0; url=cadastroUsuario.php");
			exit(0);

		}
		$sql = "SELECT * from usuario WHERE CPF = '$CPF'";

		$conexao->query($sql);

		if ($conexao->num_rows() > 0) {
			?>
			<script>
			alert("CPF já cadastrado, tente novamente ");
			</script>
			<?php
			// echo "CPF já cadastrado, tente novamente ";
			header("Refresh: 0; url=cadastroUsuario.php");
		}else{

			$senha = sha1($senha);


			$sql = "INSERT INTO usuario(login, nome, CPF, email, senha, permissao) VALUES
			('$login', '$nome', '$CPF', '$email','$senha','$permissao')";

			$status = $conexao->query($sql);

			if($status === TRUE)
			{
				?>
				<script>
				alert("Cadastro feito com sucesso!");
				</script>
				<?php
				// echo "Cadastro feito com sucesso!";
				header("Refresh: 0; url=inicial2.php");
				exit(0);
			}
		}
	} else {



		//para baixo erro

		//--------------------------------------------------------------------------- Cadastro de Usuario Comum-------------------------------------

		if($_SERVER['HTTP_REFERER'] === $url.'cadastroUsuario.html')
		{
			$login = $_POST['login'];
			$senha = $_POST['senha'];
			$confirmarSenha = $_POST['confirmarSenha'];
			$nome = $_POST['nome'];
			$CPF= $_POST['CPF'];
			$email = $_POST['email'];
			$permissao=$_POST['permissao'];

			if( (empty($login) == TRUE) || (empty($senha) == TRUE) || (empty($nome) == TRUE) || (empty($CPF) == TRUE) || (empty($email) == TRUE) || (empty($permissao) == TRUE))
			{
				?>
				<script>
				alert("Você deve preencher todos os campos corretamente!");
				</script>
				<?php
				// echo "Você deve preencher todos os campos corretamente!";
				header("Refresh: 0; url=cadastroUsuario.html");
				exit(0);
			}

			if($senha !== $confirmarSenha)
			{
				?>
				<script>
				alert("Senhas não correspondem");
				</script>
				<?php
				// echo "Senhas não correspondem";
				header("Refresh: 0; url=cadastroUsuario.html");
				exit(0);

			}
			$sql = "SELECT * from usuario WHERE CPF = '$CPF'";

			$conexao->query($sql);

			if ($conexao->num_rows() > 0) {
				?>
				<script>
				alert("CPF já cadastrado, tente novamente");
				</script>
				<?php
				// echo "CPF já cadastrado, tente novamente ";
				header("Refresh: 0; url=cadastroUsuario.html");
			}else{

				$senha = sha1($senha);


				$sql = "INSERT INTO usuario(login, nome, CPF, email, senha, permissao) VALUES
				('$login', '$nome', '$CPF', '$email','$senha','$permissao')";

				$status = $conexao->query($sql);

				if($status === TRUE)
				{
					?>
					<script>
					alert("Cadastro feito com sucesso!");
					</script>
					<?php
					// echo "Cadastro feito com sucesso!";
					header("Refresh: 0; url=inicial.html");
					exit(0);
				}
			}
		}
		else {









			//--------------------------------------------------------------------------- Cadastro de Terreno-------------------------------------


			if($_SERVER['HTTP_REFERER'] === $url.'cadastroTerreno.php')
			{
				$endereco = $_POST['endereco'];
				$numero = $_POST['numero'];
				$gravidade = $_POST['gravidade'];
				$conteudoImagem=$_FILES["imagem"]["tmp_name"];
				$tamanhoImagem=$_FILES["imagem"]["size"];

				if( (empty($endereco) == TRUE) || (empty($numero) == TRUE) || (empty($gravidade) == TRUE) )
				{
					?>
					<script>
					alert("Você deve preencher todos os campos corretamente!");
					</script>
					<?php
					// echo "Você deve preencher todos os campos corretamente!";
					header("Refresh: 0; url=cadastroTerreno.php");
					exit(0);
				}




				if ( $conteudoImagem != "none" )
				{
					$fp = fopen($conteudoImagem, "rb");
					$conteudoIm = fread($fp, $tamanhoImagem);
					$conteudoIm = addslashes($conteudoIm);
					fclose($fp);



					$sql = "INSERT INTO terreno(endereco, numero, gravidade,imagem) VALUES
					('$endereco', '$numero', '$gravidade','$conteudoIm')";

					$status = mysqli_query($conexao->getLink(), $sql);

					// exit(0);
					if($status === TRUE)
					{
						$last_id = mysqli_insert_id($conexao->getLink());

						?>
						<script>
						alert("Cadastro do Terreno efetuado com sucesso!");
						</script>
						<?php
						// echo "Cadastro do Terreno efetuado com sucesso! Redirecionando para Denuncia.";
						header("Refresh: 2; url=denuncia.php?id=".$last_id);
						exit(0);
					} else{
						?>
						<script>
						alert("Ocorreu um erro durante o cadastro do Terreno. Por favor, tente novamente");
						</script>
						<?php
						// echo "Ocorreu um erro durante o cadastro do Terreno. Por favor, tente novamente";
						header("Refresh: 0; url=cadastroTerreno");
					}
				}
			}
			//--------------------------------------------------------------------------- Denuncia-------------------------------------

			if($_SERVER['HTTP_REFERER'] === $url.'denuncia.php?id='.$_POST['idT'])  //CUIDADO COM O GET POIS O DIRETORIO VEM ERRADO E ELE PARA NO PROCESSA.PHP
			{
				$data = date('Y-m-d H:i:s');
				$stats=$_POST['status'];
				$comentario=$_POST['comentario'];
				$fkUsuario=$_SESSION['idUsuario'];
				$fkTerreno=$_POST['idT'];
				$codAcompanhamento = md5($_POST['idT']);

				if( (empty($stats) == TRUE) || (empty($comentario) == TRUE))
				{
					?>
					<script>
					alert("Você deve preencher todos os campos corretamente!");
					</script>
					<?php

					header("Refresh: 0; url=denuncia.php");
					exit(0);
				}
				$sql = "INSERT INTO denuncia(comentario, status, dataPublicacao, codAcompanhamento, id_usuario,id_terreno) VALUES
				('$comentario', '$stats', NOW(), '$codAcompanhamento', '$fkUsuario','$fkTerreno')";

				$status = $conexao->query($sql);

				if($status === TRUE)
				{
					?>
					<script>
					alert("Denuncia efetuada com sucesso!");

					</script>
					<?php
					header("Refresh: 0; url=dicasAcompanhamento.php?cod=".$codAcompanhamento);
					exit(0);
				}
			}
		}
	}
}

?>
