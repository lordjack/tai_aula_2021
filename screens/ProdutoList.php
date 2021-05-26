<?php
include '../database/bd.php';
include '../Util.php';

verificarLogin();


$objBD = new bd();
$tabela = "tb_produto";
if (!empty($_POST['valor'])) {
    $result = $objBD->search($tabela, $_POST);
} else {
    //select * from tb_produto
    $result = $objBD->select($tabela);
}

if (!empty($_GET['id'])) {
    $objBD->remove($tabela, $_GET['id']);
    header("location:ProdutoList.php");
}

?>
<?php
include "./head.php";
?>

<h4>Listagem de Produtos</h4>
<form action="ProdutoList.php" method="post">
    <div class="form-row">
        <div class="col-3">
            <input type="text" class="form-control" placeholder="Digite sua pesquisa..." name="valor" id="">
        </div>
        <div class="col-3">
            <select name="tipo" class="form-control" id="">
                <option value=" nome">Nome</option>
                <option value="tipo">Tipo</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary"> <i class="fas fa-search"></i> Buscar</button>
        <div class="col-3">
            <a href="./ProdutoForm.php" class="btn btn-success"> <i class="fas fa-plus-circle"></i> Cadastrar</a>
        </div>
    </div>
</form>
<p></p>
<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Imagem</th>
            <th scope="col">Nome</th>
            <th scope="col">Valor Unitário</th>
            <th scope="col">Tipo</th>
            <th scope="col">Ação</th>
            <th scope="col">Ação</th>
        </tr>
    </thead>
    <tbody>
        <?php

        foreach ($result as $item) {
            $item = (object) $item;

            if (!empty($item->nome_arquivo) && file_exists(dirname(dirname(__FILE__)) . "/uploads/" . $item->nome_arquivo)) {
                $nome_arquivo =  $url_projeto . "/uploads/" . $item->nome_arquivo;
            } else {
                $nome_arquivo = $url_projeto . "/uploads/sem_imagem.jpg";
            }
            echo "
        <tr>
            <th scope='row'>" . $item->id . "</th> 
            <td><img class='card-img-top' src='" . $nome_arquivo . "' alt='imagem Produto' style='width: 150px;height: 150px;max-width: 100%;'></td>
            <td>" . $item->nome . "</td>
            <td>" . $item->valor_unitario . "</td>
            <td>" . $item->tipo . "</td>
            <td><a href='ProdutoForm.php?id=" . $item->id . "' style='color:orange;' ><i class='fas fa-edit'></i></a> </td>
            <td><a href='ProdutoList.php?id=" . $item->id . "' onclick=\"return confirm('Deseja realmente remover o registro?'); \" style='color:red;'><i class='fas fa-trash'></i></a> </td>
        </tr>
        ";
        }
        ?>
    </tbody>
</table>
<?php
include "./footer.php";
?>