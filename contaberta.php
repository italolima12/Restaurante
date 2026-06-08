<?php

$mesas = [
    ['numero' => 1, 'status' => 'pendente'],
    ['numero' => 2, 'status' => 'aberta'],
    ['numero' => 3, 'status' => 'pendente'],
    ['numero' => 4, 'status' => 'pendente'],
    ['numero' => 5, 'status' => 'aberta'],
    ['numero' => 6, 'status' => 'aberta'],
];

$cargo = $_GET['cargo'] ?? '';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Gerenciamento de Mesas</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="contaberta.css">
</head>

<body>
    <?php include 'barra.php'; ?>
    <main class="interface">
        <div class="container-mesas">
            <header class="header-mesas">
                <h1>Gerenciamento de Mesas</h1>
                <p class="subtitulo">Selecione uma mesa para gerenciar sua conta</p>
            </header>

            <div class="grid-mesas">
                <?php foreach ($mesas as $mesa): ?>
                    <div class="card-mesa <?php echo 'status-' . $mesa['status']; ?>">
                        <div class="mesa-header">
                            <h2 class="numero-mesa">Mesa <?php echo str_pad($mesa['numero'], 2, '0', STR_PAD_LEFT); ?></h2>
                            <span class="status-badge <?php echo 'badge-' . $mesa['status']; ?>">
                                <?php 
                                    if ($mesa['status'] === 'aberta') {
                                        echo ("Aberta");
                                    } else {
                                        echo ("Pendente");
                                    }
                                ?>
                            </span>
                        </div>

                        <div class="mesa-body">
                            <?php if ($mesa['status'] === 'pendente'): ?>
                                <p class="descricao">Aguardando pagamento.</p>
                                <div class="botoes-mesa">
                                    <a href="produtosg.php?mesa=<?php echo $mesa['numero']; ?><?php echo $cargo ? '&cargo=' . urlencode($cargo) : ''; ?>" class="btn btn-secundario">Ir para Cardápio</a>
                                    <a href="comprovante.php?mesa=<?php echo $mesa['numero']; ?><?php echo $cargo ? '&cargo=' . urlencode($cargo) : ''; ?>" class="btn btn-cancelar">Fechar Conta</a>
                                </div>
                            <?php elseif ($mesa['status'] === 'aberta'): ?>
                                <p class="descricao">Conta ativa. Adicione itens ao pedido.</p>
                                <div class="botoes-mesa">
                                    <a href="produtosg.php?mesa=<?php echo $mesa['numero']; ?><?php echo $cargo ? '&cargo=' . urlencode($cargo) : ''; ?>" class="btn btn-primario">Ir para Cardápio</a>
                                </div>

                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </main>
</body>

</html>