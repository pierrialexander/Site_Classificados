<?php
require 'config.php';
if(empty($_SESSION['clogin'])) {
    header("Location: login.php");
    exit;
}

require 'classes/anuncios.class.php';
$a = new Anuncios();

if (!empty($_GET['id']) && isset($_GET['id'])) {
  $a->excluirAnuncios($_GET['id']);
}

header("Location: meus-anuncios.php");
?>