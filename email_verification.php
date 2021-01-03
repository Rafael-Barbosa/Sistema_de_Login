<?php

include('model/Conexao.class.php');
session_start();


$message = '';


$pdo = Conexao::get_instance();

if(isset($_GET['activation_code']))
{
	$query = "
		SELECT * FROM users
		WHERE ativacao_code = :a
	";

	$statement = $pdo->prepare($query);

	$statement->execute(
		array(
			':a'			=>	$_GET['activation_code']
		)
	);
	$no_of_row = $statement->rowCount();

	if($no_of_row > 0)
	{

		$result = $statement->fetchAll();
		foreach($result as $row)
		{
			if($row['email_status'] == 'not verified')
			{
				$update_query = "
				UPDATE users
				SET email_status = 'verified'
				WHERE id = '".$row['id']."'
				";
				$statement = $pdo->prepare($update_query);
				$statement->execute();
        header("Refresh:0");
				$sub_result = $statement->fetchAll(PDO::FETCH_COLUMN, 0);
				if(isset($sub_result))
				{

					$message = '<label class="text-success">Seu email foi Verificado com Sucesso <br />You can login here - <a href="login.php">Login</a></label>';
				}
			}
			else
			{
				$message = '<label class="text-info">Seu email foi verificado</label>';
			}
		}
	}
	else
	{
		$message = '<label class="text-danger">Link Inválido</label>';
	}
}

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Verificação de Email</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</head>
	<body>

		<div style="text-align: center" class="container">
			<h1 align="center">Verificação de Email</h1>


			<h3 align="center"><?php echo $message; ?></h3>
      <img  style="width:25%;" src="../proton-site/img/drproton.png" alt="">

		</div>

	</body>

</html>
