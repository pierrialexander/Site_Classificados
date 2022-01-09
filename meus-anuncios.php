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
          <?php if(!empty($anuncio['url_img'])): ?>
            <img src="assets/images/anuncios/<?php echo $anuncio['url_img']; ?>" height="50"/>
          <?php else: ?>
            <img src="assets/images/default.jpg" height="50"/>
          <?php endif; ?>
        </td>
        <td><?php echo $anuncio['titulo']; ?></td>
        <td>R$ <?php echo number_format($anuncio['valor'], 2); ?></td>
        <td>
          <a class="btn btn-primary" href="editar-anuncio.php?id=<?php echo $anuncio['id']; ?>">Editar</a>
          
          <form action="excluir-anuncio.php?id=<?php echo $anuncio['id']; ?>" method="POST" style="display: inline;" onsubmit="confirmarExclusao(event, this)">
            <input type="hidden" name="id" value="<?php echo $anuncio['id']; ?>">
            <button class="btn btn-warning">Excluir</button>
          </form>
          
        
        </td>
      </tr>

    <?php endforeach; ?>
      

  </table>
</div>

<!--CONFIRMAR A EXCLUSÃO DO ANUNCIO-->
<script type="text/javascript">
  function confirmarExclusao(event, form) {
    event.preventDefault();
    let decision = confirm("Confirmar a exclusão do anúncio?")
    if (decision) {
      form.submit();
    }
  }
</script>

<?php require_once 'pages/footer.php'; ?>