<?php
require_once "Usuario.php";
require_once "UsuarioDAO.php";

$dao = new UsuarioDAO();
$msg = "";

if(isset($_POST['btSalvar'])){

    $nome  = trim($_POST['nome'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $senha = trim($_POST['senha'] ?? '');

    if($nome && $email && $senha){

        $user = new Usuario([
        "nome"  => $nome,
        "email" => $email,
        "senha" => $senha
]);


        $dao->inserir($user);
        $msg = "Usuário cadastrado com sucesso!";

    } else {
        $msg = "Preencha todos os campos obrigatórios!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Criar Conta</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body data-bs-theme="dark" class="bg-dark text-white">

<nav class="navbar navbar-expand-lg bg-dark border-bottom border-danger">
  <div class="container-fluid">
    <a class="navbar-brand text-danger fw-bold" href="home.php">PampaBrew</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu">
      <span class="navbar-toggler-icon"></span>
    </button>
      <a href="index.php" class="btn btn-danger">Sair</a>
    </div>
  </div>
</nav>

<div class="container mt-4">

    <h2 class="text-danger mb-4">Criar Conta</h2>

    <?php if($msg): ?>
        <div class="alert <?= strpos($msg,'sucesso')!==false ? 'alert-success' : 'alert-danger' ?>"><?= $msg ?></div>
    <?php endif; ?> 

    <form method="POST" enctype="multipart/form-data">

        <div class="mb-3">
            <label class="form-label text-danger">Nome:</label>
            <input type="text" name="nome" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label text-danger">Email:</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label text-danger">Senha:</label>
            <input type="password" name="senha" class="form-control" required>
        </div>

        <button type="submit" name="btSalvar" class="btn btn-danger">Criar Conta</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
