<?php require_once 'pages/header.php'; ?>
<?php
  // VERIFICAMOS SE SESSÃO ESTÁ LOGADA
  if(empty($_SESSION['clogin'])) {
?>
    <script type="text/javascript">window.location.href="login.php";</script>
<?php 
    exit;
}


  // ADICIONAMOS ANUNCIO
  require 'classes/anuncios.class.php';
  $a = new Anuncios();
  if (!empty($_POST['titulo']) && isset($_POST['titulo'])) :
    $titulo = addslashes($_POST['titulo']);
    $categoria = addslashes($_POST['categoria']);
    $valor = addslashes($_POST['valor']);
    $descricao = addslashes($_POST['descricao']);
    $estado = addslashes($_POST['estado']);

    $a->addAnuncio($titulo, $categoria, $valor, $descricao, $estado);    
?>
    <br>
    <div class="alert alert-success container">
      Anuncio adicionado com sucesso!
    </div>
    
  
<?php
  endif;
?>

<div class="container">
  <br>
  <h1>Adicionar Anúncio</h1>
  <br>
  <form action="" method="POST" enctype="multipart/form-data">
    
  <div class="form-group">
      <label for="categoria">Categoria:</label>
      <select name="categoria" id="categoria" class="form-control">
        <?php
         require_once 'classes/categorias.class.php';
         $c = new Categorias();
         $cats = $c->getLista();
         foreach($cats as $cat):
        ?>
          <option value="<?php echo $cat['id']; ?>"><?php echo $cat['nome']; ?></option>
        <?php endforeach; ?> 
      </select>
  </div>
  <div class="form-group">
      <label for="titulo">Título:</label>
      <input type="text" name="titulo" id="titulo" class="form-control"/>
  </div>
  <div class="form-group">
      <label for="valor">Valor:</label>
      <input type="text" name="valor" id="valor" class="form-control"/>
  </div>
  <div class="form-group">
      <label for="descricao">Descrição:</label>
      <textarea name="descricao" class="form-control"></textarea>
  </div>
  <div class="form-group">
      <label for="estado">Status de Conservação:</label>
      <select name="estado" id="estado" class="form-control">
        <option value="0">Ruim</option>
        <option value="1">Bom</option>
        <option value="2">Ótimo</option>
      </select>
  </div>
  <input type="submit" value="Adicionar" class="btn btn-success">
  </form>
</div>

<?php require_once 'pages/footer.php'; ?>