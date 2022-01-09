<?php require_once 'pages/header.php'; ?>


<div class="container">
  <br>
    <h1>Cadastre-se</h1>
  <br>
    <?php
    require_once 'classes/usuarios.class.php';
    $u = new Usuarios();
    if (isset($_POST['nome']) && !empty($_POST['nome'])) {
        $nome = addslashes($_POST['nome']);
        $email = addslashes($_POST['email']);
        $senha = $_POST['senha'];
        $telefone = addslashes($_POST['telefone']);

        if (!empty($nome) && !empty($email) && !empty($senha) && !empty($telefone)) {
              if ($u->cadastrar($nome, $email, $senha, $telefone)) {
                  ?>
                  
                  <!--MENSAGEM DE ALERTA-->
                  <div class="alert alert-success">
                    <strong>Parabéns</strong>, cadastro efetuado com sucesso! <a href="login.php" class="alert-link">Faça o login agora!</a>
                  </div>
                  
                  <?php
                }else {
                  ?>
                  
                    <!--MENSAGEM DE ALERTA-->
                    <div class="alert alert-warning">
                      Este usuário já exite! <a href="login.php" class="alert-link">Faça o login agora!</a>
                    </div>

                <?php
                }
        } else {
          ?>

          <!--MENSAGEM DE ALERTA-->
          <div class="alert alert-warning">
            Por favor, preencha todos os campos!
          </div>

          <?php
        }
    }
    ?>


    <!--INICIO DO FORMULÁRIO-->
    <form action="" method="POST">
      <div class="form-group">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" class="form-control">
      </div>
      <div class="form-group">
        <label for="email">E-mail:</label>
        <input type="text" name="email" id="email" class="form-control">
      </div>
      <div class="form-group">
        <label for="senha">Senha:</label>
        <input type="password" name="senha" id="senha" class="form-control">
      </div>
      <div class="form-group">
        <label for="telefone">Telefone:</label>
        <input type="text" name="telefone" id="telefone" class="form-control">
      </div>
      <input type="submit" class="btn btn-success" value="Cadastrar">
    </form>
    <!--FINAL DO FORMULÁRIO-->
</div>

<?php require_once 'pages/footer.php'; ?>

 