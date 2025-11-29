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
    $notasRanking[] = $cerveja->getAvalicao();
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
<html>
<head>
    <meta charset="UTF-8">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .grafico { width: 400px; height: 300px; margin: 20px; display: inline-block; }
    </style>
</head>
<body>
    <div class="grafico">
        <canvas id="graficoMediaNotas"></canvas>
    </div>
    <div class="grafico">
        <canvas id="graficoRanking"></canvas>
    </div>
    <div class="grafico">
        <canvas id="graficoDegustacoes"></canvas>
    </div>

    <script>
        
        new Chart(document.getElementById("graficoMediaNotas"), {
            type: "bar",
            data: {
                labels: <?= json_encode($tiposCerveja) ?>,
                datasets: [{
                    label: "Média de Notas",
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
            options: {
                indexAxis: 'y'
            }
        });

        /
        new Chart(document.getElementById("graficoDegustacoes"), {
            type: "line",
            data: {
                labels: <?= json_encode($meses) ?>,
                datasets: [{
                    label: "Degustações",
                    data: <?= json_encode($degustacoes) ?>,
                    borderColor: "rgba(75, 192, 192, 1)",
                    fill: false
                }]
            }
        });
    </script>
</body>
</html>