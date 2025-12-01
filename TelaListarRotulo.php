<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit;
}

include_once("Cerveja.php");
include_once("CervejaDAO.php");

$dao = new CervejaDAO();
$cervejas = $dao->listar();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Galeria de Rótulos</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    .card-img-top {
        height: 200px;
        object-fit: cover;
    }
</style>
</head>
<body data-bs-theme="dark" class="bg-dark text-white">

<nav class="navbar navbar-expand-lg bg-dark border-bottom border-danger">
  <div class="container-fluid">
    <a class="navbar-brand text-danger fw-bold" href="home.php">PampaBrew</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="menu">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link text-white" href="home.php">Home</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="TelaEditarUsuario.php?email=<?= $_SESSION['email_logado'] ?>">Editar Perfil</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="TelaCadastrarCerveja.php">Cadastrar Cerveja</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="TelaListaCerveja.php">Listar Cervejas</a></li>
        <li class="nav-item"><a class="nav-link active text-danger" href="TelaListarRotulo.php">Galeria de Rótulos</a></li>
         <li class="nav-item">
            <a class="nav-link text-white" href="TelaRelatorio.php">Relatório</a>
        </li>
      </ul>
      <a href="index.php" class="btn btn-danger">Sair</a>
    </div>
  </div>
</nav>

<div class="container mt-5">
    <h3 class="text-center mb-4 text-danger fw-bold">Galeria de Rótulos</h3>

    <?php if(count($cervejas) > 0): ?>
    <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php foreach($cervejas as $c): ?>
        <div class="col">
            <div class="card h-100 text-danger">
                <?php if($c->getImg()): ?>
                    <img src="rotulos/<?= htmlspecialchars($c->getImg()) ?>" class="card-img-top" alt="<?= htmlspecialchars($c->getNome()) ?>">
                <?php else: ?>
                    <div class="card-img-top bg-secondary d-flex align-items-center justify-content-center" style="height:200px;">
                        <span class="text-white">Sem imagem</span>
                    </div>
                <?php endif; ?>
                <div class="card-body">
                    <h5 class="card-title"><?= htmlspecialchars($c->getNome()) ?></h5>
                    <p class="card-text">Data de Fabricação: <?= htmlspecialchars($c->getData()) ?></p>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <?php else: ?>
        <div class="alert alert-danger text-center" role="alert">
            Nenhum rótulo cadastrado.
        </div>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
