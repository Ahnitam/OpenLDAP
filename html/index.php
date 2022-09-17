<?php 
// Carregando arquivo ldap/ldap.php
include("ldap/ldap.php");
// Carregando informalçoes do usúario
$user = loadUserInfo();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Home</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
	<nav class="navbar navbar-expand-lg bg-light">
		<div class="container-fluid">
			<a class="navbar-brand" href="index.php">Home</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarScroll">
				<ul class="navbar-nav">
					<!-- Faz a verificação do grupo do usúario para adicionar apenas o que ele tem acesso -->
					<?php if ($user["group"] == "gerentes") { echo('<li class="nav-item"><a class="nav-link" href="gerenciar.php">Gerenciar</a></li>'); } ?>
					<?php if ($user["group"] == "gerentes" || $user["group"] == "vendedores") { echo('<li class="nav-item"><a class="nav-link" href="vendas.php">Vendas</a></li>'); } ?>
				</ul>
			</div>
			<!-- Verifica se o usúario está logado para adicionar um botão de logout
			Ou se o usúario não está logado para adicionar um botão de login -->
			<div class="d-flex"><?php if ($user["auth"]) { echo('<a href="logout.php"><button class="btn btn-outline-danger">Sair</button></a>'); }else{ echo('<a href="login.php"><button class="btn btn-outline-primary">Login</button></a>'); } ?></div>
		</div>
	</nav>
	<div class="container-login100" style="background-image: url('images/bg-01.jpg');">
		<div class="container text-center">
			<!-- Se o usúario estiver logado será exibido o seu nome e o grupo ao qual ele pertence -->
			<!-- Caso o usúario não eseteja logado será exibido uma mensagem para ele fazer o Login e um botão de login -->
			<div class="row"><h1><?php if ($user["auth"]) { echo $user["name"]; }else{ echo "Faça o Login"; } ?></h1></div>
			<div class="row"><h3><?php if ($user["auth"]) { echo "Grupo: ".$user["group"]; } ?> </h3></div>
			<?php if (!$user["auth"]) { echo('<div class="row"><a href="login.php"><button class="btn btn-outline-primary btn-lg">Login</button></a></div>'); } ?>
		</div>	
	</div>
	<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<!--===============================================================================================-->
	<script src="js/main.js"></script>
</body>
</html>