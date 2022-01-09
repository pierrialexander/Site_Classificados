<?php require_once 'config.php' ?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <title>Sistema de Classificados</title>
</head>
<body>

  <!--INICIO DA NAVBAR-->
  <nav class="navbar bg-success">
    <div class="container-fluid">
      <div class="navbar-header">
        <a href="./" class="nav-link text-light">Classificados Lucav</a>
      </div>
      <ul class="nav justify-content-end">

          <?php if (isset($_SESSION['clogin']) && !empty($_SESSION['clogin'])): ?>
              <li class="nav-item">
                <a href="#" class="nav-link active text-light font-weight-bold">Seja bem vindo: <?php echo $_SESSION["cNome"] ?></a>
              </li>
              <li class="nav-item">
                <a href="meus-anuncios.php" class="nav-link active text-light font-weight-bold">Meus Anúncios</a>
              </li>
              <li class="nav-item">
                <a href="sair.php" class="nav-link active text-light font-weight-bold">Sair</a>
              </li>
          <?php else: ?>  
              <li class="nav-item">
                <a href="cadastre-se.php" class="nav-link active text-light font-weight-bold">Cadastre-se</a>
              </li>
              <li class="nav-item">
                <a href="login.php" class="nav-link active text-light font-weight-bold">Login</a>
              </li>
          <?php endif; ?>
          
      </ul>
    </div>  
  </nav>
  <!--FINAL DA NAVBAR-->