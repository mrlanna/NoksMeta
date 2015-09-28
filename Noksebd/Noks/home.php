<?php
	session_start(); // Carrega Cookies da Sessão
	require 'php/dbConecta.php'; // Conecta com o Banco
	
	$login = $_SESSION['Login']; // Puxa os Cookies
	$sql=mysql_query("SELECT * FROM `aluno` WHERE `Login`='$login'"); // Procura o Usuário pelo login(chave primária)
	
	$array = mysql_fetch_array($sql); //todos os dados do aluno são guardados aqui
	$aluno = $array['Nom_aluno']; // Faz um get no nome do aluno
	
	if(mysql_num_rows($sql) > 0)
	{ // Se o Usuário existir 
	}
	else
	{
		header('location: login.php'); // Leva para a àrea de login
	}
	
	mysql_close(); // Desconecta do Banco
?>

<!DOCTYPE HTML>
<!--
	Monochromed by TEMPLATED
    templated.co @templatedco
    Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html>
	<head>
		<title><?php echo $aluno ?> - Home</title>
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
		<div id="logedIn"><a href="perfil.php"><?php echo $aluno ?></a> | <a href="php/sessionFinish.php">Logout</a></div>
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
							<li class="active"><a href="home.php">Homepage</a></li>
							<li><a href="perfil.php">Perfil</a></li>
							<li><a href="notas.php">Notas</a></li>
							<li><a href="cronograma.php">Cronograma</a></li>
							<li><a href="arquivos.php">Arquivos</a></li>
						</ul>
					</nav>

			</div>
		</div>
	<!-- Header -->
			
	<!-- Main -->
		<div id="main">
			<div class="container">
				<div class="row">
					<div class="3u">
						<section>
							<center>
							<header>
								<h1 class="title">Suas informações</h1>
							</header>
							<a href="#"><img src="images/perfil.png" height="150" width="150" alt=""></a>
							<p>Consulte e modifique aqui as suas informações de usuário.</p>
							<a href="perfil.php" class="button_full">Visitar</a>
							</center>
						</section>
					</div>
					<div class="3u">
						<section>
							<center>
							<header>
								<h1 class="title">Notas</h1>
							</header>
							<a href="#"><img src="images/notas.png" height="150" width="150" alt=""></a>
							<p>Faça uma consulta pelas notas postadas ou insira um novo evento.</p>
							<a href="notas.php" class="button_full">Visitar</a>
							</center>
						</section>
					</div>
					<div class="3u">
						<section>
							<center>
							<header>
								<h1 class="title">Cronograma</h1>
							</header>
							<a href="#"><img src="images/crono.png" height="150" width="150" alt=""></a>
							<p>Verifique o cronograma da sua turma para ter informações sobre trabalhos.</p>
							<a href="cronograma.php" class="button_full">Visitar</a>
							</center>
						</section>
					</div>
					<div class="3u">
						<section>
							<center>
							<header>
								<h1 class="title">Arquivos</h1>
							</header>
							<a href="#"><img src="images/arquivo.png" height="150" width="150" alt=""></a>
							<p>Confira todos os arquivos didaticos disponibilizados para a sua turma.</p>
							<a href="arquivos.php" class="button_full">Visitar</a>
							</center>
						</section>
					</div>
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