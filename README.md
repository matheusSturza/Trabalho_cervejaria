colocar fabricante na tabela cerveja quando criar!!!!!!

Mudar DATA_fabri dentro do código e do sql!!!!

Adicinar a coluna img na tabela cerveja!!!!!!

https://www.chartjs.org/docs/latest/getting-started/integration.html


Método listar imagens:

public function listarImgs() {
    $lista = [];
    $sql = "SELECT img FROM carro WHERE img IS NOT NULL";
    $stmt = $this->con->query($sql);

    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $lista[] = $row['img'];
    }

    return $lista;
}
}
