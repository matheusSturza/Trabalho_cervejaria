<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit;
}

include_once("Cerveja.php");
include_once("CervejaDAO.php");

$dao = new CervejaDAO();

$ordem = $_GET['ordem'] ?? 'padrao';

switch ($ordem) {
    case 'nome':
        $cervejas = $dao->listarNome();
        break;

    case 'pais':
        $cervejas = $dao->ListarPais();
        break;

    case 'avaliacao':
        $cervejas = $dao->listarNota();
        break;

    default:
        $cervejas = $dao->listar();
        break;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Lista de Cervejas</title>
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
        <li class="nav-item"><a class="nav-link text-white" href="home.php">Home</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="TelaEditarUsuario.php?email=<?= $_SESSION['email_logado'] ?>">Editar Perfil</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="TelaCadastrarCerveja.php">Cadastrar Cerveja</a></li>
        <li class="nav-item"><a class="nav-link active text-danger" href="TelaListaCerveja.php">Listar Cervejas</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="TelaListarRotulo.php">Galeria de Rótulos</a></li>
         <li class="nav-item">
            <a class="nav-link text-white" href="TelaRelatorio.php">Relatório</a>
        </li>
      </ul>
      <a href="index.php" class="btn btn-danger">Sair</a>
    </div>
  </div>
</nav>

<div class="container mt-5">
    <h3 class="text-center mb-4 text-danger fw-bold">Lista de Cervejas</h3>

    <form method="GET" class="mb-4 w-25">
        <select name="ordem" class="form-select" onchange="this.form.submit()">
            <option value="padrao" <?= $ordem=='padrao'?'selected':'' ?>>Ordenar por...</option>
            <option value="nome" <?= $ordem=='nome'?'selected':'' ?>>Nome</option>
            <option value="pais" <?= $ordem=='pais'?'selected':'' ?>>País</option>
            <option value="avaliacao" <?= $ordem=='avaliacao'?'selected':'' ?>>Avaliação</option>
        </select>
    </form>

    <div class="table-responsive">
        <table class="table table-dark table-striped table-bordered align-middle text-center">
            <thead class="table-danger text-dark">
                <tr>
                    <th>Nome</th>
                    <th>Fabricante</th>
                    <th>Tipo</th>
                    <th>Teor</th>
                    <th>IBU</th>
                    <th>País</th>
                    <th>Data Fabricação</th>
                    <th>Local Degustado</th>
                    <th>Avaliação</th>
                    <th>Comentários</th>
                </tr>
            </thead>

            <tbody>
                <?php if(count($cervejas) > 0): ?>
                    <?php foreach($cervejas as $c): ?>
                        <tr>
                            <td><?= htmlspecialchars($c->getNome()) ?></td>
                            <td><?= htmlspecialchars($c->getFabricante()) ?></td>
                            <td><?= htmlspecialchars($c->getTipo()) ?></td>
                            <td><?= htmlspecialchars($c->getTeor()) ?>%</td>
                            <td><?= htmlspecialchars($c->getIbu()) ?></td>
                            <td><?= htmlspecialchars($c->getPais_origem()) ?></td>
                            <td><?= htmlspecialchars($c->getData()) ?></td>
                            <td><?= htmlspecialchars($c->getLocal()) ?></td>
                            <td><?= htmlspecialchars($c->getAvaliacao()) ?></td>
                            <td><?= htmlspecialchars($c->getComentarios()) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="10" class="text-center text-danger">Nenhuma cerveja cadastrada.</td>
                    </tr>
                <?php endif; ?>
            </tbody>

        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
