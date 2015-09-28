<?php
if(isset($_POST['submit'])){ // Se o usuário clicou em Cadastrar
	$login = mysql_real_escape_string($_POST['login']); // Cria varíavel login
	$password = mysql_real_escape_string($_POST['password']); // Cria varíavel password
	if ("$login && $password")
    {
		require 'php/dbConecta.php'; // Conecta com o Banco
		$sql = mysql_query("SELECT * FROM `aluno` WHERE `Login`='$login'"); // Procura o login(pois é único)
		if(mysql_num_rows($sql) > 0)
        { // Se o login existir
			$array = mysql_fetch_array($sql);
			$senha_db = $array['Snh_entrada'];
			if ($senha_db === $password)//confere a senha do BD com a senha do formulário
			{
				session_start(); //inicia uma sessão
				$_SESSION['Login'] = $array['Login']; //inicia a sessão com uma chave única(Login)
				header('location: home.php'); //redireciona
			}
		}
        else // Caso o contrário
        {
            echo("<script>alert('A senha ou o login estão errados');</script>"); // Mensagem de Erro
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
		<title>Noks - Login</title>
		<link rel="shortcut icon" href="images/icon.ico" type="image/x-icon" />
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<link href='http://fonts.googleapis.com/css?family=Oxygen:400,300,700' rel='stylesheet' type='text/css'>
		<!--[if lte IE 8]><script src="js/html5shiv.js"></script><![endif]-->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-panels.min.js"></script>
		<script src="js/init.js"></script>
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
							<li class="active"><a href="login.php">Login</a></li>
							<li><a href="sobre.php">Sobre nós</a></li>
						</ul>
					</nav>

			</div>
		</div>
	<!-- Header -->
			
	<!-- Main -->
		<div id="main">
			<div class="container">
				<form method="POST" action="login.php">
						<center>
							<header>
								<h1 class="title">LOGIN</h1>
							</header>
							
							<p><input type="text" required pattern="[0-9]+$" maxlength="6" minlength="6" name="login" placeholder=" Nº de registro" size="30"/></p>
							<input type="password" maxlength="16"  minlength="6" required name="password" placeholder=" Senha" size="30" />

							<div id="buttons">
								<input type="submit" class="button" value="Login" name="submit" href="#">
								<a href="#" class="button">Registrar</a>
							</div>
						</center>
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