<?php
session_start();

require_once "Usuario.php";
require_once "UsuarioDAO.php";

$dao = new UsuarioDAO();
$msg = "";

if (isset($_GET['email'])) {
    $emailGet = trim($_GET['email']);
} elseif (isset($_SESSION['email_logado'])) {
    $emailGet = $_SESSION['email_logado'];
} else {
    die("Nenhum email encontrado. Usuário não está logado!");
}

$usuario = $dao->buscarPorEmail($emailGet);

if (!$usuario) {
    die("Usuário não encontrado!");
}

if (isset($_POST['btSalvar'])) {

    $nome  = trim($_POST['nome'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $senha = trim($_POST['senha'] ?? '');

    if ($nome && $email && $senha) {

        $user = new Usuario([
            "id"    => $usuario['id'],
            "nome"  => $nome,
            "email" => $email,
            "senha" => $senha
        ]);

        $dao->editar($user);
        $msg = "Usuário atualizado com sucesso!";

        $_SESSION['email_logado'] = $email;

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
<title>Editar Usuário</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body data-bs-theme="dark" class="bg-dark text-white">

<nav class="navbar navbar-expand-lg bg-dark border-bottom border-danger">
  <div class="container-fluid">
    <a class="navbar-brand text-danger fw-bold" href="home.php">PampaBrew</a>
    <a href="home.php" class="btn btn-danger">Voltar</a>
  </div>
</nav>

<div class="container mt-4">

    <h2 class="text-danger mb-4">Editar Usuário</h2>

    <?php if($msg): ?>
        <div class="alert <?= strpos($msg, 'sucesso') !== false ? 'alert-success' : 'alert-danger' ?>">
            <?= $msg ?>
        </div>
    <?php endif; ?>

    <form method="POST">

        <div class="mb-3">
            <label class="form-label text-danger">Nome:</label>
            <input type="text" name="nome" class="form-control" 
                   value="<?= $usuario['nome'] ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label text-danger">Email:</label>
            <input type="email" name="email" class="form-control" 
                   value="<?= $usuario['email'] ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label text-danger">Senha:</label>
            <input type="password" name="senha" class="form-control" 
                   value="<?= $usuario['senha'] ?>" required>
        </div>

        <button type="submit" name="btSalvar" class="btn btn-danger">Salvar Alterações</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
