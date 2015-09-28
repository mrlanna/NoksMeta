<?php
	session_start(); //carrega cookies da sessão
	require 'php/dbConecta.php';// conecta ao banco
	
	$login = $_SESSION['Login']; // sessão que traz o login do aluno
	
	$sql=mysql_query("SELECT * FROM `aluno` WHERE `Login`='$login'");
	if(mysql_num_rows($sql) > 0)
	{ // Se o Usuário existir 
	}
	else
	{
		header('location: login.php'); // Leva para a àrea de login
	}
	
	$dados=mysql_query("SELECT Nom_turma, Nom_aluno, turma.Cod_turma FROM `turma` INNER JOIN `aluno` ON 
	turma.Cod_turma = aluno.Cod_turma WHERE `Login` = '$login'"); // tabela com dados da turma e aluno, para preencher a página
	
	$array = mysql_fetch_array($dados);
	$cod_turma = $array['Cod_turma'];
	
	$arquivosTurma = mysql_query("Select Nom_arquivo, Des_arquivo, Mir_arquivo FROM arquivo WHERE Cod_turma = $cod_turma");
	
	$turma = $array['Nom_turma']; //Nome da turma, colocado na página
	$aluno = $array['Nom_aluno']; //Nome do aluno, colocado na página
?>

<!DOCTYPE HTML>
<!--
	Monochromed by TEMPLATED
    templated.co @templatedco
    Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html>
	<head>
		<title><?php echo $aluno ?> - Arquivos</title>
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
						<a href="home.html"><img src="images/logo2.png" width="150" height="150" /></a>
					</div>
				
				<!-- Nav -->
					<nav id="nav">
						<ul>
							<li><a href="home.php">Homepage</a></li>
							<li><a href="perfil.php">Perfil</a></li>
							<li><a href="notas.php">Notas</a></li>
							<li><a href="cronograma.php">Cronograma</a></li>
							<li class="active"><a href="arquivos.php">Arquivos</a></li>
						</ul>
					</nav>

			</div>
		</div>
	<!-- Header -->
			
	<!-- Main -->
		<div id="main">
			<div class="container">
				<div class="row">
				
					<!-- Content -->
						<div id="content" class="8u skel-cell-important">
							<section>
								<header>
									<h2>Arquivos da turma <?php echo $turma; ?></h2>
									<span class="byline">Todos os arquivos disponibilizados pela turma estão acessíveis logo abaixo</span>
								</header>
								<div class="boxed">
									<p><strong>Nome do arquivo:</strong> {PlaceHolder}</p>
									<p><strong>Descrição:</strong> Lorem ipsum dolor sit amet, at ius quem graeci, usu modus tamquam torquatos ex. Diam facer evertitur et vel, assum sensibus dissentias his at. Eam an postea pertinax. Eam maluisset mnesarchum et, ei has meis latine maiorum, mei admodum quaerendum no. Duo stet offendit verterem at.</p>
									<button class="button">Download</button>
								</div>
								<div class="boxed">
									<p><strong>Nome do arquivo:</strong> {PlaceHolder}</p>
									<p><strong>Descrição:</strong> Lorem ipsum dolor sit amet, at ius quem graeci, usu modus tamquam torquatos ex. Diam facer evertitur et vel, assum sensibus dissentias his at. Eam an postea pertinax. Eam maluisset mnesarchum et, ei has meis latine maiorum, mei admodum quaerendum no. Duo stet offendit verterem at.</p>
									<button class="button">Download</button>
								</div>
							</section>
						</div>
					<!-- /Content -->
						
					<!-- Sidebar -->
					
						<div id="sidebar" class="4u">
							<section>
								<header>
									<h2>Faça upload de um arquivo</h2>
									<span class="byline">Preencha todos os campos</span>
								</header>
								<form action="php/upload.php" id="upArquivo" name="upload" method="POST" enctype="multipart/form-data"><center>
									<p><input type="text" required="required" name="text" maxlength="64" minlength="4" size = "36" placeholder="Nome do arquivo"/></p>
									<p><textarea form="upArquivo" rows="5" cols="35" required="required" placeholder="Descrição do arquivo"></textarea></p>
									<input type="file" name="arquivo" required="required">
									<p><center><input type="submit" value="Upload" name="botao" class="button"></center></p>
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