<?php
require 'php/dbConecta.php'; // Conecta com o Banco
// Registro de Instituição -----------------------------------------------------------------------------------------------------------------------------
if(isset($_POST['registraInstituicao'])){
	$nomeInstituicao=$_POST['nomeInstituicao'];
	$cidadeInstituicao=$_POST['cidadeInstituicao'];
	$emailInstituicao=$_POST['emailInstituicao'];
	if($nomeInstituicao && $cidadeInstituicao && $emailInstituicao){
		require 'php/dbConecta.php';
		$procuraInstituicao=mysql_query("SELECT * FROM `instituicao` WHERE `Nom_instituicao`='$nomeInstituicao'");
		if(mysql_num_rows($procuraInstituicao) > 0){
			echo ("<SCRIPT LANGUAGE='JavaScript'>window.alert('Esta instituição já existe.');window.location.href='index.php';</SCRIPT>");
		}else{
			if(mysql_query("INSERT INTO instituicao(Nom_instituicao, Loc_instituicao, Flg_aproved) VALUES ('$nomeInstituicao', '$cidadeInstituicao', 0)")){
				echo ("<SCRIPT LANGUAGE='JavaScript'>window.alert('Instituição registrada com sucesso!');window.location.href='index.php';</SCRIPT>");
			}
		}
	}else{
		header('location: index.php');
	}
}
// Registro de Alunos -----------------------------------------------------------------------------------------------------------------------------------
if(isset($_POST['registroAluno'])){ // Se o usuário clicou em Cadastrar
	$nomeAluno=mysql_real_escape_string($_POST['nomeAluno']); // Cria varíavel nomeAluno
	$email=mysql_real_escape_string($_POST['email']); // Cria varíavel email
	$password=mysql_real_escape_string($_POST['password']); // Cria varíavel password 
	$turma=mysql_real_escape_string($_POST['turma']); // Cria varíavel disciplina
	$instituicaoAluno=mysql_real_escape_string($_POST['instituicaoAluno']);
    if ("$nomeAluno && $email && $password && $turma")
    {
		require 'php/dbConecta.php'; // Conecta com o Banco
		$sql=mysql_query("SELECT * FROM `aluno` WHERE `Nom_aluno`='$nomeAluno'"); // Procura o Usuário
		if(mysql_num_rows($sql) > 0)
        { // Se o Usuário existir
			echo ("<SCRIPT LANGUAGE='JavaScript'>window.alert('Aluno já existe!');window.location.href='index.php';</SCRIPT>");
		}
        else // Caso o contrário
        {
        	//Cria o codigo da turma e checa se ele já existe no banco de dados
            do
            {
            	$Cod_aluno = rand(111,999);
            	$comp_cod = mysql_query ("SELECT * FROM `aluno` WHERE `Cod_aluno`='$Cod_aluno'");
            
            }
            while(mysql_num_rows($comp_cod) > 0);
            // FIM
			$login_db = $turma.$Cod_aluno;
			if(mysql_query("INSERT INTO aluno(Cod_aluno, Cod_turma, Login, Cod_instituicao, Nom_aluno, Flg_admin, Snh_entrada, Email) VALUES ('$Cod_aluno','$turma', '$login_db', '$instituicaoAluno', '$nomeAluno', 0,'$password','$email')")) // Se Inserir com sucesso
            {
                echo ("<SCRIPT LANGUAGE='JavaScript'>window.alert('Registro registrado com sucesso!');window.location.href='index.php';</SCRIPT>");
				// Mensagem de sucesso            
			}
        	else // Caso o contrário
        	{
				echo ("<SCRIPT LANGUAGE='JavaScript'>window.alert('Erro no registro!');window.location.href='index.php';</SCRIPT>");
				exit();
			}       
		}
	mysql_close(); // Desconecta do Banco
    }
    else
    {
		echo ("<SCRIPT LANGUAGE='JavaScript'>window.alert('Existe um ou mais campo(s) vazio(s).');window.location.href='index.php';</SCRIPT>");
    }
}

