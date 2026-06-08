<?php
require 'usuario.php';

class Gerente extends Usuario
{
    public function __construct(
        string $nome,
        string $dataNasc,
        string $telefone,
        string $endereco,
        int $CPF,
        public int $RG,
        public string $login,
        public string $senha,
        public string $grauEscolaridade
    ) {
        parent::__construct($nome, $dataNasc, $telefone, $endereco, $CPF);
    }
}
$sucessoMsg = '';
if (isset($_POST['nome']) && $_POST['nome'] !== '') {
    $nomeFull = $_POST['nome'];
    $primeiro = explode(' ', $nomeFull)[0] ?? $nomeFull;
    $sucessoMsg = 'Gerente cadastrado: ' . htmlspecialchars($primeiro) . '!';
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Cadastro de Gerente</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="propicadastrar.css">
</head>

<body>
    <?php include 'barra.php'; ?>

    <main class="interface">
        <section class="card-cadastro">
            <div class="painel-cadastro">
                <p class="tagline">Gerenciamento</p>
                <h1>Cadastro de Gerente</h1>
                <?php if (isset($sucessoMsg) && $sucessoMsg !== ''): ?>
                    <div class="mensagem-sucesso"><?php echo $sucessoMsg; ?></div>
                <?php endif; ?>
                <form action="" method="POST" class="formulario-garcom" autocomplete="off">
                    <?php cargoHiddenInput(); ?>
                    <div class="grupo-campo">
                        <label for="nome">Nome Completo</label>
                        <input type="text" id="nome" name="nome" placeholder="Digite o nome completo" required>
                    </div>

                    <div class="grupo-campo">
                        <label for="dataNasc">Data de Nascimento</label>
                        <input type="date" id="dataNasc" name="dataNasc" required>
                    </div>

                    <div class="grupo-campo">
                        <label for="telefone">Telefone</label>
                        <input type="tel" id="telefone" name="telefone" placeholder="(11) 9999-9999" required>
                    </div>

                    <div class="grupo-campo">
                        <label for="endereco">Endereço</label>
                        <input type="text" id="endereco" name="endereco" placeholder="Rua, número, complemento" required>
                    </div>

                    <div class="grupo-campo">
                        <label for="cpf">CPF</label>
                        <input type="text" id="cpf" name="cpf" placeholder="000.000.000-00" minlength="11" maxlength="11" required>
                    </div>

                    <div class="grupo-campo">
                        <label for="rg">RG</label>
                        <input type="text" id="rg" name="rg" placeholder="00.000.000-0" required>
                    </div>

                    <div class="grupo-campo">
                        <label for="login">Login</label>
                        <input type="text" id="login" name="login" placeholder="Nome de usuário" required>
                    </div>

                    <div class="grupo-campo">
                        <label for="senha">Senha</label>
                        <input type="password" id="senha" name="senha" placeholder="Digite a senha" required>
                    </div>

                    <div class="botoes-acao">
                        <button type="submit" class="btn-salvar">Salvar</button>
                        <a href="gerente.php" class="btn-voltar">Voltar</a>
                    </div>
                </form>


                <div class="lista-funcionarios">
                    <h2>Gerentes Cadastrados</h2>
                    <div class="tabela-funcionarios">
                        <div class="tabela-header">
                            <div class="col-imagem">Imagem</div>
                            <div class="col-nome">Nome</div>
                            <div class="col-sexo">Sexo</div>
                            <div class="col-idade">Idade</div>
                        </div>
                        <div class="tabela-linhas">
                            <div class="tabela-linha">
                                <div class="col-imagem">
                                    <img src="fotos/airlannn.png" alt="Aislan">
                                </div>
                                <div class="col-nome">Aislan Lima de Morais</div>
                                <div class="col-sexo">Masculino</div>
                                <div class="col-idade">46</div>
                            </div>
                            <div class="tabela-linha">
                                <div class="col-imagem">
                                    <img src="fotos/rayedit.png" alt="Ray">
                                </div>
                                <div class="col-nome">Ray Bezerra Gonçalves</div>
                                <div class="col-sexo">Masculino</div>
                                <div class="col-idade">32</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

</body>

</html>