<?php

require_once('app/Models/Votacao.php');
require_once('app/Controllers/ControllerVotacao.php');

$votacaoDao = new ControllerUsuario();

if (!empty($_POST['nome']) && !empty($_POST['cpf']) && !empty($_POST['idade']) && !empty($_POST['voto'])) {

    $votacao = new votacao($_POST['nome'], $_POST['cpf'], $_POST['idade'], $_POST['voto']);

    $votacao->validarDados();
    //var_dump($votacao); 

    if (empty($votacao->erro)) {
        if ($votacao->getMsg() == "Idade Inválida!") {
            $class = "alert-danger";
        } elseif ($votacao->getMsg() == "CPF Inválido!") {
            $class = "alert-danger";
        } else {
            $class = "alert-success";
            $votacaoDao->createVotos($votacao);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votação</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-primary p-5">
    <div class="container border border-2 rounded-4 p-4 bg-white mb-5" style="max-width: 400px;">
        <form method="post">
            <h1 class="mb-4 text-center">Votação</h1>
            <div class="row">
                <div class="mb-3">
                    <label for="nome" class="form-label fw-bold">Nome de eleitor</label>
                    <input type="text" name="nome" class="form-control form-control-lg bg-light" value="" required>
                </div>

                <div class="mb-3">
                    <label for="cpf" class="form-label fw-bold">CPF</label>
                    <input name="cpf" id="cpf" class="form-control form-control-lg bg-light" value="" required>
                </div>

                <div class="mb-3">
                    <label for="idade" class="form-label fw-bold">Idade</label>
                    <input type="text" name="idade" class="form-control form-control-lg bg-light" value="" max-legth="11" size="11" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="rodrigo" class="fs-5 fw semibold">
                <img src="img/images.jpg" width="80" alt="">
                <input type="radio" id="rodrigo" name="voto" value="1" required>Rodrigo</label>
            </div>

            <div class="mb-3">
                <label for="larissa" class="fs-5 fw semibold">
                <img src="img/download.jpg" width="80" alt="">
                <input type="radio" id="larissa" name="voto" value="2" required>Larissa</label>
            </div>


            <div class="d-grid mb-4">
                <input type="submit" value="Votar" class="btn btn-primary btn-lg">
            </div>

            <?php if (isset($votacao)) { ?>
                <div class="alert text-center fs-4 <?php echo $class ?>" role="alert">
                    <span><?php echo $votacao->getMsg(); ?></span>
                </div>
            <?php } ?>

        </form>
    </div>

    <div class="d-grid mb-4 container text-center mb-3 mt-3" style="max-width: 400px;">
        <a href="relatorio.php" class="btn btn-dark">registros</a>
    </div>

</body>

</html>