// Registro de turma -------------------------------------------------------------------------------------------------------------------------------------------

if(isset($_POST['registroTurma'])){ // Se o usuário clicou em Cadastrar
	$nomeTurma=mysql_real_escape_string($_POST['username']); // Cria varíavel nomeTurma
	$instituicao=mysql_real_escape_string($_POST['instituicao']); // Cria varíavel instituicao
	$ensino=mysql_real_escape_string($_POST['ensino']); // Cria varíavel ensino
	$disciplinas=mysql_real_escape_string($_POST['disciplinas']); // Cria varíavel disciplina
	if ("$nomeTurma && $instituicao && $ensino && $disciplinas"){ 
		require 'php/dbConecta.php'; // Conecta com o Banco
		$sql=mysql_query("SELECT * FROM `turma` WHERE `Nom_turma`='$nomeTurma'"); // Procura o Usuário
		if(mysql_num_rows($sql) > 0){ // Se o Usuário existir
			echo ("<SCRIPT LANGUAGE='JavaScript'>window.alert('Nome da turma já existe');window.location.href='index.php';</SCRIPT>");
		}else{ // Caso o contrário
        	//Cria o codigo da turma e checa se ele já existe no banco de dados
            do{
            	$Cod_turma = rand(111,999);
            	$comp_cod = mysql_query ("SELECT * FROM `turma` WHERE `Cod_turma`='$Cod_turma'");
            }while(mysql_num_rows($comp_cod) > 0);
            // FIM
			if(mysql_query("INSERT INTO turma(Cod_turma, Cod_instituicao, Nom_turma, Gr_ensino, Flg_aproved) VALUES ('$Cod_turma','$instituicao','$nomeTurma','$ensino', 0)")){ // Se Inserir com sucesso
                //Separa as disciplinas em varias strings
				
				$array=explode(";",$disciplinas);
                $array_tam = sizeof($array);
                for ($i = 0; $i < $array_tam; $i++){
                    mysql_query("INSERT INTO disciplinas(Cod_disciplina, Nom_disciplina, Cod_turma) VALUES (0,'$array[$i]','$Cod_turma')");
				}
				
                //FIM
                echo ("<SCRIPT LANGUAGE='JavaScript'>window.alert('Registro de turma efetuado com sucesso!');window.location.href='index.php';</SCRIPT>"); 
				//exit();       
			}
        	else{ // Caso o contrário
				 echo ("<SCRIPT LANGUAGE='JavaScript'>window.alert('Estão faltando dados ou algum dado é inválido.');window.location.href='index.php';</SCRIPT>");
				//exit();
			}           
		}
		//mysql_close(); // Desconecta do Banco
    }else{
		 echo ("<SCRIPT LANGUAGE='JavaScript'>window.alert('Existem um ou mais campo(s) vazio(s)');window.location.href='index.php';</SCRIPT>");
		//exit();
    }
	//header('location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Organize-se</title>
		<link rel="shortcut icon" href="images/icon.ico" type="image/x-icon" />
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<!--[if lte IE 8]><script src="js/html5shiv.js"></script><![endif]-->
        <script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
        <script type="text/javascript" charset="utf-8" src="js/jquery.leanModal.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-layers.min.js"></script>
		<script src="js/init.js"></script>
        <script src="js/modalbox.js"></script>

		<noscript>
			<link rel="stylesheet" href="css/skel.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-xlarge.css"/>
		</noscript>

	</head>
	<body class="landing">

		<!-- Header -->
			<header id="header">
				<nav id="nav">
					<ul>
						<li><a href="#">Home</a></li>
						<li><a href="../Noksebd/Noks/login.php">Login</a></li>
						<li><a href="#registroturma" class="button special " rel="modal" >Registrar turma</a></li>
					</ul>
				</nav>
			</header>

        <!-- turma ----------------------------------------------------------------------------------------------------------------------------------------------------------------->
        <div class="window" id="registroturma" align="center">
			<a href="#" class="fechar">X</a>
			<span style="font-size:30px; margin-bottom:20px;"><h1>Registro da turma</h1></span>

			<form id="loginform" name="loginform" method="post" action="index.php" style="margin-bottom:0;">
				<input type="text" name="username" id="username" class="txtfield" tabindex="1" placeholder="Digite o nome da turma"><br>
				<select name="instituicao" id="instituicao" class="txtfield" tabindex="1">
					<option value="default" class="default" selected="selected">Selecione sua instituição</option>
                    <?php
						$sql2 = "SELECT Nom_instituicao FROM instituicao";
						$total = mysql_query($sql2);
						$sql3 = "SELECT Cod_instituicao FROM instituicao";
						$total2 = mysql_query($sql3);
						$fila2 = mysql_fetch_array($total2);
						while($fila = mysql_fetch_array($total))
						{
							echo "<option value='".$fila2['Cod_instituicao']."'>".$fila['Nom_instituicao']."</option>";
						}
					?>
					<option value=" 1">----------</option>
				</select><br>
				<select name="ensino" id="turma" class="txtfield" tabindex="1">
					<option value="default" class="default" selected="selected">Selecione o Grau de Ensino</option>
					<option value="1">Ensino Fundamental</option>
                    <option value="2">Ensino Médio</option>
                    <option value="3">Ensino Superior</option>
				</select><br>
                <textarea name="disciplinas" id="disciplina" class="textfield" placeholder="Insira as disciplinas separadas por ponto e vírgula (;)"></textarea><br>
				<input type="email" name="email" id="email" class="txtfield" tabindex="1" placeholder="Digite um e-mail para contato    "><br>
				<div class="center"><input type="submit" name="registroTurma" id="loginbtn" class="flatbtn-blu hidemodal" value="Registrar" tabindex="3"></div>

			</form>
		</div>
        <!-- instituição ------------------------------------------------------------------------------------------------------------------------------------------------------------------->
		<div class="window" id="registroinst" align="center">
			<a href="#" class="fechar">X</a>
			<span style="font-size:30px; margin-bottom:20px;"><h1>Registro da Instituição</h1></span>

			<form method="post" action="index.php" style="margin-bottom:0;">
				<input type="text" name="nomeInstituicao" id="nomeInstituicao" class="txtfield" tabindex="1" placeholder="Nome da instituição"><br>

                <input type="text" name="cidadeInstituicao" id="cidadeInstituicao" class="txtfield" tabindex="1" placeholder="Cidade da Instituição"><br>

                <input type="email" name="emailInstituicao" id="emailInstituicao" class="txtfield" tabindex="1" placeholder="Digite um e-mail para contato "><br>
				<div class="center"><input type="submit" name="registraInstituicao" id="registraInstituicao" class="flatbtn-blu hidemodal" value="Registrar" tabindex="3"></div>

			</form>
		</div>
        <!-- aluno ------------------------------------------------------------------------------------------------------------------------------------------------------------------------>
		<div class="window" id="registroaluno" align="center">
			<a href="#" class="fechar">X</a>
			<span style="font-size:30px; margin-bottom:20px;"><h1>Registro do aluno</h1></span>

			<form id="loginform" name="loginform" method="post" action="index.php" style="margin-bottom:0;">
				<input type="text" name="nomeAluno" id="username" class="txtfield" tabindex="1" placeholder="Digite seu nome"><br>
				<select name="instituicaoAluno" id="instituicao" class="txtfield" tabindex="1">
					<option value="default" class="default" selected="selected">Selecione sua instituição</option>
                    <?php
						$sql2 = "SELECT Nom_instituicao FROM instituicao";
						$total = mysql_query($sql2);
						$sql3 = "SELECT Cod_instituicao FROM instituicao";
						$total2 = mysql_query($sql3);
						$fila2 = mysql_fetch_array($total2);
						while($fila = mysql_fetch_array($total))
						{
							echo "<option value='".$fila2['Cod_instituicao']."'>".$fila['Nom_instituicao']."</option>";
						}
					?>
					<option value=" 1">----------</option>
				</select><br>
				<select name="turma" id="turma" class="txtfield" tabindex="1">
                	<option value="default" class="default">Selecione sua turma</option>
					<?php
						$total3 = mysql_query("SELECT Nom_turma FROM turma");
						$total4 = mysql_query("SELECT Cod_turma FROM turma");
						$fila4 = mysql_fetch_array($total4);
						while($fila2 = mysql_fetch_array($total3))
						{
							echo "<option value='".$fila4['Cod_turma']."'>".$fila2['Nom_turma']."</option>";
						}
					?>
                    <option value="1" selected="selected">----------</option>
				</select><br>
				<input type="email" name="email" id="email" class="txtfield" tabindex="1" placeholder="Digite seu email"><br>
				<input type="password" name="password" id="password" class="txtfield" tabindex="2" placeholder="Digite sua senha de acesso"><br>
				<div class="center"><input type="submit" name="registroAluno" id="loginbtn" class="flatbtn-blu hidemodal" value="Registrar" tabindex="3"></div>

			</form>
		</div>

		<!---------------------------------------------------------------------------------------------------------------------------------------------------------------------->

		<div id="mascara"></div>


		<!-- Banner -->
			<section id="banner">
				<h2><img src="images/logo2.png" height="150" width="150" alt="" /></h2>
				<p>Organize sua vida escolar em apenas um clique!</p>
				<ul class="actions">
					<li>
						<a href="#registroaluno" class="button big" rel="modal">Organize-se</a>
					</li>
				</ul>
			</section>

		<!-- One -->
			<section id="one" class="wrapper style1 special">
				<div class="container">
					<header class="major">
						<h2>Noks é o organizador escolar que vai tornar sua vida mais fácil</h2>
						<p>Conheça nossas funcionalidades!</p>
					</header>
					<div class="row 150%">
						<div class="4u 12u$(medium)">
							<section class="box">
								<img src="images/pen.png" height="130" width="130" alt="" />
								<br>
								<br>
								<h3>Controle de notas</h3>
								<p>Faça a entrada e mantenha o controle de suas notas através do nosso sistema de boletim.</p>
							</section>
						</div>
						<div class="4u 12u$(medium)">
							<section class="box">
								<img src="images/cal.png" height="130" width="130" alt="" />
								<br><br>
								<h3>Cronograma da turma</h3>
								<p>Você e sua turma tem a oportunidade de manter completo controle sobre as atividades semanais.</p>
							</section>
						</div>
						<div class="4u$ 12u$(medium)">
							<section class="box">
								<img src="images/arc.png" height="130" width="130" alt="" />
								<br><br>
								<h3>Arquivos da turma</h3>
								<p>Mantenha as atividades dadas em sala em comum conhecimento, aqui você tem acesso a todos os arquivos da sua turma.</p>
							</section>
						</div>
					</div>
				</div>
			</section>

		<!-- Two -->
			<section id="two" class="wrapper style2 special">
				<div class="container">
					<header class="major">
						<h2>Conheça alguns de nossos usuários</h2>
						<p>Estudantes de várias instituições já aprovaram o aplicativo!</p>
					</header>
					<section class="profiles">
						<div class="row">
							<section class="3u 6u(medium) 12u$(xsmall) profile">
								<img src="images/profile_placeholder.gif" height="100" width="100" alt="" />
								<h4>Aluno 1</h4>
								<p>Instituição 1</p>
							</section>
							<section class="3u 6u$(medium) 12u$(xsmall) profile">
								<img src="images/profile_placeholder.gif" height="100" width="100" alt="" />
								<h4>Aluno 2</h4>
								<p>Instituição 2</p>
							</section>
							<section class="3u 6u(medium) 12u$(xsmall) profile">
								<img src="images/profile_placeholder.gif" height="100" width="100" alt="" />
								<h4>Aluno 3</h4>
								<p>Instituição 3</p>
							</section>
							<section class="3u$ 6u$(medium) 12u$(xsmall) profile">
								<img src="images/profile_placeholder.gif" height="100" width="100" alt="" />
								<h4>Aluno 4</h4>
								<p>Instituição 4</p>
							</section>
						</div>
					</section>
					<footer>
						<p>Sua instituição ainda não é cadastrada? Cadastre já, e desfrute com seus colegas os benefícios que Noks pode trazer para vocês!</p>
						<ul class="actions">
							<li>
								<a href="#registroinst" class="button big" rel="modal">Registre sua Instituição</a>
							</li>
						</ul>
					</footer>
				</div>
			</section>

		<!-- Three -->
			<section id="three" class="wrapper style3 special">
				<div class="container">
					<header class="major">
						<h2>O que você achou?</h2>
						<p>Contate-nos e mande suas sugestões, é rápido e prático!</p>
					</header>
				</div>
				<div class="container 50%">
					<form action="#" method="post">
						<div class="row uniform">
							<div class="6u 12u$(small)">
								<input name="name" id="name" value="" placeholder="Nome" type="text">
							</div>
							<div class="6u$ 12u$(small)">
								<input name="email" id="email" value="" placeholder="Email" type="email">
							</div>
							<div class="12u$">
								<textarea name="message" id="message" placeholder="Mensagem" rows="6"></textarea>
							</div>
							<div class="12u$">
								<ul class="actions">
									<li><input value="Sugerir" class="button big" type="submit"></li>
								</ul>
							</div>
						</div>
					</form>
				</div>
			</section>

		<!-- Footer -->
			<footer id="footer">
				<div class="container">
					<section class="links">
						<div class="row">
							<section class="3u 6u(medium) 12u$(small)">
								<h3>Mapa do site</h3>
								<ul class="unstyled">
									<li><a href="#">Home</a></li>
									<li><a href="#">Login</a></li>
									<li><a href="#">Sign up</a></li>
								</ul>
							</section>
							<section class="3u 6u$(medium) 12u$(small)">
								<h3>Contate-nos</h3>
								<ul class="unstyled">
									<li><a href="#">Endereço: Avenida Doutor Antônio Chagas Diniz, 655 - Contagem - MG</a></li>
									<li><a href="#">E-mail: contatoNoks@gmail.com</a></li>
									<li><a href="#">Telefone: (31)7312-7414</a></li>
								</ul>
							</section>
							<section class="3u 6u(medium) 12u$(small)">
							<ul class="unstyled">
								<li>Made in:<img src="images/san.png" height="30" width="100" alt="" /></li>
							</ul>
							<ul class="unstyled">
								<li>Powered by:    <img src="images/cefet.png" height="30" width="50" alt="" /></li>
							</ul>
							</section>
						</div>
					</section>
					<div class="row">
						<div class="8u 12u$(medium)">
							<ul class="copyright">
								<li>Copyright &copy; 2015 Noks. Todos os direitos reservados.</li>
							</ul>
						</div>
						<div class="4u$ 12u$(medium)">
							<ul class="icons">
								<li>
									<a class="icon rounded fa-facebook"><span class="label">Facebook</span></a>
								</li>
								<li>
									<a class="icon rounded fa-twitter"><span class="label">Twitter</span></a>
								</li>
								<li>
									<a class="icon rounded fa-google-plus"><span class="label">Google+</span></a>
								</li>
								<li>
									<a class="icon rounded fa-linkedin"><span class="label">LinkedIn</span></a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</footer>
	</body>
</html>
