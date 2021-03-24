<?php
include "./header.php";
include '../database/bd.php';

$objBD = new bd();

if (!empty($_POST['nome'])) {
    $dados = [
        "nome" => $_POST['nome']
    ];
}

$result = $objBD->select();

?>
<h3>Listagem de Usuários</h3>
<a href="../index.php">Voltar</a>
<a href="./UsuarioForm.php">Cadastrar</a>
<table>
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Telefone</th>
        <th>CPF</th>
        <th>Ação</th>
    </tr>
    <?php
    foreach ($result as $item) {
        $item = (object) $item;

        echo "
                <tr>
                <td>" . $item->id . "</td>
                <td>" . $item->nome . "</td>
                <td>" . $item->telefone . "</td>
                <td>" . $item->cpf . "</td>
                </tr>";
    }
    ?>
</table>


<?php
include "./footer.php";
?>