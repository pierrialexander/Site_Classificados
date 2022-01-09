<?php require_once 'pages/header.php'; ?>
<?php
  if(empty($_SESSION['clogin'])) {
?>
    <script type="text/javascript">window.location.href="login.php";</script>
<?php 
    exit;
  }
?>

<div class="container">
  <br>
  <h1>Meus Anúncios</h1>
  <br>
  <a href="add-anuncio.php" class="btn btn-success">Adicionar Anúncio</a>
  <br><br>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Foto</th>
        <th>Titulo</th>
        <th>Valor</th>
        <th>Ações</th>
      </tr>
    </thead>
    
    <?php
      require 'classes/anuncios.class.php';
      global $pdo;
      $a = new Anuncios(); // instanciar objeto "a" da classe Anuncios.
      $anuncios = $a->getMeusAnuncios(); // essa função trará para a variável um array com todos os anuncios

      foreach($anuncios as $anuncio) :
    ?>

      <tr>
        <td>
          <?php if(!empty($anuncio['url'])): ?>
            <img src="assets/images/anuncios/<?php $anuncio['url']; ?>" height="50" border="0"/>
          <?php else: ?>
            <img src="assets/images/default.jpg" height="50" border="0"/>
          <?php endif; ?>
        </td>
        <td><?php echo $anuncio['titulo']; ?></td>
        <td><?php echo number_format($anuncio['valor'], 2); ?></td>
        <td>
          <a class="btn btn-primary"href="editar-anuncio.php?id=<?php echo $anuncio['id']; ?>">Editar</a>
          <a class="btn btn-warning"href="excluir-anuncio.php?id=<?php echo $anuncio['id']; ?>">Excluir</a>
        </td>
      </tr>

    <?php endforeach; ?>
      

  </table>
</div>

<?php require_once 'pages/footer.php'; ?>