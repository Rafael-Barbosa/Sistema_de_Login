<?php

include('../model/Conexao.class.php');
session_start();

if(isset($_POST['email'])){

  $email = addslashes($_POST['email']);

  if(!empty($email))
  {

    $pdo = Conexao::get_instance();
    $sql = "SELECT * FROM users WHERE email = :e";
    $sql = $pdo->prepare($sql);
    $sql->bindValue(":e", $email);
    $sql->execute();

    if($sql -> rowCount() > 0){

      $sql = $sql->fetch();
      $code = $sql['ativacao_code'];

      $base_url = "http://localhost:8080/Login/";  //change this baseurl value as per your file path
      $mail_body = "
      <p>Olá,</p>
      <p>Por Favor clique nesse link para mudar sua senha - ".$base_url."forget_password.php?code=".$code."
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
      $mail->From = '';			//Sets the From email address for the message
      $mail->FromName = 'Proton Robotics';					//Sets the From name of the message
      $mail->AddAddress($_POST['email']);		//Adds a "To" address
      $mail->WordWrap = 50;							//Sets word wrapping on the body of the message to a given number of characters
      $mail->IsHTML(true);							//Sets message type to HTML
      $mail->Subject = 'Trocar de Senha';			//Sets the Subject of the message
      $mail->Body = $mail_body;
      if($mail->Send()){
      $_SESSION['msg'] = 5;
      echo "<script> window.location.href = '../../index.php' </script>";
      }
    }else{
      $_SESSION['msg'] = 6;
      echo "<script> window.location.href = '../../index.php' </script>";
      }
  }
}
?>
