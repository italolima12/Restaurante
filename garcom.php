<?php
class LoginGarcom {

    private $usuarios = [
        "G01" => "01",
        "G02" => "012",
        "G03" => "0123",
        "G04" => "01234",
        "G05" => "012345",
        "G06" => "0123456",
        "G07" => "01234567",
        "G08" => "012345678",
        "G09" => "0123456789"
    ];

    public function verificar(string $login, string $senha) {

        if (isset($this->usuarios[$login]) && $this->usuarios[$login] == $senha) {
            header("Location: contaberta.php?cargo=garcom");
            exit();
        }

        return false;
    }
}

$erro = false;

if (isset($_POST["login"]) && isset($_POST["senha"])) {

    $login = $_POST["login"];
    $senha = $_POST["senha"];

    $garcom = new LoginGarcom();

    if (!$garcom->verificar($login, $senha)) {
        $erro = true;
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Garcom</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="garcom.css">
</head>

<body>
    <main class="interface">
        <section class="card-garcom">
            <div class="painel-garcom">
                <p class="tagline">
                    Bem vindo ao login
                </p>
                <h1>
                    Garçom
                </h1>
                <div class="photo-strip">
                    <span class="foto foto-1"><span class="foto-legenda">Bebidas</span></span>
                    <span class="foto foto-2"><span class="foto-legenda">Serviços</span></span>
                    <span class="foto foto-3"><span class="foto-legenda">Pratos</span></span>
                </div>

                <?php
                if ($erro) {
                    echo "<p style='color: #6b2a2a; text-align:center;'>Login incorreto!</p>";
                }
                ?>


                <form class="form-garcom" action="" method="post" autocomplete="off">

                    <input type="text" name="login" placeholder="Login:" required>

                    <input type="password" name="senha" placeholder="Senha:" required>

                    <div class="botao-garcom">

                        <input type="submit" value="Entrar">
                    </div>
                </form>

            </div>

        </section>

    </main>

</body>

</html>