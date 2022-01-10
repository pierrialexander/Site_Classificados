<?php require_once 'pages/header.php'; ?>

<?php
require 'classes/anuncios.class.php';
require 'classes/usuarios.class.php';
$a = new Anuncios();
$u = new Usuarios();

// VERIFICAMOS SE FOI ENVIADO UM ID AO GET E COLETAMOS OS DADOS
if(isset($_GET['id']) && !empty($_GET['id'])){
  // coletamos as informações do produto
  $id = addslashes($_GET['id']);
  $info = $a->getAnuncio($id);
} else {
  ?>
  <script type="text/javascript">window.location.href="index.php";</script>
  <?php 
 exit;
}
?>

<!--INICIO DO CONTAINER-->
  <div class="container-fluid">
  <br>
   

    
    <!--INICIO DO GRID-->
    <div class="row">
        <div class="col-sm-4">
          

          <!--INICIO DO CAROUSEL-->
            <div class="carousel slide" data-ride="carousel" data-interval="3000" id="meuCarousel">

              <!-- Indicators -->
              <ul class="carousel-indicators">
                <li data-target="#demo" data-slide-to="0" class="active"></li>
                <li data-target="#demo" data-slide-to="1"></li>
                <li data-target="#demo" data-slide-to="2"></li>
              </ul>

              <!-- The slideshow -->
              <div class="carousel-inner" role="listbox">
                <?php foreach($info['fotos'] as $chave => $foto): ?>
                <div class="carousel-item item <?php echo ($chave=='0')?'active':''; ?>">
                  <img src="assets/images/anuncios/<?php echo $foto['url_img']; ?>"/>
                </div>
                <?php endforeach; ?>
              </div>

              <!-- Left and right controls -->
              <a class="left carousel-control-prev" href="#meuCarousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon"></span>
              </a>
              <a class="right carousel-control-next" href="#meuCarousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon"></span>
              </a>
         </div>
        <!--FINAL DO CAROUSEL -->       
        </div>
        
        <div class="col-sm-8">
          <H1><?php echo $info['titulo'] ?></H1>          
          <h4><?php echo $info['categoria'] ?></h4>
          <p><?php echo $info['descricao'] ?></p><br>
          <h3>R$ <?php echo number_format($info['valor'], 2); ?></h3>
          <h4><?php echo $info['telefone'] ?></h4>

        </div>
    </div>
    <!--FINAL DA ROW-->
  </div>
  <!--FINAL DO CONTAINER-->
  
  
    
  <?php require_once 'pages/footer.php'; ?>
