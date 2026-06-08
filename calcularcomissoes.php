<?php

class Comissao
{
    public array $salarios;
    public string $nomeCompleto;
    public string $imagem;

    public function __construct(array $salarios, string $nomeCompleto, string $imagem)
    {
        $this->salarios = $salarios;
        $this->nomeCompleto = $nomeCompleto;
        $this->imagem = $imagem;
    }

    public function getSalario(string $mes): float
    {
        return $this->salarios[$mes] ?? 0.0;
    }

    public function getComissao(string $mes): float
    {
        return $this->getSalario($mes) * 0.10;
    }

    public function getTotal(string $mes): float
    {
        return $this->getSalario($mes) + $this->getComissao($mes);
    }

    public function getNomeCompleto(): string
    {
        return $this->nomeCompleto;
    }

    public function getImagem(): string
    {
        return $this->imagem;
    }
}

$meses = [
    'janeiro' => 'Janeiro',
    'fevereiro' => 'Fevereiro',
    'março' => 'Março'
];

$garcons = [
    'bruno' => [
        'nome' => 'Bruno de Lima Alves',
        'imagem' => 'fotos/brunoo.png.png',
        'salarios' => [
            'janeiro' => 999.00,
            'fevereiro' => 2300.00,
            'março' => 9000.00
        ]
    ],
    'sofia' => [
        'nome' => 'Sofia de Oliveira Paulino',
        'imagem' => 'fotos/sofiaaa.png.jpeg',
        'salarios' => [
            'janeiro' => 998.00,
            'fevereiro' => 2500.00,
            'março' => 7000.00
        ]
    ],
    'cicin' => [
        'nome' => 'Cicero Viturino Pereira',
        'imagem' => 'fotos/cicinhoo.png.png',
        'salarios' => [
            'janeiro' => 10000.00,
            'fevereiro' => 25000.00,
            'março' => 70000.00
        ]
    ],
    'carlim' => [
        'nome' => 'Carlos André Bezerra Marques',
        'imagem' => 'fotos/carlimm.png.png',
        'salarios' => [
            'janeiro' => 100000.00,
            'fevereiro' => 250000.00,
            'março' => 700000.00
        ]
    ]
];

$comissoes = [];
foreach ($garcons as $key => $dados) {
    $comissoes[$key] = new Comissao($dados['salarios'], $dados['nome'], $dados['imagem']);
}

$mesSelecionado = strtolower(trim($_POST['mes'] ?? ''));
$garcomSelecionado = $_POST['garcom'] ?? 'todos';
$mensagem = '';
$mostrarResultados = false;
$selecionados = [];

function formatarReal(float $valor): string
{
    return 'R$ ' . number_format($valor, 2, ',', '.');
}

if (count($_POST) > 0) {
    if (!isset($meses[$mesSelecionado])) {
        $mensagem = 'Escolha um mês válido para calcular as comissões.';
    } elseif ($garcomSelecionado !== 'todos' && !isset($comissoes[$garcomSelecionado])) {
        $mensagem = 'Escolha um garçom válido ou selecione Todos.';
    } else {
        $mostrarResultados = true;
        if ($garcomSelecionado === 'todos') {
            $selecionados = $comissoes;
        } else {
            $selecionados = [$garcomSelecionado => $comissoes[$garcomSelecionado]];
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="calcularcomissoes.css">
</head>

<body>
    <?php include 'barra.php'; ?>
    <section class="cardapio">
        <form method="post" action="">
            <?php cargoHiddenInput(); ?>
            <div class="form-header">
                <h1 class="color">Cálculo de Comissões</h1>
                <div class="form-inputs">
                    <select name="mes">
                        <option value="">Selecione o mês</option>
                        <?php foreach ($meses as $valor => $rotulo): ?>
                            <option value="<?php echo $valor; ?>" <?php echo $mesSelecionado === $valor ? 'selected' : ''; ?>><?php echo $rotulo; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <select name="garcom">
                        <option value="todos" <?php echo $garcomSelecionado === 'todos' ? 'selected' : ''; ?>>Todos os garçons</option>
                        <?php foreach ($comissoes as $key => $comissao): ?>
                            <option value="<?php echo $key; ?>" <?php echo $garcomSelecionado === $key ? 'selected' : ''; ?>><?php echo htmlspecialchars($comissao->getNomeCompleto()); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="item-controles">
                    <input type="submit" value="Calcular Comissões" class="calcular-btn">
                </div>
            </div>

            <?php if ($mensagem): ?>
                <div class="mensagem-erro"><?php echo $mensagem; ?></div>
            <?php endif; ?>

            <?php if ($mostrarResultados): ?>
                <h2>Resultados de <?php echo htmlspecialchars($meses[$mesSelecionado]); ?></h2>
                <ul class="lista">
                    <?php foreach ($selecionados as $comissao): ?>
                        <li>
                            <img src="<?php echo $comissao->getImagem();?>" >
                            <div class="item-info">
                                <div class="item-detalhes">
                                    <span class="item-nome"><?php echo $comissao->getNomeCompleto(); ?></span>
                                    <span class="item-descricao">Salário: <?php echo formatarReal($comissao->getSalario($mesSelecionado)); ?></span>
                                    <span class="item-descricao">Comissão 10%: <?php echo formatarReal($comissao->getComissao($mesSelecionado)); ?></span>
                                </div>
                                <span class="item-preco">Total: <?php echo formatarReal($comissao->getTotal($mesSelecionado)); ?></span>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </form>
    </section>
</body>

</html>