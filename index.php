<?php
require_once "UsuarioDAO.php";
require_once "Usuario.php";
require_once "conexao.php";

session_start();

$erro = "";

if (isset($_POST['btLogar'])) {

    $usuario = trim($_POST['usuario'] ?? '');
    $senha   = trim($_POST['senha'] ?? '');

    if (!empty($usuario) && !empty($senha)) {

        $user = new Usuario([
            "nome"  => $usuario,
            "senha" => $senha
        ]);

        $dao = new UsuarioDAO();

        $resultado = $dao->logar($user);

        if ($resultado) {
            $_SESSION['usuario'] = $resultado['nome'];
            $_SESSION['email_logado'] = $resultado['email'];

            header("Location: home.php");
            exit;
        } else {
            $erro = "Usuário ou senha incorretos!";
        }

    } else {
        $erro = "Preencha todos os campos!";
    }
}

if (isset($_GET['btCadastraUsuario'])) {
    include "TelaCriarUsuario.php";
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-dark text-white d-flex justify-content-center align-items-center" style="height: 100vh;">

<div class="card bg-black border-danger shadow-lg p-4" style="width: 350px; border-radius: 12px;">

    <div class="text-center mb-3">
        <img src="./img/logo.png" alt="Logo" class="img-fluid" style="max-width: 120px;">
    </div>

    <h3 class="text-center mb-4 text-danger fw-bold">Login</h3>

    <form action="" method="POST">

        <?php if ($erro): ?>
            <div class="alert alert-danger text-center"><?= $erro ?></div>
        <?php endif; ?>

        <div class="mb-3">
            <label class="form-label text-white">Usuário</label>
            <input type="text" name="usuario" class="form-control bg-dark text-white border-danger" required>
        </div>

        <div class="mb-3">
            <label class="form-label text-white">Senha</label>
            <input type="password" name="senha" class="form-control bg-dark text-white border-danger" required>
        </div>

        <center>
            <button type="submit" name="btLogar" class="btn btn-danger w-40 fw-semibold">Entrar</button>
            <a href="index.php?btCadastraUsuario=1" class="btn btn-danger w-40 fw-semibold">Criar Conta</a>
        </center>

    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
