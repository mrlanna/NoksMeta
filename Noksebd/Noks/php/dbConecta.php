<?php
    $conexao = mysql_connect("localhost", "root", ""); // Conecta com o MySQL - IP, usuário, senha
    mysql_select_db("noks"); // Conecta com o Banco - nome do banco
    mysql_set_charset('UFT8', $conexao);
?>
