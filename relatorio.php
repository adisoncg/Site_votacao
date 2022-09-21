<?php
require_once('app/Models/Votacao.php');
require_once('app/Controllers/ControllerVotacao.php');

$votacaoDao = new ControllerUsuario();
$result = new ContaVotos();

if (!empty($_POST['nome']) && !empty($_POST['cpf']) && !empty($_POST['idade']) && !empty($_POST['voto'])) {
    $votacao = new votacao($_POST['nome'], $_POST['cpf'], $_POST['idade'], $_POST['voto']);

    //var_dump($usuario); //Obter informações da variável
    $votacao->validarDados();

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
    <title>Relatório Votação</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class=" container border border-2 rounded-4 p-4 bg-white mb-3 mt-3" style="max-width: 600px;">
        <div class="row">
            <h2 class="mb-4 text-center">Contador de votos</h2>

            <h2 class="mb-4 text-center">Rodrigo</h2>
            <p class="text-center fs-5"><?php echo $result->resultadoRodrigo(); ?></p>
            <h2 class="mb-4 text-center">Larissa</h2>
            <p class="text-center fs-5"><?php echo $result->resultadoLarissa(); ?></p>
</div>

            <?php if ($votacaoDao->readVotos()) { ?>
                <div class="container">
                    <h1>Registros</h1>
                    <table class="table table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th>Nome</th>
                                <th>Cpf</th>
                                <th>Idade</th>
                                <th>Voto</th>
                                <th>Data de Registro</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($votacaoDao->readVotos() as $votacao) { ?>
                                <tr>
                                    <td><?php echo $votacao["nome"]; ?></td>
                                    <td><?php echo $votacao["cpf"]; ?></td>
                                    <td><?php echo $votacao["idade"]; ?></td>
                                    <td><?php echo $votacao["voto"]; ?></td>
                                    <td><?php echo $votacao["data_registro"]; ?></td>
                                <?php } ?>
                                </tr>
                        </tbody>
                    </table>
                </div>
            <?php } ?>

            <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>