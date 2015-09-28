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
	
	$sql=mysql_query("SELECT * FROM `aluno` WHERE `Login` = '$login'"); //pesquisa para trazer a tabela aluno
	
	$array = mysql_fetch_array($sql);
	$aluno = $array['Nom_aluno']; //Nome do aluno, colocado na página
	$turma = $array['Cod_turma'];
	
	$procuraEvento = mysql_query("SELECT * FROM `evento` where Cod_turma = 'Sturma'"); // Reune todos os eventos
?>

<!DOCTYPE HTML>
<!--
	Monochromed by TEMPLATED
    templated.co @templatedco
    Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html>
	<head>
		<title><?php echo $aluno ?> - Cronograma</title>
		<link rel="shortcut icon" href="images/icon.ico" type="image/x-icon" />
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<link href='http://fonts.googleapis.com/css?family=Oxygen:400,300,700' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Lato:300,400,700">
		<link rel="stylesheet" href="http://weloveiconfonts.com/api/?family=fontawesome">
		<link rel="stylesheet" href="css/style-crono.css">
		<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
		<script src="js/simplecalendar.js" type="text/javascript"></script>
		<!--[if lte IE 8]><script src="js/html5shiv.js"></script><![endif]-->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-panels.min.js"></script>
		<script src="js/init.js"></script>
		<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
        <script type="text/javascript" charset="utf-8" src="js/jquery.leanModal.min.js"></script>
		<script src="js/modalbox.js"></script>
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
							<li><a href="notas.php">Notas</a></li>
							<li class="active"><a href="cronograma.php">Cronograma</a></li>
							<li><a href="arquivos.php">Arquivos</a></li>
						</ul>
					</nav>

			</div>
		</div>
	<!-- Header -->
		
		<div class="window" id="novoEvento" align="center">
			<a href="#" class="fechar">X</a>
			<h2 style="font-size:30px; margin-bottom:20px;">Registro de evento</h2>

			<form id="eventForm" name="eventForm" method="POST" action="php/lancaEvento.php" style="margin-bottom:0;">
				
				<input type="text" name="eventName" id="eventName" class="txtfield" tabindex="1" placeholder="Digite o nome do evento" size="35"><br>

				<textarea name="eventDesc" id="eventDesc" class="txtfield" tabindex="1" cols="35" rows="6" placeholder="Adicione uma descrição para o evento"></textarea><br>
				
				<input type="date" name="eventDate" id="eventDate"/>
				
				<div class="center"><input type="submit" name="novoEvento" id="novoEvento" class="button" value="Criar evento" tabindex="3"></div>

			</form>
		</div>
		
		<div id="mascara"></div>
	<!-- Main -->
		<div id="main" class="padded">
			<div class="height: 805px;">
				<div class="row">

					<!-- Sidebar -->
						<div id="sidebar" class="4u">
							<section>
								<header>
									<h2>Eventos do dia selecionado</h2>
								</header>
								<div class="boxed">
									<?php
											while($vetorEventos = mysql_fetch_array($procuraEvento))
											{
												$separaData = explode("-",$vetorEventos['Dat_evento']);
												echo("<div class=\"day-event\" date-month=\"".(int)$separaData['1']."\" date-day=\"".(int)$separaData['2']."\">");
												echo("	<a href=\"#\" class=\"close fontawesome-remove\"></a>");
												echo("	<h2 class=\"title\">".$vetorEventos['Nom_evento']."</h2>");
												echo("	<p class=\"date\">".$vetorEventos['Dat_evento']."</p>");
												echo("	<p>".$vetorEventos['Des_evento']."</p>");
												echo("</div>");
											}
									?>
								</div>
								<a href="#novoEvento" rel="modal"><button class="button_full">Inserir evento</button></a>
							</section>
						</div>
					<!-- Sidebar -->
				
					<!-- Content -->
						<div id="content" class="8u skel-cell-important">
							<section>
								<div class="calendar-container">
									<div class="calendar">
										<header>
											<h2 class="month"></h2>
											<a class="btn-prev fontawesome-angle-left" href="#"></a>
											<a class="btn-next fontawesome-angle-right" href="#"></a>
										</header>
										<table>
											<thead class="event-days">
												<tr></tr>
											</thead>
											<tbody class="event-calendar">
												<tr class="1"></tr>
												<tr class="2"></tr>
												<tr class="3"></tr>
												<tr class="4"></tr>
												<tr class="5"></tr>
											</tbody>
										</table>
										
									</div>
								</div>
							</section>
						</div>
					<!-- /Content -->
						
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