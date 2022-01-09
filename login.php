<?php require_once 'pages/header.php'; ?>


<div class="container">
  <br>
    <h1>Fazer Login</h1>
  <br>
    <?php
    require_once 'classes/usuarios.class.php';
    $u = new Usuarios();
    if (isset($_POST['email']) && !empty($_POST['email'])) {
        $email = addslashes($_POST['email']);
        $senha = $_POST['senha'];

        if ($u->login($email, $senha)) {
          ?>
            <script type="text/javascript">window.location.href='./'</script>
          <?php
        } else {
          // MENSAGEM DE ERRO DE LOGIN
          ?>
          <div class="alert alert-danger">
            Usuario e/ou senha incorretos!
          </div>
          <?php
        }

    } 
    ?>
    <!--INICIO DO FORMULÁRIO-->
    <form action="" method="POST">
      
      <div class="form-group">
        <label for="email">E-mail:</label>
        <input type="text" name="email" id="email" class="form-control">
      </div>
      <div class="form-group">
        <label for="senha">Senha:</label>
        <input type="password" name="senha" id="senha" class="form-control">
      </div>
      
      <input type="submit" class="btn btn-success" value="Fazer Login">
    </form>
    <!--FINAL DO FORMULÁRIO-->
</div>

<?php require_once 'pages/footer.php'; ?>

 