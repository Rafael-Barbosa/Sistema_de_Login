<?php


class Inserir extends Conexao{

    public function cadastrar($Nome, $nick, $password, $email, $ativacao_code){

    $pdo = parent::get_instance();
    //Verifica se já existe o email
    $sql= $pdo->prepare("SELECT id FROM users WHERE email = :e");
    $sql->bindValue(":e",$email);
    $sql->execute();

    if($sql->rowCount() > 0){
    return false;
    }else {
    //caso não esteja, cadastrar -->
    $sql = $pdo->prepare("INSERT INTO users (Nome, nick, password, email, ativacao_code) VALUES (:m, :n, :p, :e, :a)");
    $sql->bindValue(":m",$Nome);
    $sql->bindValue(":n",$nick);
    $sql->bindValue(":p",md5($password));
    $sql->bindValue(":e",$email);
    $sql->bindValue(":a",$ativacao_code);
    $sql->execute();
    return true;
    }
    }
}



 ?>
