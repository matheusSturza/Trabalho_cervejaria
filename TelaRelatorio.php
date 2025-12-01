<?php
header('Content-Type: text/html; charset=UTF-8');

include_once("conexao.php");
include_once("CervejaDAO.php");

$cervejaDAO = new CervejaDAO();

$mediaPorTipo = $cervejaDAO->listarMediaNotasPorTipo();
$tiposCerveja = [];
$mediaNotas = [];

foreach ($mediaPorTipo as $dados) {
    $tiposCerveja[] = $dados['tipo'];
    $mediaNotas[] = round($dados['media_nota'], 2);
}

$cervejasRanking = $cervejaDAO->listarNota();
$topCervejas = array_slice($cervejasRanking, 0, 10);
$nomesRanking = [];
$notasRanking = [];

foreach ($topCervejas as $cerveja) {
    $nomesRanking[] = $cerveja->getNome();
    $notasRanking[] = $cerveja->getAvaliacao();
}

$degustacoesPorMes = $cervejaDAO->getDegustacoesPorMes();
$meses = [];
$degustacoes = [];

foreach ($degustacoesPorMes as $dados) {
    $meses[] = $dados['mes_nome'];
    $degustacoes[] = $dados['total_degustacoes'];
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Relatórios</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
    body {
        background-color: #121212;
        color: white;
    }
    .card {
        background-color: #1e1e1e;
        border: 1px solid #333;
    }
    .grafico-container {
        padding: 20px;
    }
    canvas {
        width: 100% !important;
        height: 350px !important;
    }
</style>
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark border-bottom border-danger">
  <div class="container-fluid">
    <a class="navbar-brand text-danger fw-bold" href="home.php">PampaBrew</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="menu">
      <ul class="navbar-nav me-auto">
        <li class="nav-item"><a class="nav-link" href="home.php">Home</a></li>
         <li class="nav-item"><a class="nav-link text-white" href="TelaEditarUsuario.php?email=<?= $_SESSION['email_logado'] ?>">Editar Perfil</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="TelaCadastrarCerveja.php">Cadastrar Cerveja</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="TelaListaCerveja.php">Listar Cervejas</a></li>
        <li class="nav-item"><a class="nav-link active text-white" href="TelaListarRotulo.php">Galeria de Rótulos</a></li>
        <li class="nav-item"><a class="nav-link active text-danger fw-bold" href="TelaRelatorio.php">Relatórios</a></li>
      </ul>
      <a href="index.php" class="btn btn-danger">Sair</a>
    </div>
  </div>
</nav>

<div class="container mt-5">

    <h2 class="text-center text-danger fw-bold mb-4">Relatórios e Estatísticas</h2>

    <div class="row g-4">

        <div class="col-md-4">
            <div class="card p-3">
                <h5 class="text-center text-warning">Média de Notas por Tipo</h5>
                <canvas id="graficoMediaNotas"></canvas>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-3">
                <h5 class="text-center text-info">Top 10 Cervejas</h5>
                <canvas id="graficoRanking"></canvas>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-3">
                <h5 class="text-center text-success">Degustações por Mês</h5>
                <canvas id="graficoDegustacoes"></canvas>
            </div>
        </div>

    </div>
</div>

<script>
    new Chart(document.getElementById("graficoMediaNotas"), {
        type: "bar",
        data: {
            labels: <?= json_encode($tiposCerveja) ?>,
            datasets: [{
                label: "Média",
                data: <?= json_encode($mediaNotas) ?>,
                backgroundColor: "rgba(54, 162, 235, 0.6)"
            }]
        }
    });

    new Chart(document.getElementById("graficoRanking"), {
        type: "bar",
        data: {
            labels: <?= json_encode($nomesRanking) ?>,
            datasets: [{
                label: "Avaliação",
                data: <?= json_encode($notasRanking) ?>,
                backgroundColor: "rgba(255, 99, 132, 0.6)"
            }]
        },
        options: { indexAxis: "y" }
    });

    new Chart(document.getElementById("graficoDegustacoes"), {
        type: "line",
        data: {
            labels: <?= json_encode($meses) ?>,
            datasets: [{
                label: "Degustações",
                data: <?= json_encode($degustacoes) ?>,
                borderColor: "rgba(75, 192, 192, 1)",
                borderWidth: 2,
                fill: false
            }]
        }
    });

</script>

</body>
</html>
