<?php
  class Usuarios {

    
    // FUNÇÃO PARA CADASTRAR USUARIO NOVO
    public function cadastrar($nome, $email, $senha, $telefone) {
      global $pdo;
      $sql = $pdo->prepare("SELECT id from usuarios where email = :email");
      $sql->bindValue(':email', $email);
      $sql->execute();

      if($sql->rowCount() == 0) {

        $sql = $pdo->prepare("INSERT INTO usuarios SET nome = :nome, email = :email, senha = :senha, telefone = :telefone");
        $sql->bindValue(':nome', $nome);
        $sql->bindValue(':email', $email);
        $sql->bindValue(':senha', md5($senha));
        $sql->bindValue(':telefone', $telefone);

        $sql->execute();

        return true;

      } else {
        return false;
      }

    }

    // FUNÇÃO CARA EFETUAR O LOGIN

    public function login ($email, $senha) {
      global $pdo;

      $sql = $pdo->prepare("SELECT id, nome from usuarios where email = :email and senha = :senha");
      $sql->bindValue(':email', $email);
      $sql->bindValue(':senha', md5($senha));
      $sql->execute();

      if($sql->rowCount() > 0) {
        $dado = $sql->fetch();
        $_SESSION['clogin'] = $dado['id'];
        $_SESSION['cNome'] = $dado['nome'];
        return true;
      } else {
        return false;
      }

    }

         
  }
?>