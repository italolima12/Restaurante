<?php
$mesa = isset($_GET['mesa']) ? (int)$_GET['mesa'] : 0;
$cargo = $_GET['cargo'] ?? '';

$comprovantes = [
    1 => [
        ['descricao' => '2x Prato 1', 'valor' => 70.00],
        ['descricao' => '2x Prato 2', 'valor' => 56.00],
        ['descricao' => '2x Coca-cola', 'valor' => 24.00],
    ],
    3 => [
        ['descricao' => 'Prato 3', 'valor' => 42.00],
        ['descricao' => 'Prato 4', 'valor' => 30.00],
        ['descricao' => 'Suco de Laranja', 'valor' => 16.00],
    ],
    4 => [
        ['descricao' => 'Prato 5', 'valor' => 25.00],
        ['descricao' => 'Whisky', 'valor' => 14.00],
        ['descricao' => 'Água', 'valor' => 10.00],
    ],
];

$itens = $comprovantes[$mesa] ?? [
    ['descricao' => 'Prato 1', 'valor' => 70.00],
    ['descricao' => 'Coca-cola', 'valor' => 24.00],
];

$total = 0;
foreach ($itens as $item) {
    $total += $item['valor'];
}

function formatarPreco(float $valor): string
{
    return 'R$ ' . number_format($valor, 2, ',', '.');
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Comprovante</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="comprovante.css">
</head>
<body>
    <?php include 'barra.php'; ?>
    <main class="comprovante-card">
        <header class="comprovante-cabecalho">
            <div>
                <h1>Comprovante de Pagamento</h1>
                <span class="comprovante-subtitulo">Comprovante gerado para mesas pendentes</span>
            </div>
            <div class="comprovante-meta">
                <span>Mesa <?php echo $mesa ? $mesa : 'N/A'; ?></span>
                <span>Data: <?php echo date('d/m/Y H:i'); ?></span>
            </div>
        </header>

        <section class="comprovante-itens">
            <div class="item-row item-header">
                <span>Descrição</span>
                <span>Valor</span>
            </div>
            <?php foreach ($itens as $item): ?>
                <div class="item-row">
                    <span><?php echo htmlspecialchars($item['descricao']); ?></span>
                    <span><?php echo formatarPreco($item['valor']); ?></span>
                </div>
            <?php endforeach; ?>
        </section>

        <footer class="comprovante-rodape">
            <div class="comprovante-total">
                <span>Total</span>
                <strong><?php echo formatarPreco($total); ?></strong>
            </div>
            <button type="button" class="btn-imprimir" onclick="window.print()">Imprimir Comprovante</button>
        </footer>
    </main>
</body>
</html>