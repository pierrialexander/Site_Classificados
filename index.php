<?php require_once 'pages/header.php'; ?>

<?php
require 'classes/anuncios.class.php';
require 'classes/usuarios.class.php';
require 'classes/categorias.class.php';
$a = new Anuncios();
$u = new Usuarios();
$c = new Categorias();

$total_anuncios = $a->getTotalAnuncios();
$total_usuarios = $u->getTotalUsuarios();
//------------------------------------------------------
// armazena pagina para paginação
$p = 1;
if(isset($_GET['p']) && !empty($_GET['p'])) {
  $p = addslashes($_GET['p']);
}
$por_pagina = 3;
$total_paginas = ceil($total_anuncios / $por_pagina);
$anuncios = $a->getUltimosAnuncios($p, 3);
//-------------------------------------------------------
// variável que contém a lista de categorias
$categorias = $c->getLista();
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
      
      <!-- CONTEÚDO DA PESQUISA AVANÇADA-->
      <div class="col-sm-3">
        <h4>Pesquisa Avançada</h4>
        <form method="GET">

          <!-- CATEGORIA -->
          <div class="form-group">
              <label for="categoria">Categoria</label>
              <select id="categoria" name="filtros[categoria]" class="form-control">
                <option></option>
                <?php foreach ($categorias as $cat): ?>
                  <option value="<?php echo $cat['id']; ?>"><?php echo $cat['nome']; ?></option>
                <?php endforeach; ?>
              </select>
          </div>

          <!-- PREÇO -->
          <div class="form-group">
              <label for="preco">Preço</label>
              <select id="preco" name="filtros[preco]" class="form-control">
                <option></option>
                <option value="0-50">R$ 0 - 50</option>
                <option value="51-100">R$ 51 - 100</option>
                <option value="101-200">R$ 101 - 200</option>
                <option value="201-500">R$ 201 - 500</option>
                <option value="201-500">R$ 501 - 1000</option>  
                <option value="201-500">R$ 1001 - 2000</option>
                <option value="2000">Acima de R$ 2000</option> 
              </select>
          </div>

          <!-- ESTADO DE CONSERVAÇÃO -->
          <div class="form-group">
              <label for="estado">Estado de Conservação</label>
              <select id="estado" name="filtros[estado]" class="form-control">
                <option></option>
                <option value="0">Ruim</option>
                <option value="1">Bom</option>
                <option value="2">Ótimo</option>
              </select>
          </div>

          <!-- BOTÃO -->
          <div class="form-group">
             <input type="submit" class="btn btn-info" value="Buscar">
          </div>
        </form>  



      </div>

      <!-- ITENS ANUNCIADOS-->
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
