<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit;
}


require_once "Cerveja.php";
require_once "CervejaDAO.php";
require_once "conexao.php";


$mensagem = "";

if (isset($_POST["btSalva"])) {

    $foto = null;

    if (!empty($_FILES["img"]["name"])) {
        $nomeFoto = time() . "_" . $_FILES["img"]["name"];
        move_uploaded_file($_FILES["img"]["tmp_name"], "rotulos/" . $nomeFoto);
        $foto = $nomeFoto;
    }

    $cerveja = new Cerveja([
        "nome" => $_POST["nome"],
        "tipo" => $_POST["tipo"],
        "teor" => $_POST["teor"],
        "ibu" => $_POST["ibu"],
        "pais_origem" => $_POST["pais_origem"],
        "data_fabri" => $_POST["data_fabri"],
        "local_degustado" => $_POST["local_degustado"],
        "avaliacao" => $_POST["avaliacao"],
        "comentarios" => $_POST["comentarios"],
        "img" => $foto,
        "fabricante" => $_POST["fabricante"]
    ]);

    $dao = new CervejaDAO();
    $dao->inserir($cerveja);

    $mensagem = "Cerveja cadastrada com sucesso!";
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Cadastrar Cerveja</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body data-bs-theme="dark" class="bg-dark text-white">

<nav class="navbar navbar-expand-lg bg-dark border-bottom border-danger">
  <div class="container-fluid">
    <a class="navbar-brand text-danger fw-bold" href="home.php">PampaBrew</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu"></button>

    <div class="collapse navbar-collapse" id="menu">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link text-white" href="home.php">Home</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="TelaEditarUsuario.php?email=<?= $_SESSION['email_logado'] ?>">Editar Perfil</a></li>
        <li class="nav-item"><a class="nav-link active text-white" href="CadastrarCerveja.php">Cadastrar Cerveja</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="TelaListaCerveja.php">Listar Cervejas</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="TelaListarRotulo.php">Galeria de Rótulos</a></li>
      </ul>

      <a href="index.php" class="btn btn-danger">Sair</a>
    </div>
  </div>
</nav>

<div class="d-flex justify-content-center mt-4">

<div class="card bg-black border-danger shadow-lg p-4" style="width: 480px; border-radius: 12px;">

    <h3 class="text-center mb-4 text-danger fw-bold">Cadastrar Cerveja</h3>

    <?php if ($mensagem != ""): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <?= $mensagem ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    <?php endif; ?>

    <form action="" method="POST" enctype="multipart/form-data">

        <div class="mb-3">
            <label class="form-label text-white">Nome</label>
            <input type="text" name="nome" class="form-control bg-dark text-white border-danger" required>
        </div>

        <div class="mb-3">
            <label class="form-label text-white">Fabricante</label>
            <input type="text" name="fabricante" class="form-control bg-dark text-white border-danger" required>
        </div>

        <div class="mb-3">
            <label class="form-label text-white">Tipo</label>
            <select name="tipo" class="form-control bg-dark text-white border-danger" required>
                <option value="">Selecione</option>
                <option>Pilsen</option>
                <option>Lager</option>
                <option>IPA</option>
                <option>APA</option>
                <option>Weiss</option>
                <option>Stout</option>
                <option>Porter</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label text-white">Teor Alcoólico (%)</label>
            <input type="number" step="0.1" name="teor" class="form-control bg-dark text-white border-danger" required>
        </div>

        <div class="mb-3">
            <label class="form-label text-white">IBU</label>
            <input type="number" name="ibu" class="form-control bg-dark text-white border-danger">
        </div>

        <div class="mb-3">
            <label class="form-label text-white">País de Origem</label>
            <input type="text" name="pais_origem" class="form-control bg-dark text-white border-danger">
        </div>

        <div class="mb-3">
            <label class="form-label text-white">Data de Fabricação</label>
            <input type="date" name="data_fabri" class="form-control bg-dark text-white border-danger">
        </div>

        <div class="mb-3">
            <label class="form-label text-white">Local Degustado</label>
            <input type="text" name="local_degustado" class="form-control bg-dark text-white border-danger">
        </div>

        <div class="mb-3">
            <label class="form-label text-white">Avaliação (0 a 10)</label>
            <input type="number" name="avaliacao" min="0" max="10" step="0.1" class="form-control bg-dark text-white border-danger">
        </div>

        <div class="mb-3">
            <label class="form-label text-white">Comentários</label>
            <textarea name="comentarios" class="form-control bg-dark text-white border-danger" rows="3"></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label text-white">Foto</label>
            <input type="file" name="img" class="form-control bg-dark text-white border-danger">
        </div>

        <center>
            <button type="submit" name="btSalva" class="btn btn-danger fw-semibold w-100">Salvar</button>
        </center>

    </form>

</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
