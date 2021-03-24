<?php

include "./header.php";
include '../database/bd.php';

$objBD = new bd();

if (!empty($_POST['nome'])) {
    $dados = [
        "nome" => $_POST['nome'], "telefone" => $_POST['telefone'],
        "cpf" => $_POST['cpf']
    ];

    $objBD->insert($dados);
    echo "Registro inserido com sucesso!";
    header("location:UsuarioList.php");
}
?>

<form action="UsuarioForm.php" method="post">
    <h3>Formulário Usuário</h3>
    <label for="">Nome</label>
    <input type="text" name="nome" id="" required><br>

    <label for="">Telefone</label>
    <input type="text" name="telefone" id="" required><br>

    <label for="">CPF</label>
    <input type="text" name="cpf" id="" required><br>

    <input type="submit" value="Salvar">
    <a href="./UsuarioList.php">Voltar</a>
</form>

<?php
include "./footer.php";
?>