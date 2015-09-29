<?php
    session_start();
    require 'dbConecta.php';
    $login = $_SESSION['Login'];

    $sql = mysql_query("SELECT * FROM aluno WHERE Login = '$login'");
	$array = mysql_fetch_array($sql);
	$senha = $array['Snh_entrada'];
	
    if($_POST['atual'] === $senha)
    {
        if($_POST['nova'] === $_POST['rNova'])
        {
            $nova = $_POST['nova'];
            if(mysql_query("UPDATE `noks`.`aluno` SET `Snh_entrada` = '$nova' WHERE `aluno`.`Login` = '$login'"))
            {
                header("location: ../perfil.php");
            }
        }
        else
        {
            header("location: ../perfil.php");
        }
    }
    else
    {
        header("location: ../perfil.php");
    }
?>