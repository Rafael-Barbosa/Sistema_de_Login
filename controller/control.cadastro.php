<?php
session_start();


include('../model/Conexao.class.php');
include('../model/Cadastrar.class.php');

$u = new Inserir;

if(isset($_POST ['Nome'])){

  $Nome = addslashes($_POST['Nome']);
  $nick = addslashes($_POST['nick']);
  $password = addslashes($_POST['password']);
  $confirmarSenha = addslashes($_POST['confirmarSenha']);
  $email = addslashes($_POST['email']);

  if(!empty($Nome) && !empty($nick) && !empty($email) && !empty($password))
  {

    $verifica = false;
    $pdo = Conexao::get_instance();
    $sql= $pdo->prepare("SELECT id FROM users WHERE nick = :n");
    $sql->bindValue(":n",$nick);
    $sql->execute();
    if($sql->rowCount() > 0){
      $_SESSION['msg'] = 1;
      echo "<script> window.location.href = '../../index.php' </script>";


    }else{
    $verifica = true;
    }
    if ($verifica == true){
      $pdo = Conexao::get_instance();
      $sql= $pdo->prepare("SELECT id FROM users WHERE email = :e");
      $sql->bindValue(":e",$email);
      $sql->execute();

      if($sql->rowCount() > 0){
      $_SESSION['msg'] = 2;
      echo "<script> window.location.href = '../../index.php' </script>";
      /*echo "<script> alert('Esse email já existe'); </script>";*/
    }$verifica = false;
    $pdo = Conexao::get_instance();
    $sql= $pdo->prepare("SELECT id FROM users WHERE nick = :n");
    $sql->bindValue(":n",$nick);
    $sql->execute();
    if($sql->rowCount() > 0){
      $_SESSION['msg'] = 1;
      echo "<script> window.location.href = '../../index.php' </script>";


    }else{
    $verifica = true;
    }
    if ($verifica == true){
      $pdo = Conexao::get_instance();
      $sql= $pdo->prepare("SELECT id FROM users WHERE email = :e");
      $sql->bindValue(":e",$email);
      $sql->execute();

      if($sql->rowCount() > 0){
      $_SESSION['msg'] = 2;
      echo "<script> window.location.href = '../../index.php' </script>";
      /*echo "<script> alert('Esse email já existe'); </script>";*/
      }
      elseif($password == $confirmarSenha){
        $ativacao_code = md5(rand());
        if($u->cadastrar($Nome, $nick, $password, $email, $ativacao_code)){

          $base_url = "http://localhost:8080/Login/";
          $mail_body = "
    			<p>Oi ".$_POST['nick'].",</p>
    			<p>Por Favor clique nesse link para ativar o seu login - ".$base_url."email_verification.php?activation_code=".$ativacao_code."
    			<p>Obrigado,<br />Proton Robotics</p>
    			";


          require '../model/class.phpmailer.php';
        	$mail = new PHPMailer;
          $mail->IsSMTP();								//Sets Mailer to send message using SMTP
        	$mail->Host = 'mail.com.br';		//Sets the SMTP hosts of your Email hosting, this for Godaddy
        	$mail->Port = '465';								//Sets the default SMTP server port
          $mail->SMTPAuth = true;							//Sets SMTP authentication. Utilizes the Username and Password variables
        	$mail->Username = 'naoresponder@com.br';					//Sets SMTP username
        	$mail->Password = '';					//Sets SMTP password
        	$mail->SMTPSecure = 'ssl';							//Sets connection prefix. Options are "", "ssl" or "tls"
        	$mail->From = 'naoresponder@.com.br';			//Sets the From email address for the message
        	$mail->FromName = 'Proton Robotics';					//Sets the From name of the message
        	$mail->AddAddress($_POST['email']);		//Adds a "To" address
        	$mail->WordWrap = 50;							//Sets word wrapping on the body of the message to a given number of characters
        	$mail->IsHTML(true);							//Sets message type to HTML
        	$mail->Subject = 'Validando Email';			//Sets the Subject of the message
        	$mail->Body = $mail_body;
          if($mail->Send()){
          $_SESSION['msg'] = 3;
          echo "<script> window.location.href = '../../index.php' </script>";
          }
           /*echo "<script> alert('cadastro com sucesso'); </script>";*/
        }
      }else{
        $_SESSION['msg'] = 4;
        echo "<script> window.location.href = '../../index.php' </script>";
        /*echo "<script> alert('senha não confere'); </script>";*/
      }
    }
  }
}

?>
