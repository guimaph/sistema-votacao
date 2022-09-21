<?php
    require_once('app/Models/Voto.php');
    require_once('app/Controllers/ControllerVoto.php');

    // $nome = $_POST['nome'];
    // $cpf = $_POST['cpf'];
    // $idade = $_POST['idade'];
    // $candidato = $_POST['candidato'];

    if (!empty($_POST['nome']) && !empty($_POST['cpf']) && !empty($_POST['idade']) && !empty($_POST['candidato'])) {
    
        $voto = new Voto($_POST['nome'], $_POST['cpf'], $_POST['idade'], $_POST['candidato']);

        $voto->validarVoto();

        if (empty($voto->erro)) {
            $ctllrCreate = new ControllerVoto();
            $ctllrCreate->createVoto($voto);
        }
    }

    if (!empty($_POST['del'])) {
        $ctllrRead->deleteVoto();
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Votação</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-primary p-5 vh-100">
    <div id="vote_container" class="container border border-2 rounded-4 p-4 bg-white" style="max-width: 450px">
        <form method="POST">
            <h1 class="mb-4 text-center fw-bold">VOTAÇÃO</h1>
            <div class="row">
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" name="nome" class="form-control form-control-lg bg-light" value="" required >
                </div>

                <div class="mb-3 col-6">
                    <label for="cpf" class="form-label">CPF</label>
                    <input type="text" name="cpf" class="form-control form-control-lg bg-light" value="" required size="14" maxlength="14" oninput="mascararCpf(this)">
                </div>

                <div class="mb-4 col-6">
                    <label for="idade" class="form-label">Idade</label>
                    <input type="number" name="idade" class="form-control form-control-lg bg-light" value="" required size="3" maxlength="3">
                </div>

                <div class="mb-3 col-sm-4" style="max-width: 130px; max-height: 130px">
                    <img src="assets/images/bill_gates.jpg" class="img-thumbnail" alt="Bill Gates">
                </div>

                <div class="mb-3 col-sm-8">
                    <div class=" form-check position-relative top-50 start-50 translate-middle">
                        <input class="form-check-input fs-5" type="radio" value="1" id="bill_radio" name="candidato" required>
                        <label for="bill_radio" class="form-check-label fw-bold fs-5">Bill Gates</label>
                    </div>
                </div>

                <div class="mb-3 col-sm-4" style="max-width: 130px; max-height: 130px">
                    <img src="assets/images/mark_zuckerberg.jpg" class="img-thumbnail" alt="Mark Zuckerberg">
                </div>
                
                <div class="mb-3 col-sm-8">
                    <div class="form-check position-relative top-50 start-50 translate-middle">
                        <input class="form-check-input fs-5" type="radio" value="2" id="mark_radio" name="candidato" required>
                        <label for="mark_radio" class="form-check-label fw-bold fs-5">Mark Zuckerberg</label>
                    </div>
                </div>
            </div>
            <div class="d-grid mb-3">
                <input type="submit" value="VOTAR" class="btn btn-primary btn-lg">
            </div>

            <div class="d-grid mb-3">
                <button class="btn btn-lg btn-outline-primary" onclick="swithDocument('result')">VISUALIZAR RESULTADO</button>
            </div>

            <?php if(isset($voto) && !empty($voto->erro)) {?>
                <script src="js/showMessage.js" onload="mostrarMensagem('error', 'Erro', '<?php echo $voto->erro; ?>');"></script>
            <?php } elseif(isset($ctllrCreate) && !empty($ctllrCreate->erroCtrlVoto)) {?>
                <script src="js/showMessage.js" onload="mostrarMensagem('success', 'Sucesso', '<?php echo $ctllrCreate->erroCtrlVoto; ?>');"></script>
            <?php } ?>
        </form>
    </div>
    <form name="delForm" id="delForm" action="POST">
        <input type="hidden" value="1" name="del">
    </form>
    <iframe class="d-none w-100 h-100 rounded" id="result_container" src="relatorio.php" frameborder="0"> </iframe>

</body>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/script.js"></script>
</html>