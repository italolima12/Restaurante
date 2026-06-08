<?php
require 'usuario.php';

class Garcom extends Usuario
{
    public function __construct(
        string $nome,
        string $dataNasc,
        string $telefone,
        string $endereco,
        int $cpf,
        public string $grauEscolaridade
    ) {
        parent::__construct($nome, $dataNasc, $telefone, $endereco, $cpf);
    }
}
$sucessoMsg = '';
if (isset($_POST['nome']) && $_POST['nome'] !== '') {
    $nomeFull = $_POST['nome'];
    $primeiro = explode(' ', $nomeFull)[0] ?? $nomeFull;
    $sucessoMsg = 'Garçom cadastrado: ' . htmlspecialchars($primeiro) . '!';
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Cadastro de Garçom</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="gerentecadastrar.css">
</head>

<body>
    <?php include 'barra.php'; ?>

    <main class="interface">
        <section class="card-cadastro">
            <div class="painel-cadastro">
                <p class="tagline">Gerenciamento</p>
                <h1>Cadastro de Garçom</h1>
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
                        <label for="grauEscolaridade">Grau de Escolaridade</label>
                        <select id="grauEscolaridade" name="grauEscolaridade" required>
                            <option value="">Selecione uma opção</option>
                            <option value="Ensino Fundamental Incompleto">Ensino Fundamental Incompleto</option>
                            <option value="Ensino Fundamental Completo">Ensino Fundamental Completo</option>
                            <option value="Ensino Médio Incompleto">Ensino Médio Incompleto</option>
                            <option value="Ensino Médio Completo">Ensino Médio Completo</option>
                            <option value="Ensino Superior Incompleto">Ensino Superior Incompleto</option>
                            <option value="Ensino Superior Completo">Ensino Superior Completo</option>
                        </select>
                    </div>

                    <div class="botoes-acao">
                        <button type="submit" class="btn-salvar">Salvar</button>
                        <a href="gerente.php" class="btn-voltar">Voltar</a>
                    </div>
                </form>


                <div class="lista-funcionarios">
                    <h2>Garçons Cadastrados</h2>
                    <div class="tabela-funcionarios">
                        <div class="tabela-header">
                            <div class="col-nome">Nome</div>
                            <div class="col-sexo">Sexo</div>
                            <div class="col-idade">Idade</div>
                        </div>
                        <div class="tabela-linhas">
                            <div class="tabela-linha">
                                <div class="col-nome">Bruno de Lima Alves</div>
                                <div class="col-sexo">Masculino</div>
                                <div class="col-idade">28</div>
                            </div>
                            <div class="tabela-linha">
                                <div class="col-nome">Maria Ágatha de Oliveira Lima</div>
                                <div class="col-sexo">Feminino</div>
                                <div class="col-idade">25</div>
                            </div>
                            <div class="tabela-linha">
                                <div class="col-nome">Sofia de Oliveira Paulino</div>
                                <div class="col-sexo">Feminino</div>
                                <div class="col-idade">26</div>
                            </div>
                            <div class="tabela-linha">
                                <div class="col-nome">Cicero Viturino Pereira</div>
                                <div class="col-sexo">Masculino</div>
                                <div class="col-idade">32</div>
                            </div>
                            <div class="tabela-linha">
                                <div class="col-nome">Carlos André Bezerra Marques</div>
                                <div class="col-sexo">Masculino</div>
                                <div class="col-idade">38</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>

</html>