<?php
	require 'php/dbConecta.php'; // Conecta com o Banco
	$procuraEvento = mysql_query("SELECT * FROM `evento`"); // Reune todos os eventos
	
?>
<html lang="sv">
	<head>
		<meta charset="UTF-8">
		<title>SimpleCalendar</title>
		<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Lato:300,400,700">
		<link rel="stylesheet" href="http://weloveiconfonts.com/api/?family=fontawesome">
		<link rel="stylesheet" href="assets/css/style.css">
		<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
		<script src="assets/js/simplecalendar.js" type="text/javascript"></script>
	</head>
	<body>
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
				<div class="list">
                <?php
					while($vetorEventos = mysql_fetch_array($procuraEvento))
					{
						$separaData = explode("-",$vetorEventos['Dat_evento']);
						echo $separaData['0'];
						//echo("<div class=\"day-event\" date-month=\"".$separaData['1']."\" date-day=\"".$separaData['2']."\">");
						echo("<div class=\"day-event\" date-month=\"9\" date-day=\"1\">");
						echo("	<a href=\"#\" class=\"close fontawesome-remove\"></a>");
						echo("teste");
						echo("	<h2 class=\"title\">".$vetorEventos['Nom_evento']."</h2>");
						echo("	<p class=\"date\">".$vetorEventos['Dat_evento']."</p>");
						echo("	<p>".$vetorEventos['Des_evento']."</p>");
						echo("<label>
						    <span>Read more!</span>
						</label>");
						echo("</div>");
					}
				?>
				</div>
			</div>
		</div>
	</body>
</html>
