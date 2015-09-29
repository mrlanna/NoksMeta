<?php
	session_start(); // Carrega Cookies da Sessão
	require 'php/dbConecta.php'; // Conecta com o Banco
	
	$login = $_SESSION['Login']; // sessão que traz o login do aluno
	
	$sql=mysql_query("SELECT * FROM `aluno` WHERE `Login`='$login'");
	if(mysql_num_rows($sql) > 0)
	{ // Se o Usuário existir 
	}
	else
	{
		header('location: login.php'); // Leva para a àrea de login
	}
	
	$sql=mysql_query("SELECT * FROM `aluno` INNER JOIN `turma` ON aluno.Cod_turma = turma.Cod_turma 
		WHERE `Login`='$login'"); // Procura o Usuário pelo login(chave primária)
	
	$array = mysql_fetch_array($sql); //todos os dados do aluno são guardados aqui
	
	$aluno = $array['Nom_aluno']; // Faz um get no nome do aluno
	$turma = $array['Nom_turma'].", ".$array['Cod_turma'];
	$cAluno = $array['Cod_aluno'];
	$email = $array['Email'];
	
?>

<!DOCTYPE HTML>
<!--
	Monochromed by TEMPLATED
    templated.co @templatedco
    Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html>
	<head>
		<title><?php echo $aluno ?> - Perfil</title>
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
	<body>
		<div id="logedIn"><img src="images/usIcon.png" height="10" width="10" /><a href="perfil.php"><?php echo "  ".$aluno ?></a> &nbsp;<span style="color:#fff;font-size:15px;">|</span> &nbsp;<a href="php/sessionFinish.php">Logout</a></div>
		<!-- Header -->
		<div id="header">
			<div class="container">
					
				<!-- Logo -->
					<div id="logo">
						<a href="home.php"><img src="images/logo2.png" width="150" height="150" /></a>
					</div>
				
				<!-- Nav -->
					<nav id="nav">
						<ul>
							<li><a href="home.php">Homepage</a></li>
							<li class="active"><a href="perfil.php">Perfil</a></li>
							<li><a href="notas.php">Notas</a></li>
							<li><a href="cronograma.php">Cronograma</a></li>
							<li><a href="arquivos.php">Arquivos</a></li>
						</ul>
					</nav>

			</div>
		</div>
	<!-- Header -->
			
	<!-- Main -->
		<div id="main" class="padded">
			<div class="container">
				<div class="row">

				
					<!-- Content -->
					
						<div id="content" class="6u skel-cell-important" align="center">
							<section>
								<header>
									<h2>Perfil do aluno</h2>
									<span class="byline">Visualize e altere seus dados de usuário</span>
								</header>
								<p><a href="#" class="image full" height="50" width="50"><img src="images/perfil.png" alt=""></a></p>
								<p><strong>Nome do aluno:</strong> <?php echo $aluno; ?><br><strong>Login do aluno:</strong> <?php echo $login; ?><br><strong>Nome da turma:</strong> <?php echo $turma; ?><br><strong>Código do aluno: </strong><?php echo $cAluno; ?><br><strong>E-mail do aluno: </strong><?php echo $email; ?><br><br>Para mais informações entre em contato com noks.corporativo@gmail.com, o seu feedbacl é de extema importância para o nosso crescimento, contamos com vocês!</p>
								</section>
						</div>
					<!-- /Content -->

					<!-- Sidebar -->
					
						<div id="sidebar" class="4u">
							<section>
								<header>
									<h2>Alterar senha</h2>
									<span class="byline"></span>
								</header>
								<form action="php/passChange.php" id="upArquivo" name="upload" method="POST" enctype="multipart/form-data"><center>
									<p><input type="password" required="required" id="atual" name="atual" maxlength="16" minlength="4" size = "36" placeholder="Digite a senha atual"/></p>
									<p><input type="password" required="required" id="nova" name="nova" maxlength="16" minlength="4" size = "36" placeholder="Digite sua nova senha"/></p>
									<p><input type="password" required="required" id="rNova" name="rNova" maxlength="16" minlength="4" size = "36" placeholder="Confirme sua nova senha"/></p>
									<p><center><input type="submit" value="Alterar" name="alterar" class="button_full"></center></p>
								</center></form>
							</section>
						</div>
					<!-- Sidebar -->
				</div>
			
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