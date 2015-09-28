<?php
if(isset($_POST['submit'])){ // Se o usuário clicou em Cadastrar
	$nomeTurma=mysql_real_escape_string($_POST['nomeTurma']); // Cria varíavel nomeTurma
	$instituicao=mysql_real_escape_string($_POST['instituicao']); // Cria varíavel instituicao
	$ensino=mysql_real_escape_string($_POST['ensino']); // Cria varíavel ensino
	$disciplinas=mysql_real_escape_string($_POST['disciplinas']); // Cria varíavel disciplina
    if ("$nomeTurma && $instituicao && $ensino && $disciplinas")
    {
		require 'php/dbConecta.php'; // Conecta com o Banco
		$sql=mysql_query("SELECT * FROM `turma` WHERE `Nom_turma`='$nomeTurma'"); // Procura o Usuário
		if(mysql_num_rows($sql) > 0)
        { // Se o Usuário existir
			echo("<script>alert('Nome da turma já existe.');</script>"); // Mensagem de Erro
		}
        else // Caso o contrário
        {
        	//Cria o codigo da turma e checa se ele já existe no banco de dados
            do
            {
            	$Cod_turma = rand(000,999);
            	$comp_cod = mysql_query ("SELECT * FROM `turma` WHERE `Cod_turma`='Cod_turma'");
            
            }
            while(mysql_num_rows($comp_cod) > 0);
            // FIM
            

            
            
			if(mysql_query("INSERT INTO turma(Cod_turma, Nom_instituicao, Nom_turma, Gr_ensino) VALUES ('$Cod_turma','$instituicao','$nomeTurma','$ensino')")) // Se Inserir com sucesso
            {
                //Separa as disciplinas em varias strings
                $array=explode(";",$disciplinas);
                $array_tam = sizeof($array);
                for ($i = 0; $i < $array_tam; $i++)
                {
                    mysql_query("INSERT INTO disciplinas(Nom_disciplina, Cod_turma) VALUES ('$array[$i]','$Cod_turma')");
                }
                //FIM
                header('location: registroAluno.php');          
			}
        	else // Caso o contrário
        	{ 
				echo("<script>alert('Estão faltando dados ou existem dados inválidos.');</script>"); // Mensagem de Erro
			}
            
		}
	mysql_close(); // Desconecta do Banco
    }
    else
    {
    	echo("<script>alert('Existe um ou mais campo(s) vazio(s).');</script>"); // Mensagem de Erro
    }
    
    
}
?>

<!DOCTYPE HTML>
<!--
	Monochromed by TEMPLATED
    templated.co @templatedco
    Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html>
	<head>
		<title>Noks - Registro de turma</title>
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
	<body class="homepage">

	<!-- Header -->
		<div id="header">
			<div class="container">
					
				<!-- Logo -->
					<div id="logo">
						<a href="login.php"><img src="images/logo2.png" width="150" height="150" /></a>
					</div>
				
				<!-- Nav -->
					<nav id="nav">
						<ul>
							<li><a href="login.php">Login</a></li>
							<li class="active"><a href="registroTurma.php">Registrar turma</a></li>
							<li><a href="sobre.php">Sobre nós</a></li>
						</ul>
					</nav>

			</div>
		</div>
	<!-- Header -->
			
	<!-- Main -->
		<div id="main">
			<div class="container">
				<form id="regTurma" method="POST" action="registroTurma.php">	
						<header>
								<h1 class="title"><center>Preencha com os dados de sua turma!</center></h1>
								<center><span class="byline">Todos os dados são obrigatórios</span></center>
							</header>
							<br>
								<center>
								<table>
									<tr>
										<td>Nome da turma:&nbsp;</td>
										<td><input type="text" name="nomeTurma" required maxlength="32"></td>
									</tr>
									<tr>
										<td>Instituição de ensino:&nbsp;</td>
										<td><input type="text" name="instituicao" required maxlength="32"></td>
									</tr>
									<tr>
										<td>Grau de ensino:&nbsp;</td>
										<td>
											<select name="ensino">
												<option value=""></option>
												<option value="Ensino Fundamental">Ensino Fundamental</option>
												<option value="Ensino Médio">Ensino Médio</option>
												<option value="Ensino Superior">Ensino Superior</option>
											</select>
										</td>
									</tr>
									<tr>
										<td>Disciplinas:&nbsp;</td>
										<td>
											<textarea rows="5" cols="40" placeholder="Ex: Matemática;Física;Biologia" form="regTurma" name="disciplinas" required></textarea>
										</td>
									</tr>
								</table>
								<span style="color:red;">*Digite as disciplinas separadas por ponto e vírgula.</span>
								<br>
								<br>
								<input type="submit" class="button" value="Submeter" name="submit" href="#"></center>
					</form>
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