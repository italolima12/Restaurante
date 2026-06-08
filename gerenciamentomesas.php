<?php

$mesas = [
    ['numero' => 1, 'status' => 'aberta', 'garcom' => 'Bruno', 'observacao' => 'Pedido em preparo'],
    ['numero' => 2, 'status' => 'fechada', 'garcom' => 'Cicero', 'observacao' => 'Mesa liberada'],
    ['numero' => 3, 'status' => 'aberta', 'garcom' => 'Carlos André', 'observacao' => 'Consumindo sobremesa'],
    ['numero' => 4, 'status' => 'fechada', 'garcom' => 'Sofia', 'observacao' => 'Aguardando pagamento'],
    ['numero' => 5, 'status' => 'aberta', 'garcom' => 'Aislan', 'observacao' => 'Bebidas servidas'],
    ['numero' => 6, 'status' => 'fechada', 'garcom' => 'Ray', 'observacao' => 'Relatório finalizado'],
];

$vendas = [
    ['mesa' => 1, 'data' => '2026-06-03', 'total' => 120.50],
    ['mesa' => 2, 'data' => '2026-06-03', 'total' => 0.00],
    ['mesa' => 3, 'data' => '2026-06-03', 'total' => 89.90],
    ['mesa' => 4, 'data' => '2026-06-02', 'total' => 150.00],
    ['mesa' => 5, 'data' => '2026-06-03', 'total' => 55.20],
    ['mesa' => 6, 'data' => '2026-06-02', 'total' => 0.00],
];

$startDate = isset($_GET['data_inicio']) && $_GET['data_inicio'] !== '' ? $_GET['data_inicio'] : date('Y-m-d');
$endDate = isset($_GET['data_fim']) && $_GET['data_fim'] !== '' ? $_GET['data_fim'] : date('Y-m-d');

if ($startDate > $endDate) {
    [$startDate, $endDate] = [$endDate, $startDate];
}

$totalPeriodo = 0.0;
$totaisPorMesa = [];
foreach ($vendas as $venda) {
    if ($venda['data'] >= $startDate && $venda['data'] <= $endDate) {
        $totalPeriodo += $venda['total'];
        $totaisPorMesa[$venda['mesa']] = ($totaisPorMesa[$venda['mesa']] ?? 0.0) + $venda['total'];
    }
}

function formatarReais(float $valor): string
{
    return 'R$ ' . number_format($valor, 2, ',', '.');
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Relatório de Mesas</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="gerenciamentomesas.css">
</head>

<body>
    <?php include 'barra.php'; ?>

    <main class="interface">
        <section class="card-relatorio">
            <div class="painel-relatorio">
                <p class="tagline">Relatório de Mesas</p>
                <h1>Ocupação e vendas por mesa</h1>

                <div class="info-header">
                    <form method="get" class="form-filtro" aria-label="Filtrar por intervalo de datas">
                        <?php cargoHiddenInput(); ?>
                        <label for="data_inicio">Data inicial</label>
                        <input type="date" id="data_inicio" name="data_inicio" value="<?php echo htmlspecialchars($startDate); ?>" required>

                        <label for="data_fim">Data final</label>
                        <input type="date" id="data_fim" name="data_fim" value="<?php echo htmlspecialchars($endDate); ?>" required>

                        <button type="submit">Aplicar</button>
                    </form>
                </div>
                <div class="tabela-mesas">
                    <div class="tabela-header">
                        <div>Mesa</div>
                        <div>Status</div>
                        <div>Garçom</div>
                        <div>Total</div>
                        <div>Observação</div>
                    </div>
                    <div class="tabela-linhas">
                        <?php foreach ($mesas as $mesa): ?>
                            <?php
                                $mesaTotal = $totaisPorMesa[$mesa['numero']] ?? 0.0;
                                $statusLabel = $mesa['status'] === 'aberta' ? 'Atendida' : 'Não atendida';
                                $statusType = $mesa['status'] === 'aberta' ? 'atendida' : 'nao-atendida';
                            ?>
                            <div class="tabela-linha">
                                <div class="col-mesa">Mesa <?php echo htmlspecialchars($mesa['numero']); ?></div>
                                <div class="col-status"><span class="status-badge <?php echo $statusType; ?>"><?php echo htmlspecialchars($statusLabel); ?></span></div>
                                <div class="col-garcom"><?php echo htmlspecialchars($mesa['garcom']); ?></div>
                                <div class="col-total"><?php echo formatarReais($mesaTotal); ?></div>
                                <div class="col-observacao"><?php echo htmlspecialchars($mesa['observacao']); ?></div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>

</html>

