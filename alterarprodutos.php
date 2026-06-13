<?php
class Produto
{
    private string $id;
    private string $nome;
    private float $preco; 
    private string $imagem;
    private string $descricao;
    public function __construct(string $id, string $nome, float $preco, string $imagem, string $descricao = '')
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->preco = $preco;
        $this->imagem = $imagem;
        $this->descricao = $descricao;
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

    public function formatarPreco(float $valor): string
    {
        return 'R$ ' . number_format($valor, 2, ',', '.');
    }
}

$pratos = [
    new Produto(1, 'Prato 1', 35.00, 'fotos/feijao.jpg', 'Calabresa, pimentão, coentro picado, alho, farinha e feijão'),
    new Produto(2, 'Prato 2', 28.00, 'fotos/croissant.jpg', 'Combinação perfeita de sabores'),
    new Produto(3, 'Prato 3', 42.00, 'fotos/pizza.jpg', 'Pizza de calabresa, queijo, tomate e orégano'),
    new Produto(4, 'Prato 4', 30.00, 'fotos/picanha.webp', 'Carne suculenta acompanhada de farofa'),
    new Produto(5, 'Prato 5', 25.00, 'fotos/Taco.webp', 'Salsicha, pimenta doce e páprica defumada'),
];

$bebidas = [
    new Produto(6, 'Coca-Cola', 12.00, 'fotos/coca.jpg', 'Gelada e refrescante'),
    new Produto(7, 'Whisky', 14.00, 'fotos/whisky.jpg', 'Premium importado'),
    new Produto(8, 'Água', 10.00, 'fotos/água.jpg', 'Água filtrada'),
    new Produto(9, 'Suco de Laranja', 16.00, 'fotos/suco.jpg', 'Suco natural fresco'),
];
$ExcluirProduto = $_POST['excluirproduto'] ?? '';

$mensagem = '';
$cssmensagem = '';
foreach ($_POST as $chave => $valor) {

    if ($chave == 'excluirproduto') {
        $mensagem = 'Produto excluído com sucesso!';
        $cssmensagem = 'mensagem-erro';
    }

    if ($chave == 'adicionarproduto') {
        $mensagem = 'Produto adicionado com sucesso!';
        $cssmensagem = 'mensagem-sucesso';
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Cardápio</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="alterarprodutos.css">
</head>

<body>
    <?php include 'barra.php'; ?>
    <section class="cardapio">

        <h1>Cardápio</h1>
        <?php
        if ($mensagem != '') {
            echo "<div class='$cssmensagem'>$mensagem</div>";
        }
        ?>
        <h2>Pratos</h2>
        <ul class="lista">
            <?php foreach ($pratos as $produto): ?>
                <li>
                    <img src="<?= $produto->getImagem(); ?>" alt="<?= $produto->getNome(); ?>">
                    <div class="item-info">
                        <div class="item-detalhes">
                            <span class="item-nome"><?= $produto->getNome(); ?></span>
                            <span class="item-descricao">
                                <?= $produto->getDescricao(); ?>
                            </span>
                            <span class="item-preco">
                                <?= $produto->formatarPreco($produto->getPreco()); ?>
                            </span>
                            <div class="acoes-produto">
                                <form method="POST">
                                    <button name="excluirproduto" type="submit" class="btn-excluir">
                                        🗑️
                                    </button>
                                </form>
                                <button name="editar" type="button" class="btn-editar" onclick="location.href='#cadastro-produto'">
                                    ✏️
                                </button>
                            </div>
                        </div>


                    </div>
                </li>
            <?php endforeach; ?>
        </ul>

        <h2>Bebidas</h2>

        <ul class="lista">
            <?php foreach ($bebidas as $produto): ?>
                <li>
                    <img src="<?= $produto->getImagem(); ?>" alt="<?= $produto->getNome(); ?>">

                    <div class="item-info">

                        <div class="item-detalhes">
                            <span class="item-nome"><?= $produto->getNome(); ?></span>

                            <span class="item-descricao">
                                <?= $produto->getDescricao(); ?>
                            </span>

                            <span class="item-preco">
                                <?= $produto->formatarPreco($produto->getPreco()); ?>
                            </span>
                            <div class="acoes-produto">
                                <form method="POST">
                                    <button type="submit" name="excluirproduto" value="<?= $produto->getId(); ?>" class="btn-excluir">
                                        🗑️
                                    </button>
                                
                                <button type="button" class="btn-editar" onclick="location.href='#cadastro-produto'">
                                    ✏️
                                </button>
                                </form>
                            </div>
                        </div>
                </li>
            <?php endforeach; ?>
        </ul>

        <div class="cadastro-produto" id="cadastro-produto">
            <form method="POST">
                <h2>Novo Produto</h2>
                <input type="file" id="imagem" accept="image/*" required>

                <input type="text" placeholder="Nome do Produto" required>

                <select>
                    <option value="Categoria">Categoria</option>
                    <option value="prato">Prato</option>
                    <option value="bebida">Bebida</option>
                    <option value="Sobremesa">Sobremesa</option>
                </select>

                <input type="text" placeholder="Preço" required>

                <textarea placeholder="Descrição do produto" required></textarea>

                <button type="submit" class="btn-adicionar" name="adicionarproduto">
                    Adicionar Produto
                </button>
            </form>

        </div>
    </section>

</body>

</html>