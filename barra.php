<?php
function getCargo(): string
{
    $cargo = '';
    if (isset($_GET['cargo'])) {
        $cargo = $_GET['cargo'];
    } elseif (isset($_POST['cargo'])) {
        $cargo = $_POST['cargo'];
    }

    $cargo = strtolower(trim($cargo));
    if ($cargo === 'proprietario' || $cargo === 'gerente' || $cargo === 'garcom') {
        return $cargo;
    }

    return '';
}

function cargopesquisa(string $href): string
{
    $cargo = getCargo();
    if ($cargo === '') {
        return $href;
    }

    $parts = explode('?', $href, 2);
    if (count($parts) > 1) {
        return $href . '&cargo=' . $cargo;
    }

    return $href . '?cargo=' . $cargo;
}

function cargoHiddenInput(): void
{
    $cargo = getCargo();
    if ($cargo !== '') {
        echo '<input type="hidden" name="cargo" value="' . htmlspecialchars($cargo) . '">';
    }
}

$cargo = getCargo();
$links = [];
$label = '';
if ($cargo === 'proprietario') {
    $label = 'Proprietário';
    $links = [
        'propicadastrar.php' => 'Cadastro Gerente',
        'gerentecadastrar.php' => 'Cadastro Garçom',
        'calcularcomissoes.php' => 'Comissões',
        'alterarprodutos.php' => 'Produtos',
        'gerenciamentomesas.php' => 'Mesas',
        'contaberta.php' => 'Conta',
        'produtosg.php' => 'Cardápio',
    ];
} elseif ($cargo === 'gerente') {
    $label = 'Gerente';
    $links = [
        'gerenciamentomesas.php' => 'Mesas',
        'calcularcomissoes.php' => 'Comissões',
        'gerentecadastrar.php' => 'Cadastro Garçom',
        'alterarprodutos.php' => 'Produtos',
    ];
} elseif ($cargo === 'garcom') {
    $label = 'Garçom';
    $links = [
        'contaberta.php' => 'Conta',
        'produtosg.php' => 'Cardápio',
    ];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="barra.css">
</head>
<body>
    <?php if ($cargo): ?>

<div class="barra-fixa">
    <div class="barra-wrapper">
        <h2><?php echo htmlspecialchars($label); ?></h2>
        <nav>
            <?php foreach ($links as $href => $text): ?>
                <a href="<?php echo cargopesquisa($href); ?>"><?php echo htmlspecialchars($text); ?></a>
            <?php endforeach; ?>
        </nav>
    </div>
</div>
<?php endif; ?>
</body>
</html>

