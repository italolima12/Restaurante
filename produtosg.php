<?php

class Produto
{
    private string $id;
    private string $nome;
    private float $preco;
    private string $imagem;
    private string $descricao;
    private int $quantidade;

    public function __construct(string $id, string $nome, float $preco, string $imagem, string $descricao = '')
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->preco = $preco;
        $this->imagem = $imagem;
        $this->descricao = $descricao;
        $this->quantidade = 0;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function getPreco()
    {
        return $this->preco;
    }

    public function getImagem()
    {
        return $this->imagem;
    }

    public function getDescricao()
    {
        return $this->descricao;
    }

    public function getQuantidade()
    {
        return $this->quantidade;
    }

    public function setQuantidade(int $quantidade)
    {
        $this->quantidade = max(0, $quantidade);
    }

    public function calcularTotal()
    {
        return $this->preco * $this->quantidade;
    }

    public function formatarPreco(float $valor): string
    {
        return 'R$ ' . number_format($valor, 2, ',', '.');
    }
}

// Instanciar produtos
$pratos = [
    new Produto(1, 'Prato 1', 35.00, 'fotos/feijao.jpg', 'Calabresa, pimentão, coentro picado, alho, farinha e fejão'),
    new Produto(2, 'Prato 2', 28.00, 'fotos/croissant.jpg', 'Combinação perfeita de sabores'),
    new Produto(3, 'Prato 3', 42.00, 'fotos/pizza.jpg', 'Pizza de calabresa, queijo, tomate e orégano'),
    new Produto(4, 'Prato 4', 30.00, 'fotos/picanha.webp', 'Carne suculenta, temperada com sal grosso e acompanhada de farofa'),
    new Produto(5, 'Prato 5', 25.00, 'fotos/Taco.webp', 'Salsicha, pimenta doce, páprica defumada, extrato de tomate '),
];

$bebidas = [
    new Produto(6, 'Coca-cola', 12.00, 'fotos/coca.jpg', 'Gelada e refrescante'),
    new Produto(7, 'Whisky', 14.00, 'fotos/whisky.jpg', 'Premium importado'),
    new Produto(8, 'Agua', 10.00, 'fotos/água.jpg', 'Agua filtrada'),
    new Produto(9, 'Suco de Laranja', 16.00, 'fotos/suco.jpg', 'Suco natural fresco'),
];

$totalPedido = 0;
$quantidades = [];

if (isset($_POST['acao']) && $_POST['acao'] == 'calcular') {

    $quantidades = $_POST['quantidade'] ?? [];
    $todosProdutos = array_merge($pratos, $bebidas);

    foreach ($todosProdutos as $produto) {

        $id = $produto->getId();

        $quantidade = isset($quantidades[$id])
            ? (int)$quantidades[$id]
            : 0;

        $produto->setQuantidade($quantidade);

        $totalPedido += $produto->getPreco() * $produto->getQuantidade();
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="produtosg.css">
</head>

<body>
    <?php include 'barra.php'; ?>
    <form method="post" action="">
        <?php cargoHiddenInput(); ?>

        <section class="cardapio">
            <div class="form-header">
                <h1 class="color">Atendimento</h1>
                <div class="form-inputs">
                    <input type="text" name="garcom" placeholder="Id do Garçom">
                </div>
            </div>
            <h1>Cardápio</h1>

            <h2>Pratos</h2>
            <ul class="lista">
                <?php foreach ($pratos as $produto): ?>
                    <li data-id="<?php echo $produto->getId(); ?>">
                        <img src="<?php echo $produto->getImagem(); ?>" alt="<?php echo $produto->getNome(); ?>">
                        <div class="item-info">
                            <div class="item-detalhes">
                                <span class="item-nome"><?php echo $produto->getNome(); ?></span>
                                <span class="item-descricao"><?php echo $produto->getDescricao(); ?></span>
                                <span class="item-preco"><?php echo $produto->formatarPreco($produto->getPreco()); ?></span>
                            </div>
                            <div class="item-controls">
                                <input type="number" name="quantidade[<?php echo $produto->getId(); ?>]" class="quantidade" value="<?php echo $produto->getQuantidade(); ?>" min="0">
                                <span class="item-total"><?php echo $produto->formatarPreco($produto->getPreco() * $produto->getQuantidade()); ?></span>
                            </div>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>

            <h2>Bebidas</h2>
            <ul class="lista">
                <?php foreach ($bebidas as $produto): ?>
                    <li data-id="<?php echo $produto->getId(); ?>">
                        <img src="<?php echo $produto->getImagem(); ?>" alt="<?php echo $produto->getNome(); ?>">
                        <div class="item-info">
                            <div class="item-detalhes">
                                <span class="item-nome"><?php echo $produto->getNome(); ?></span>
                                <span class="item-descricao"><?php echo $produto->getDescricao(); ?></span>
                                <span class="item-preco"><?php echo $produto->formatarPreco($produto->getPreco()); ?></span>
                            </div>
                            <div class="item-controls">
                                <input type="number" name="quantidade[<?php echo $produto->getId(); ?>]" class="quantidade" value="<?php echo $produto->getQuantidade(); ?>" min="0">
                                <span class="item-total"><?php echo $produto->formatarPreco($produto->getPreco() * $produto->getQuantidade()); ?></span>
                            </div>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
            <div class="total-pedido">
                <span>Total do Pedido:</span>
                <strong id="valor-total"><?php echo 'R$ ' . number_format($totalPedido, 2, ',', '.'); ?></strong>
            </div>
            <div class="botao-container">
                <button type="submit" name="acao" value="calcular" class="fechar-pedidos">Calcular Total</button>
                <button type="submit" name="acao" value="fechar" class="fechar-pedidos">Fechar Pedidos</button>
            </div>
        </section>
    </form>
    </main>

</body>

</html>