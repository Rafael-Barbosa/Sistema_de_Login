<?php

session_start();
$msg = $_SESSION['msg'];
session_destroy();
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>Proton Robotics</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/w3.css" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
	</head>
	<body class="is-preload">
		<script type="text/javascript" src="assets/js/wz_tooltip.js"></script>
		<script type="text/javascript" src="assets/js/jquery.min.js"></script>
		<script type="text/javascript" src="assets/js/TweenMax.min.js"></script>
		<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
		<!-- Wrapper -->
		<div id="wrapper">

				<!-- Main -->
			<section id="main">
					<header>

					  <span class="avatar"><img id="rotate" src="images/avatar.jpg" alt="" /></span>
						<h1>Proton Robotics</h1>
						<p>Um Novo Jeito de Aprender o Futuro</p>
					</header>
						<!-- <h2>Entre</h2> -->
						<form method="POST"  action="Login/controller/LoginController.php">
							<div class="fields">
								<div class="field">
									<input type="text" name="nick"  class="form-control field" placeholder="Nick" required autofocus/>
								</div>
								<div class="field">
									<input type="password" name="password"  class="form-control field" placeholder="Senha" required />
								</div>
								<ul class="actions special" >
								<button class="btn btn-lg btn-success btn-block" id="entrar" type="submit">
									 <i class="fa fa-lock"></i> Entrar
								</button>
								</ul>
							</form>
							</div>

							<div class="expander0" >
								<a id="Esqueci">Esqueci minha senha</a></div>
									<div class="content0">
										<form method="POST"  action="Login/controller/control.password.php">
											<div class="fields">
												<div class="field">
													<input type="text" name="email"  class="form-control field" placeholder="Email" required autofocus/>
												</div>
												<ul class="actions special " >
												<button class="btn-primary" id="esqueci" type="submit">
													 <i class="fas fa-paper-plane"></i> Enviar
												</button>
												</ul>
											</form>
								</div>
							</div>


						  	<div class="expande" >
									<a id="cadastro">Cadastrar</a></div>
									<div class="header-novo">
	  								<div class="content">
											<form method="POST"  action="Login/controller/control.cadastro.php">
												<div class="fields">
													<div class="field">
														<input type="text" name="Nome"  class="form-control field" placeholder="Nome" required autofocus/>
													</div>
													<div class="field">
														<input type="text" name="nick"  class="form-control field" placeholder="Nick" required autofocus/>
													</div>
													<div class="field">
														<input type="text" name="email"  class="form-control field" placeholder="email@email" required autofocus/>
													</div>
													<div class="field">
														<input type="password" name="password"  class="form-control field" placeholder="Senha" required />
													</div>
													<div class="field">
														<input type="password" name="confirmarSenha"  class="form-control field" placeholder="Confirmar Senha" required />
													</div>
													<ul class="actions special " >
													<button class="btn-primary" id="entrar" type="submit">
														 <i class="fas fa-paper-plane"></i> Enviar
													</button>
													</ul>
												</form>
 								</div>
						</div>

						<div id="msg">

							<?php
								if ($msg == 1){
							?>
										<div  class="w3-panel w3-pale-red w3-border">
											<p>Esse Nick já existe !!!</p>
										</div>
							<?php	} ?>
							<?php
								if ($msg == 2){
							?>
										<div  class="w3-panel w3-pale-red w3-border">
											<p>Esse e-mail já está cadastrado !!!</p>
										</div>
							<?php	} ?>
							<?php
								if ($msg == 3){
							?>
										<div class="w3-panel w3-pale-yellow w3-border">
													<p>Verifique o seu email para confirmar cadastro</p>
										</div>
							<?php	} ?>
							<?php
								if ($msg == 4){
							?>
										<div class="w3-panel w3-pale-yellow w3-border">
													<p>Senha está diferente</p>
										</div>
							<?php	} ?>
						</div>


						Acesse nossas Redes
						<footer>
							<ul class="icons">
								<li><a href="#" class="icon brands fa-twitter">Twitter</a></li>
								<li><a href="#" class="icon brands fa-instagram">Instagram</a></li>
								<li><a href="#" class="icon brands fa-facebook-f">Facebook</a></li>
								<li><a href="#" class="icon brands fa-youtube">Youtube</a></li>
							</ul>
						</footer>
					</section>

				<!-- Footer -->
					<footer id="footer">
						<ul class="copyright">
							<li>&copy; Proton Robotics</li>
						</ul>
					</footer>

		  </div>

		<!-- Scripts -->
		<script>
			if ('addEventListener' in window) {
				window.addEventListener('load', function() { document.body.className = document.body.className.replace(/\bis-preload\b/, ''); });
				document.body.className += (navigator.userAgent.match(/(MSIE|rv:11\.0)/) ? ' is-ie' : '');
			}

			$('#cadastro').click(function() {
		  var toggle = $(".content");
		  if(!toggle.attr('initH')) toggle.attr('initH', toggle.height());
			console.log(toggle.height());

		  if($(".content").height() != 0) {
		    TweenMax.to(toggle, .2, {height: 0});
		  }
		  else {
		    TweenMax.to(toggle, .2, {height: 400});
		  }
		})

		$('#Esqueci').click(function() {
		var toggle = $(".content0");
		if(!toggle.attr('initH')) toggle.attr('initH', toggle.height());
		console.log(toggle.height());

		if($(".content0").height() != 0) {
			TweenMax.to(toggle, .2, {height: 0});
		}
		else {
			TweenMax.to(toggle, .2, {height: 200});
		}
	})

		TweenMax.to("#rotate", 20, {rotation:360, ease:Linear.easeNone, repeat:-1})

		</script>
	</body>
</html>
