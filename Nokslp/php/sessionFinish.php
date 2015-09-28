<?php
	session_start(); //carrega cookies da sessão
	require 'dbConecta.php';// conecta ao banco
	if($_SESSION['Login'])
	{
		session_destroy();
		header('location: ../login.php');
		exit;
	}
	mysql_close();
?>