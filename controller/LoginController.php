<?php

  session_start();

  include_once ('../model/Conexao.class.php');
  include_once ('../model/Users.class.php');

  $users = new Users();

  $nick = addslashes($_POST['nick']);
  $password = md5($_POST['password']);

  if(isset($_POST['nick']) && !empty($_POST['nick'])) {
    $users->setLogged($nick, $password);
  }

 ?>
