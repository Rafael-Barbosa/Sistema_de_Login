<?php

include('model/Conexao.class.php');
session_start();

$message='';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$senha = addslashes($_POST['senha']);
	$confirmarSenha = addslashes($_POST['confirmarSenha']);
	$code = $_GET['code'];

		if($senha == $confirmarSenha){
			$pdo = Conexao::get_instance();
			$sql = "SELECT * FROM users WHERE ativacao_code = :a";
			$sql = $pdo->prepare($sql);
			$sql->bindValue(":a", $code);
			$sql->execute();

				if($sql -> rowCount() > 0){
					$sql = $sql->fetch();
					$email = $sql['email'];
					$password=md5($senha);
					$update_query = "
						UPDATE users
						SET password = '$password'
						WHERE ativacao_code = '".$code."'
						";
					$sql = $pdo->prepare($update_query);
					$sql->execute();
						if($sql->rowCount() > 0)
							{
									$message = '<label class="text-success">Sua Senha foi trocada com Sucesso <br />Faça o  Login Aqui - <a href="login.php">Login</a></label>';
							}else{
								$message = '<label class="text-info">Sua Senha Já foi trocada</label>';
							}
					}
		  }
  }

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Mudar Senha</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</head>
	<body>

		<div style="text-align: center" class="container">
			<h1 align="center">Nova Senha</h1>



      <form  method="POST">
        <div style="width: 40%; padding: 5px;" class="container">
            <input type="text" name="senha"  class="form-control field" placeholder="Nova Senha" required autofocus/>
            <br>
            <input type="text" name="confirmarSenha"  class="form-control field" placeholder="Confirmar Senha" required autofocus/>
            <br>
          <ul class="actions special " >
          <button class="btn-primary" id="esqueci" type="submit">
            Enviar
          </button>
          </ul>
        </form>
      </div>

			<h3 align="center"><?php echo $message; ?></h3>

      <img  style="width:25%;" src="../proton-site/img/drproton.png" alt="">

		</div>

	</body>

</html>
