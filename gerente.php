<?php
class LoginGerente
{

    private $usuarios = [
        "GE01" => "01",
        "GE02" => "012",
        "GE03" => "0123",
        "GE04" => "01234",
        "GE05" => "012345",
        "GE06" => "0123456",
        "GE07" => "01234567",
        "GE08" => "012345678",
        "GE09" => "0123456789"
    ];

    public function verificar(string $login, string $senha)
    {

        if (isset($this->usuarios[$login]) && $this->usuarios[$login] == $senha) {
            header("Location: gerentecadastrar.php?cargo=gerente");
            exit();
        }

        return false;
    }
}

$erro = false;

if (isset($_POST["login"]) && isset($_POST["senha"])) {

    $login = $_POST["login"];
    $senha = $_POST["senha"];

    $gerente = new LoginGerente();

    if (!$gerente->verificar($login, $senha)) {
        $erro = true;
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Gerente</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="gerente.css">
</head>

<body>

    <main class="interface">

        <section class="card-gerente">

            <div class="painel-gerente">

                <p class="tagline">Bem-vindo ao login</p>
                <h1>
                    Gerente
                </h1>

                <div class="photo-strip">
                    <span class="foto foto-1"><span class="foto-legenda">Cadastros</span></span>
                    <span class="foto foto-2"><span class="foto-legenda">Auxílios</span></span>
                    <span class="foto foto-3"><span class="foto-legenda">Desenvolvimentos</span></span>
                </div>

                <?php
                if ($erro) {
                    echo '<p class="erro-login">Login incorreto!</p>';
                }
                ?>


                <form action="" method="post" autocomplete="off">

                    <input type="text" name="login" placeholder="Login:" required>

                    <input type="password" name="senha" placeholder="Senha:" required>

                    <div class="botao-gerente">

                        <input type="submit" value="Entrar">
                    </div>

                </form>

            </div>

        </section>

    </main>

</body>

</html>