<?php
session_start();  
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Home</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
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

        <li class="nav-item">
            <a class="nav-link active text-white" href="home.php">Home</a>
        </li>

        <li class="nav-item">
            <a class="nav-link text-white" 
               href="TelaEditarUsuario.php?email=<?= $_SESSION['email_logado'] ?>">
               Editar Perfil
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link text-white" href="TelaCadastrarCerveja.php">Cadastrar Cerveja</a>
        </li>

        <li class="nav-item">
            <a class="nav-link text-white" href="TelaListaCerveja.php">Listar Cervejas</a>
        </li>

        <li class="nav-item">
            <a class="nav-link text-white" href="TelaListarRotulo.php">Galeria de Rótulos</a>
        </li>

      </ul>

      <a href="index.php" class="btn btn-danger">Sair</a>
    </div>
  </div>
</nav>

<center>
  <img src="img/logo.png" class="img-fluid" style="max-height:600px; object-fit:cover;">
</center>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
