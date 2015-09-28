<?php
	session_start();
	$login = $_SESSION['Login'];
	
	require 'dbConecta.php';
	
	$dadosAluno = mysql_query("SELECT * FROM `aluno` WHERE `Login` = '$login'");
	
	$array = mysql_fetch_array($dadosAluno);
	
	$cod_turma = $array['Cod_turma'];
	
	if(isset($_POST['novoEvento']))
	{
		echo("toba1");
		$nom_evento = $_POST['eventName'];
		$des_evento = $_POST['eventDesc'];
		$dat_evento = $_POST['eventDate'];
		if($nom_evento && $des_evento && $dat_evento)
		{
			echo("toba2");
			//require 'dbConecta.php';
			$cod_inst = $array['Cod_instituicao'];
			echo $cod_inst;
			if(mysql_query("INSERT INTO `evento` (`Cod_turma`, `Nom_evento`, `Dat_evento`, `Des_evento`, `Cod_instituicao`) VALUES ('$cod_turma', '$nom_evento', '$dat_evento', '$des_evento', '$cod_inst');"))
			{
				
				header('location: \cronograma.php');
			}
			else
			{
				
			}
		}
	}
?>