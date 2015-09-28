<?php
	session_start();
	require 'dbConecta.php';
	$login = $_SESSION['Login'];

	$dadosAluno = mysql_query("SELECT * FROM `aluno` WHERE `Login` = '$login'");

	$array = mysql_fetch_array($dadosAluno);

	$cod_turma = $array['Cod_turma'];

	if(isset($_POST['novoEvento']))
	{
		$nom_evento = $_POST['eventName'];
		$des_evento = $_POST['eventDesc'];
		$dat_evento = $_POST['eventDate'];
		if($nom_evento && $des_evento && $dat_evento)
		{
			require 'dbConecta.php';

			if(mysql_query("INSERT INTO `noks`.`evento` (`Cod_evento`, `Cod_turma`, `Nom_evento`, `Dat_evento`, `Des_evento`)
	   			VALUES ('0', '$cod_turma', '$nom_evento', '$dat_evento', '$des_evento');"))
			{
				header('location: ../cronograma.php');
			}
		}
	}
?>