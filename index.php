<?php require_once 'pages/header.php'; ?>

<?php
require 'classes/anuncios.class.php';
require 'classes/usuarios.class.php';
$a = new Anuncios();
$u = new Usuarios();
$total_anuncios = $a->getTotalAnuncios();
$total_usuarios = $u->getTotalUsuarios();

// armazena pagina para paginação
$p = 1;
if(isset($_GET['p']) && !empty($_GET['p'])) {
  $p = addslashes($_GET['p']);
}
$por_pagina = 3;

$total_paginas = ceil($total_anuncios / $por_pagina);

$anuncios = $a->getUltimosAnuncios($p, 3);

?>

<!--INICIO DO CONTAINER-->
  <div class="container-fluid">
    <br>
    <!--INICIO DO JUMBOTRON-->
    <div class="jumbotron">,
      <h5>Seja bem vindo!</h5>
      <h2>Nós temos hoje <?php echo $total_anuncios ?> anúncios</h2>
      <p>E mais de <?php echo $total_usuarios ?> usuários cadastrados</p>
    </div>
    <!--FINAL DO JUMBOTRON-->

    
    <!--INICIO DO GRID-->
    <div class="row">
      <div class="col-sm-3">
        <h4>Pesquisa Avançada</h4>
      </div>
      <div class="col-sm-9">
        <h4>Últimos Anúncios</h4>
        <table class="table table-striped">
          <tbody>
            <?php foreach($anuncios as $anuncio): ?>
              <tr>
              <td>
                  <?php if(!empty($anuncio['url_img'])): ?>
                    <img src="assets/images/anuncios/<?php echo $anuncio['url_img']; ?>" height="50"/>
                  <?php else: ?>
                    <img src="assets/images/default.jpg" height="50"/>
                  <?php endif; ?>
                  </td>
                  <td>
                    <a href="produto.php?id=<?php echo $anuncio['id']; ?>"><?php echo $anuncio['titulo']; ?></a><br>
                    <?php echo $anuncio['categoria']; ?>
                  </td>
                  <td>R$ <?php echo number_format($anuncio['valor'], 2); ?></td>
              </tr>
            <?php endforeach; ?> 
          </tbody>
           
        </table>

        <ul class="pagination">
          <?php for($q = 1; $q <= $total_paginas; $q++): ?>
            <li class="page-item <?php echo ($q == $p)?'active':''; ?>">
              <a class="page-link" href="index.php?p=<?php echo $q; ?>"><?php echo $q; ?></a>
            </li>
          <?php endfor; ?> 
        </ul>
      </div>
    </div>
  </div>
  <!--FINAL DO CONTAINER-->
  
  
    
  <?php require_once 'pages/footer.php'; ?>
