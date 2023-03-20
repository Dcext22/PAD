<?php
session_start();
ob_start();
include_once 'conexao.php';


if((!empty($_SESSION['id'])) AND (!empty($_SESSION['nome']))){
    header("Location: index2.php");
}
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>Doação</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body>

		
		<!-- Header -->
			<header id="header" class="alt">
				<div class="logo"><a href="index.html">Doação<span> Combate a fome</span></a></div>
				<a href="#menu">Menu</a>
			</header>

		<!-- Nav -->
			<nav id="menu">
				<ul class="links">
					<li><a href="index.html">Inicio</a></li>
					<li><a href="sobre.html">Sobre</a></li>
					<li><a href="cadastro.php">Cadastro</a></li>
					<li><a href="login.php">Login</a></li>
			</ul>
			</nav>
			

		<!-- Banner -->
			<section class="banner full">
				<article>
					<img src="/img/menu/templete1.jpg" alt="" />
					<div class="inner">
						<header>
							<p>Bem vindo!!! <a href="https://templated.co"></a></p>
							<h2>Doação</h2>
						</header>
					</div>
				</article>
				<article>
					<img src="..//img//menu//templete2.jpg" alt="" />
					<div class="inner">
						<header>
							<p>Doar!!! <a href="https://templated.co"></a></p>
							<h2>Doação</h2>
						</header>
					</div>
				</article>
				<article>
					<img src="..//img//menu//templete3.jpg"  alt="" />
					<div class="inner">
						<header>
							<p></p>
							<h2></h2>
						</header>
					</div>
				</article>
				<article>
					<img src="..//img//menu//templete4.jpg"  alt="" />
					<div class="inner">
						<header>
							<p></p>
							<h2></h2>
						</header>
					</div>
				</article>
				<article>
					<img src="..//img//menu//templete5.jpg"  alt="" />
					<div class="inner">
						<header>
							<p></p>
							<h2></h2>
						</header>
					</div>
				</article>
			</section>

		<!-- One -->
			<section id="one" class="wrapper style2">
				<div class="inner">
					<div class="grid-style">

						<div>
							<div class="box">
								<div class="image fit">
									<img src="/img//menu//Carlo-Silva.jpg" alt="" />
								</div>
								<div class="content">
									<header class="align-center">
										<p>Origem</p>
										<h2>Resumo</h2>
									</header>
									<p> Estamos a realizar um projeto "para quem doar" com iniciativa do nosso orientador Carlos Revoredo, professor da universidade "Politecnica de Pernambuco"  </p>
									<footer class="align-center">
										<a href="generic.html" class="button alt">ler mais</a>
									</footer>
								</div>
							</div>
						</div>

						<div>
							<div class="box">
								<div class="image fit">
									<img src="//img//menu//templeteupe.png" alt="" />
								</div>
								<div class="content">
									<header class="align-center">
										<p>EM BREVE!!!</p>
										<h2>Doação e Caridade</h2>
									</header>
									<p> Nosso ideia com o este site é construir uma ponte entre o doador e a instituição carente. </p>
									<footer class="align-center">
										<a href="generic.html" class="button alt">ler mais</a>
									</footer>
								</div>
							</div>
						</div>

					</div>
				</div>
			</section>

		<!-- Two -->
			<section id="two" class="wrapper style3">
				<div class="inner">
					<header class="align-center">
						<p>surgimento da ideia</p>
						<h2>Politécnica de Pernambuco. 2022</h2>
					</header>
				</div>
			</section>

		<!-- Three -->
			<section id="three" class="wrapper style2">
				<div class="inner">
					<header class="align-center">
						<p class="special">	O ceú tem limite mas a sua imaginação não</p>
						<h2>Crie desenhe,escreva,imagine</h2>
					</header>
					<div class="gallery">
						<div>
							<div class="image fit">
								<a href="#"><img src="..//img//menu//Carlo-Silva.jpg" alt="" /></a>
							</div>
						</div>
						<div>
							<div class="image fit">
								<a href="#"><img src="..//img//menu//templeteupe.png" alt="" /></a>
							</div>
						</div>
						<div>
							<div class="image fit">
								<a href="#"><img src="..//img//menu//templete2.jpg" alt="" /></a>
							</div>
						</div>
						<div>
							<div class="image fit">
								<a href="#"><img src="..//img//menu//templete1.jpg" alt="" /></a>
							</div>
						</div>
					</div>
				</div>
			</section>


		<!-- Footer -->
			<footer id="footer">
				<div class="container">
					<ul class="icons">
						<li><a href="https://twitter.com/ProjetoPad" class="icon fa-twitter" target="_blank"><span class="label">Twitter</span></a></li>
						<li><a href="https://www.facebook.com/profile.php?id=100083673938894" class="icon fa-facebook" target="_blank"><span class="label">Facebook</span></a></li>
						<li><a href="https://www.instagram.com/projeto_pad/?next=%2F" class="icon fa-instagram" target="_blank"><span class="label">Instagram</span></a></li>
						<li><a href="#" class="icon fa-envelope-o" target="_blank"><span class="label">Email</span></a></li>
					</ul>
				</div>
				<div class="copyright">
					&copy; TELECORP COORPORAÇÃO.
				</div>
			</footer>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrollex.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>
			
	</body>
</html>
        <script class="robo" src="https://www.gstatic.com/dialogflow-console/fast/messenger/bootstrap.js?v=1"></script>
			<df-messenger
			  intent="WELCOME"
			  chat-title="AGENTE_PED"
			  agent-id="02fc701b-5340-4d14-8c10-cdb3f59e86ba"
			  language-code="pt-br"
			></df-messenger>