<?php

include './bd.php';

$objBD = new bd();

//var_dump($objBD->connection());

if (!empty($_POST['nome'])) {
    $dados = [
        "nome" => $_POST['nome'], "telefone" => $_POST['telefone'],
        "cpf" => $_POST['cpf']
    ];

    $objBD->insert($dados);
    echo "Registro inserido com sucesso!";
    header("location:index.php");
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="index.php" method="post">
        <h3>Formulário Usuário</h3>
        <label for="">Nome</label>
        <input type="text" name="nome" id="" required><br>

        <label for="">Telefone</label>
        <input type="text" name="telefone" id="" required><br>

        <label for="">CPF</label>
        <input type="text" name="cpf" id="" required><br>

        <input type="submit" value="Salvar">
    </form>
</body>

</html>