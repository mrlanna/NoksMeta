<?php
    session_start();
    require 'dbConecta.php';
    $login = $_SESSION['Login'];

    $sql = mysql_query("SELECT * FROM aluno WHERE Login = '$login'");
    if($_POST['atual'] === $_POST['rAtual'])
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