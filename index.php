<?php

include 'BD.php';
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
    <?php

    //cria um instancia do objeto BD
    $objBD = new BD();
    //Faz a chamada do metodo Connection para conecta com o Banco de Dados
    $objBD->connection();

    if (!empty($_POST['nome'])) {
        //chama o metodo INSERT recebendo os dados do usuário através do metodo $_POST
        $objBD->insert($_POST);

        $result =  $objBD->select();
        foreach ($result as $itens) {
            echo "ID: " . $itens['id'] . " - Nome: " . $itens['nome'] . " - Telefone: " . $itens['telefone'] . " - CPF: " . $itens['cpf']  . "<br>";
        }
    }


    ?>
    <form method="post">
        <label for="nome">Nome:</label><br>
        <input type="text" id="nome" name="nome" required><br>

        <label for="telefone">Telefone:</label><br>
        <input type="text" id="telefone" name="telefone" required><br>

        <label for="cpf">CPF:</label><br>
        <input type="text" id="cpf" name="cpf" required>

        <input type="submit" value="Salvar" />
        <!-- 
        <input type="checkbox" id="veiculo1" name="veiculo1" value="Bike">
        <label for="veiculo1"> Eu tenho uma Bike</label><br>
        <input type="checkbox" id="veiculo2" name="veiculo2" value="carro">
        <label for="veiculo2"> Eu tenho uma carro</label><br>
        <input type="checkbox" id="veiculo3" name="veiculo3" value="Moto">
        <label for="veiculo3"> Eu tenho uma Moto</label><br><br>


        <input type="radio" id="male" name="genero" value="masculino">
        <label for="masculino">masculino</label><br>
        <input type="radio" id="feminino" name="genero" value="feminino">
        <label for="feminino">feminino</label><br>
        <input type="radio" id="outros" name="genero" value="outros">
        <label for="outros">Outros</label>

        -->
    </form>

</body>

</html>