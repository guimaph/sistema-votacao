<?php
    require_once('app/Controllers/ControllerVoto.php');

    $ctllrRead = new ControllerVoto();

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
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <title>Resultados da Votação</title>
</head>
<body class="w-100 h-100">
    <form name="delForm" id="delForm" method="POST">
        <input type="hidden" value="1" name="del">
    
    <h1 class="text-center mt-2 fw-bold">Listagem de Votos</h1>
    <div class="row row-cols-2 p-4 align-items-center">
        <div class="col">
            <?php foreach($ctllrRead->readTotal() as $total){?>
                <div class="col">
                    <ul>
                        <li><span class="fw-bold fs-4">Total de Votos por Candidato</span>
                            <ul>
                                <li><strong>Bill Gates:</strong> <?php echo $total["qtd_bill"] ?> votos.</li>
                                <li><strong>Mark Zuckerberg:</strong> <?php echo $total["qtd_mark"] ?> votos.</li>
                            </ul>
                        </li>
                    </ul>
                </div>
            <?php }?>
        </div>
        <div class="col mb-2 text-end">
            <button class="btn btn-primary btn-lg" onclick="swithDocument('vote')">Página de Votação</button>
            <input type="submit" class="btn btn-danger btn-lg" value="Limpar Votos"></input>
        </div>
        <div class="m-0 p-0 w-100 h-100">
            <table class="table table-striped m-0 p-0 w-100 h-100" >
                <thead class="table-dark">
                    <tr>
                        <th>Nome</th>
                        <th>CPF</th>
                        <th>Idade</th>
                        <th>Candidato</th>
                        <th>Data Registro</th>
                    </tr>
                </thead>
                <tbody >
                    <?php if(!empty($ctllrRead->readVoto())) foreach($ctllrRead->readVoto() as $votos){?>
                        <tr>
                            <td> <?php echo $votos["nome"] ?> </td>
                            <td> <?php echo $votos["cpf"] ?> </td>
                            <td> <?php echo $votos["idade"] ?> </td>
                            <td> <?php echo $votos["candidato"] ?> </td>
                            <td> <?php echo date('d/m/Y', strtotime($votos["data_registro"])) ?> </td>
                        </tr>
                    <?php }?>
                </tbody>
            </table>
        </div>
    </div>
    </form>
</body>
<script src="js/script.js"></script>
</html>