<?php
include '../database/bd.php';

$objBD = new bd();
$tabela = "tb_usuario";
if (!empty($_POST['valor'])) {
    $result = $objBD->search($tabela, $_POST);
} else {
    //select * from tb_usuario
    $result = $objBD->select($tabela);
}

if (!empty($_GET['id'])) {
    $objBD->remove($tabela, $_GET['id']);
    header("location:UsuarioList.php");
}

?>
<?php
include "./head.php";
?>

<h4>Listagem de Usuários</h4>
<form action="UsuarioList.php" method="post">
    <div class="form-row">
        <div class="col-3">
            <input type="text" class="form-control" placeholder="Digite sua pesquisa..." name="valor" id="">
        </div>
        <div class="col-3">
            <select name="tipo" class="form-control" id="">
                <option value=" nome">Nome</option>
                <option value="cpf">CPF</option>
                <option value="telefone">Telefone</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary"> <i class="fas fa-search"></i> Buscar</button>
        <div class="col-3">
            <a href="./UsuarioForm.php" class="btn btn-success"> <i class="fas fa-plus-circle"></i> Cadastrar</a>
        </div>
    </div>
</form>
<p></p>
<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Nome</th>
            <th scope="col">Telefone</th>
            <th scope="col">CPF</th>
            <th scope="col">Ação</th>
            <th scope="col">Ação</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($result as $item) {
            $item = (object) $item;
            echo "
        <tr>
            <th scope='row'>" . $item->id . "</th> 
            <td>" . $item->nome . "</td>
            <td>" . $item->telefone . "</td>
            <td>" . $item->cpf . "</td>
            <td><a href='UsuarioForm.php?id=" . $item->id . "' style='color:orange;' ><i class='fas fa-edit'></i></a> </td>
            <td><a href='UsuarioList.php?id=" . $item->id . "' onclick=\"return confirm('Deseja realmente remover o registro?'); \" style='color:red;'><i class='fas fa-trash'></i></a> </td>
        </tr>
        ";
        }
        ?>
    </tbody>
</table>
<?php
include "./footer.php";
?>