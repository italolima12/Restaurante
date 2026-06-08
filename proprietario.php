<?php
class LoginProprietario
{

    private $usuarios = [
        "Prop01" => "01",
        "Prop02" => "012",
        "Prop03" => "0123",
        "Prop04" => "01234",
        "Prop05" => "012345",
        "Prop06" => "0123456",
        "Prop07" => "01234567",
        "Prop08" => "012345678",
        "Prop09" => "0123456789"
    ];

    public function verificar(string $login, string $senha)
    {

        if (isset($this->usuarios[$login]) && $this->usuarios[$login] == $senha) {
            header("Location: propicadastrar.php?cargo=proprietario");
            exit();
        }

        return false;
    }
}

$erro = false;

if (isset($_POST["login"]) && isset($_POST["senha"])) {

    $login = $_POST["login"];
    $senha = $_POST["senha"];

    $proprietario = new LoginProprietario();

    if (!$proprietario->verificar($login, $senha)) {
        $erro = true;
    }
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
<meta charset="UTF-8">
<title>Proprietario</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="proprietario.css">
</head>

<body>

<main class="interface">

        <section class="card-proprietario">

            <div class="painel-proprietario">

                <p class="tagline">Bem-vindo ao login</p>
                <h1>
                    Proprietário
                </h1>

                <div class="photo-strip">
                    <span class="foto foto-1"><span class="foto-legenda">Administração</span></span>
                    <span class="foto foto-2"><span class="foto-legenda">Organização</span></span>
                    <span class="foto foto-3"><span class="foto-legenda">Planejamento</span></span>
                </div>

                <?php
                if ($erro) {
                    echo '<p class="erro-login">Login incorreto!</p>';
                }
                ?>

                <form class="form-proprietario" action="" method="post" autocomplete="off">

                    <input type="text" name="login" placeholder="Login:" required>

                    <input type="password" name="senha" placeholder="Senha:" required>

                    <div class="botao-proprietario">

                        <input type="submit" value="Entrar">
                    </div>

                </form>

            </div>

        </section>

    </main>
</body>
</html>