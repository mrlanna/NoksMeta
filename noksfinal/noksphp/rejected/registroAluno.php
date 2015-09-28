<?php
if(isset($_POST['submit'])){ // Se o usuário clicou em Cadastrar
	$nomeAluno=mysql_real_escape_string($_POST['nomeAluno']); // Cria varíavel nomeTurma
	$email=mysql_real_escape_string($_POST['email']); // Cria varíavel instituicao
	$password=mysql_real_escape_string($_POST['password']); // Cria varíavel ensino
	$turma=mysql_real_escape_string($_POST['ensino']); // Cria varíavel disciplina
    if ("$nomeAluno && $email && $password && $turma")
    {
		require 'php/dbConecta.php'; // Conecta com o Banco
		$sql=mysql_query("SELECT * FROM `aluno` WHERE `Nom_aluno`='$nomeAluno'"); // Procura o Usuário
		if(mysql_num_rows($sql) > 0)
        { // Se o Usuário existir
			echo("<script>alert('Nome do Aluno já existe.');</script>"); // Mensagem de Erro
		}
        else // Caso o contrário
        {
        	//Cria o codigo da turma e checa se ele já existe no banco de dados
            do
            {
            	$Cod_aluno = rand(000,999);
            	$comp_cod = mysql_query ("SELECT * FROM `aluno` WHERE `Cod_aluno`='Cod_aluno'");
            
            }
            while(mysql_num_rows($comp_cod) > 0);
            // FIM

			if(mysql_query("INSERT INTO aluno(Cod_aluno, Cod_turma, Nom_aluno, Flg_admin, Snh_entrada, Email) VALUES ('$Cod_aluno','$turma','$nomeAluno','0','$password','$email')")) // Se Inserir com sucesso
            {
				
				$array = mysql_fetch_array($sql);
				$login_db = $array['Cod_turma'].$array['Cod_aluno'];
                echo("<script>alert('Registro efetuado com sucesso! Login: ')</script>");// <== aqui deve mostrar o login do usuario recem cadastrado
                // Mensagem de sucesso            
			}
        	else // Caso o contrário
        	{
				mysql_error();
				echo("<script>alert('Erro no registro');</script>"); // Mensagem de erro 
				exit();
			}
            
		}
	mysql_close(); // Desconecta do Banco
    }
    else
    {
    	echo("<script>alert('Existe um ou mais campo(s) vazio(s).');</script>"); // Mensagem de Erro
    }
    
    
}
?>


<!DOCTYPE HTML>
<!--
	Monochromed by TEMPLATED
    templated.co @templatedco
    Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html>
	<head>
		<title>Noks - Registro de aluno</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<link href='http://fonts.googleapis.com/css?family=Oxygen:400,300,700' rel='stylesheet' type='text/css'>
		<!--[if lte IE 8]><script src="js/html5shiv.js"></script><![endif]-->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-panels.min.js"></script>
		<script src="js/init.js"></script>
		<script>
			function valida()
			{
				var x = document.getElementById("senha");
				var y = document.getElementById("conSenha");
				var n = y.value.localeCompare(x.value);
				if(n!==0)
				{
					x.value = "";
					y.value = "";
					alert("As senhas devem corresponder!");
				}
			}
		</script>
		<noscript>
			<link rel="stylesheet" href="css/skel-noscript.css" />
			<link rel="stylesheet" href="css/style.css" />
		</noscript>
		<!--[if lte IE 8]><link rel="stylesheet" href="css/ie/v8.css" /><![endif]-->
		<!--[if lte IE 9]><link rel="stylesheet" href="css/ie/v9.css" /><![endif]-->
	</head>
	<body class="homepage">

	<!-- Header -->
		<div id="header">
			<div class="container">
					
				<!-- Logo -->
					<div id="logo">
						<a href="login.php"><img src="images/logo2.png" width="150" height="150" /></a>
					</div>
				
				<!-- Nav -->
					<nav id="nav">
						<ul>
							<li><a href="login.php">Login</a></li>
							<li><a href="registroTurma.php">Registrar turma</a></li>
							<li><a href="sobre.php">Sobre nós</a></li>
						</ul>
					</nav>

			</div>
		</div>
	<!-- Header -->
			
	<!-- Main -->
		<div id="main">
			<div class="container">
				<form method="POST" action="registroAluno.php">
						<header>
								<h1 class="title"><center>Preencha com os seus dados pessoais!</center></h1>
								<center><span class="byline">Todos os dados são obrigatórios</span></center>
							</header>
							<br>
							<form>
								<center>
								<table>
									<tr>
										<td>Nome do aluno:&nbsp;</td>
										<td><input type="text" required name="nomeAluno" pattern="[A-Za-z\s]+$" /></td>
									</tr>
									<tr>
										<td>E-mail:&nbsp;</td>
										<td><input type="email" required class="input-text" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" /></td>
									</tr>
									<tr>
										<td>Senha:&nbsp;</td><!-- A confirmação de senha ainda precisa ser feita -->
										<td><input type="password" id="senha" name="password" maxlength="16"  minlength="8" required></td>
									</tr>
									<tr>
										<td> Confirmar senha:&nbsp;</td>
										<td><input type="password" id="conSenha" name="conSenha" maxlength="16"  minlength="8" required onBlur="valida()"></td>
									</tr>
									<tr>
										<td>Turma:&nbsp;</td>
										<td>
											<select name="ensino">
											<option value=""></option>
												<?php
												require 'php/dbConecta.php'; // Conecta com o Banco
												$sql2 = "SELECT Nom_turma FROM turma";
												$total = mysql_query($sql2);
												$sql3 = "SELECT Cod_turma FROM turma";
												$total2 = mysql_query($sql3);
												$fila2 = mysql_fetch_array($total2);
												while($fila = mysql_fetch_array($total))
												{
													echo "<option value='" .$fila2['Cod_turma']."'>".$fila['Nom_turma']."</option>";
												}
												mysql_close(); // Desconecta do Banco
												?>
											</select>
										</td>
									</tr>
								</table>
								<span style="color:red;">*Senhas devem conter de 8 a 16 caractéres.</span>
								<br>
								<br>
								<input type="submit" class="button" value="Submeter" name="submit" href=""></center>
							</form>
					</form>
			</div>
		</div>
	<!-- Main -->



	<!-- Copyright -->
		<div id="copyright" class="container">
			<p>"Toda a educação, no momento, não parece motivo de alegria, mas de tristeza. Depois, no entanto, produz naqueles que assim foram exercitados um fruto de paz e de justiça."</p>
			<p>Noks, created by: Rafael Willian, Vitor Hugo Lacerda e Lucas Mechler - CEFET-MG Campus XI</p>
			Design by: <a href="http://templated.co">TEMPLATED</a> Images: <a href="http://unsplash.com">Unsplash</a> (<a href="http://unsplash.com/cc0">CC0</a>)
		</div>

	</body>
</html>