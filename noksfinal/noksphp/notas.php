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
	
	$sql=mysql_query("SELECT * FROM `aluno` WHERE `Login`='$login'"); // Procura o Usuário pelo login(chave primária)
	
	$array = mysql_fetch_array($sql); //todos os dados do aluno são guardados aqui
	$aluno = $array['Nom_aluno']; // Faz um get no nome do aluno
?>

<!DOCTYPE HTML>
<!--
	Monochromed by TEMPLATED
    templated.co @templatedco
    Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html>
	<head>
		<title><?php echo $aluno ?> - Notas</title>
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
							<li><a href="home.php">Homepage</a></li>
							<li><a href="perfil.php">Perfil</a></li>
							<li class="active"><a href="notas.php">Notas</a></li>
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

					<!-- Sidebar -->
						<div id="sidebar" class="3u">
							<section>
								<header>
									<h2>Gravida praesent</h2>
									<span class="byline">Praesent lacus congue rutrum</span>
								</header>
								<p>Donec leo, vivamus fermentum nibh in augue praesent a lacus at urna congue rutrum. Maecenas luctus lectus at sapien. Consectetuer adipiscing elit.</p>
								<ul class="default">
									<li><a href="#">Pellentesque quis lectus</a></li>
									<li><a href="#">Lorem ipsum adipiscing elit</a></li>
									<li><a href="#">Phasellus pellentesque congue</a></li>
									<li><a href="#">Cras aliquam risus pharetra</a></li>
									<li><a href="#">Duis metus euismod lobortis</a></li>
								</ul>
							</section>
						</div>
					<!-- Sidebar -->
				
					<!-- Content -->
						<div id="content" class="6u skel-cell-important">
							<section>
								<header>
									<h2>Two Sidebars</h2>
									<span class="byline">Praesent lacus at urna congue rutrum</span>
								</header>
								<p><a href="#" class="image full"><img src="images/pics02.jpg" alt=""></a></p>
								<p>Maecenas pede nisl, elementum eu, ornare ac, malesuada at, erat. Proin gravida orci porttitor enim accumsan lacinia. Donec condimentum, urna non molestie semper, ligula enim ornare nibh, quis laoreet eros quam eget ante. Aliquam libero. Vivamus nisl nibh, iaculis vitae, viverra sit amet, ullamcorper vitae, turpis. Aliquam erat volutpat. Vestibulum dui sem, pulvinar sed, imperdiet nec, iaculis nec, leo. Fusce odio. Etiam arcu dui, faucibus eget, placerat vel, sodales eget, orci. Donec ornare neque ac sem. Mauris aliquet. Aliquam sem ultricies. Phasellus tempor vehicula justo.</p>
							</section>
						</div>
					<!-- /Content -->
						
					<!-- Sidebar -->
						<div id="sidebar" class="3u">
							<section>
								<header>
									<h2>Gravida praesent</h2>
									<span class="byline">Praesent lacus congue rutrum</span>
								</header>
								<p>Donec leo, vivamus fermentum nibh in augue praesent a lacus at urna congue rutrum. Maecenas luctus lectus at sapien. Consectetuer adipiscing elit.</p>
								<ul class="default">
									<li><a href="#">Pellentesque quis lectus</a></li>
									<li><a href="#">Lorem ipsum adipiscing elit</a></li>
									<li><a href="#">Phasellus pellentesque congue</a></li>
									<li><a href="#">Cras aliquam risus pharetra</a></li>
									<li><a href="#">Duis metus euismod lobortis</a></li>
								</ul>
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