<?php
  class Users extends Conexao{

    public function setLogged($nick, $password){
        $pdo = parent::get_instance();
        $sql = "SELECT * FROM users WHERE nick = :n AND password = :p";
        $sql = $pdo->prepare($sql);
        $sql->bindValue(":n", $nick);
        $sql->bindValue(":p", $password);
        $sql->execute();

        if($sql -> rowCount() > 0){
          $sql = $sql->fetch();
          $id = $sql['id'];

          $_SESSION['user'] = $id;

          header("Location: ../view/profile.php?login_sucess");
        } else {
            echo "<script> alert('usuário e/ou senha incorretos.'); </script>";
            echo "<script> window.location.href = '../../index.php' </script>";
            exit;
        }
    }
    public function logout(){
        unset($_SESSION['user']);
    }
}
