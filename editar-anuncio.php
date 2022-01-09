<?php require_once 'pages/header.php'; ?>
<?php
  // VERIFICAMOS SE SESSÃO ESTÁ LOGADA
  if(empty($_SESSION['clogin'])) {
?>
    <script type="text/javascript">window.location.href="login.php";</script>
<?php 
    exit;
}


  // RECEBE E EDITA O ANUNCIO
  require 'classes/anuncios.class.php';
  $a = new Anuncios();
  if (!empty($_POST['titulo']) && isset($_POST['titulo'])) :
    $titulo = addslashes($_POST['titulo']);
    $categoria = addslashes($_POST['categoria']);
    $valor = addslashes($_POST['valor']);
    $descricao = addslashes($_POST['descricao']);
    $estado = addslashes($_POST['estado']);
    if(isset($_FILES['fotos'])) {
      $fotos = $_FILES['fotos'];
    } else {
      $fotos = [];
    }
  

    $a->editAnuncio($titulo, $categoria, $valor, $descricao, $estado, $fotos, $_GET['id']);    
?>
    <br>
    <div class="alert alert-success container">
      Anúncio editado com sucesso!
    </div>
     
<?php
  endif;
  // BUSCA NO BANCO DE DADOS A INFORMAÇÕES DO ANUNCIO PARA PREENCHER NO FORMULARIO E EDITAR
  if (!empty($_GET['id']) && isset($_GET['id'])) {
      $info = $a->getAnuncio($_GET['id']);
  } else {
  ?>
    <script type="text/javascript">window.location.href="meus-anuncios.php";</script>
  <?php
  }
?>

<div class="container">
  <br>
  <h1>Editar Anúncio</h1>
  <br>
  <form action="" method="POST" enctype="multipart/form-data">
    
  <div class="form-group">
      <label for="categoria">Categoria:</label>
      <select name="categoria" id="categoria" class="form-control">
      
      <!-- FAZ A BUSCA DAS CATEGORIA SALVAS NO BANCO DE DADOS -->
        <?php 
         require_once 'classes/categorias.class.php';
         $c = new Categorias();
         $cats = $c->getLista();
         foreach($cats as $cat):
        ?>
          <option value="<?php echo $cat['id']; ?>"<?php echo ($info['id_categoria']==$cat['id']) ? 'selected="selected"' : ''; ?> ><?php echo $cat['nome']; ?></option>
        <?php endforeach; ?> 
      </select>

  </div>
  <div class="form-group">
      <label for="titulo">Título:</label>
      <input type="text" name="titulo" id="titulo" class="form-control" value="<?php echo $info['titulo']; ?>"/>
  </div>
  <div class="form-group">
      <label for="valor">Valor:</label>
      <input type="text" name="valor" id="valor" class="form-control" value="<?php echo $info['valor']; ?>"/>
  </div>
  <div class="form-group">
      <label for="descricao">Descrição:</label>
      <textarea name="descricao" class="form-control"><?php echo $info['descricao']; ?></textarea>
  </div>
  <div class="form-group">
      <label for="estado">Status de Conservação:</label>
      <select name="estado" id="estado" class="form-control">
        <option value="0" <?php echo ($info['estado']=='0') ? 'selected="selected"' : ''; ?> >Ruim</option>
        <option value="1" <?php echo ($info['estado']=='1') ? 'selected="selected"' : ''; ?> >Bom</option>
        <option value="2" <?php echo ($info['estado']=='2') ? 'selected="selected"' : ''; ?> >Ótimo</option>
      </select>
  </div>
  
  <!-- FORM PARA ENVIO DE FOTOS -->
  <div class="form-group">
    <label for="add_foto">Fotos do anúncio: </label><br>
    <input type="file" name="fotos[]" multiple="multiple">
    <br><br>
    
    <div class="card">
      <div class="card-header">Fotos do Anúncio</div>
      <div class="card-body">
          <?php foreach ($info['fotos'] as $foto): ?>
            <div class="foto_item">
              <img src="assets/images/anuncios/<?php echo $foto['url_img'] ?>" class="img-thumbnail" />
              <br>
              <a href="excluir-foto.php?id=<?php echo $foto['id']; ?>" class="btn btn-warning">Excluir Imagem</a>
            </div>
          <?php endforeach; ?>
      </div>
    </div>
  </div>        

  <input type="submit" value="Salvar Edições" class="btn btn-success">
  </form>
</div>

<?php require_once 'pages/footer.php'; ?>