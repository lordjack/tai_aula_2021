<?php
include '../database/bd.php';
include '../Util.php';

verificarLogin();

$objBD = new bd();

$tabela = "tb_produto";

if (!empty($_POST['nome'])) {

    if (!empty($_FILES["nome_arquivo"]["name"])) {
        $nome_arquivo = uploadImagem($_FILES["nome_arquivo"]);

        $_POST["nome_arquivo"] = $nome_arquivo;
    }

    if (!empty($_POST['id'])) {
        $objBD->update($tabela, $_POST);
    } else {

        $objBD->insert($tabela, $_POST);
    }

    header("location:ProdutoList.php");
} elseif (!empty($_GET['id'])) {
    $result = $objBD->find($tabela, $_GET['id']);
}
?>

<?php
include "./head.php";
?>
<h3>Formulário Produto</h3>

<form action="ProdutoForm.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo !empty($result->id) ? $result->id : ""; ?>"><br>
    <div class="form-row">

        <div class="form-group col-md-6">
            <label for="nome">Nome</label>
            <input type="text" name="nome" id="nome" class="form-control" value="<?php echo !empty($result->nome) ? $result->nome : "" ?>" required placeholder="Batata..."><br>
        </div>
        <div class="form-group col-md-6">
            <label for="valor_unitario">Valor Unitário</label>
            <input type="text" name="valor_unitario" id="valor_unitario" class="form-control" value="<?php echo !empty($result->valor_unitario) ? $result->valor_unitario : "" ?>" required placeholder="R$000.00"><br>
        </div>

        <div class="form-group col-md-3">
            <label for="tipo"> Tipo</label>
            <select class="custom-select" id="tipo" name="tipo">
                <?php

                $tipo = ["tipo_a" => "Tipo A", "tipo_b" => "Tipo B"];
                foreach ($tipo as $chave => $item) {

                    $selected = !empty($result->tipo) ? "selected" : "";

                    echo " <option value=" . $chave . " $selected>" . $item . "</option>";
                }
                ?>
            </select>
        </div>
        <?php
        // var_dump(file_exists(dirname(dirname(__FILE__)) . "/uploads/" . $result->nome_arquivo));
        // var_dump($url_projeto);
        //  exit;
        if (!empty($result->nome_arquivo) && file_exists(dirname(dirname(__FILE__)) . "/uploads/" . $result->nome_arquivo)) {
            $nome_arquivo =  $url_projeto . "/uploads/" . $result->nome_arquivo;
        } else {
            $nome_arquivo = $url_projeto . "/uploads/sem_imagem.jpg";
        }
        ?>

        <div class="card" style="width: 18rem;">
            <img class="card-img-top" src="<?php echo $nome_arquivo ?>" alt="imagem Produto">
            <label for="nome_arquivo">Arquivo</label>
            <input type="file" name="nome_arquivo" id="nome_arquivo" class="form-control" value="<?php echo !empty($result->nome_arquivo) ? $result->nome_arquivo : "" ?>"><br>
        </div>
    </div>


    <button type="submit" class="btn btn-success"> <i class="fas fa-save"></i> Salvar</button>
    <a href="./ProdutoList.php" class="btn btn-primary"> <i class="fas fa-arrow-left"></i> Voltar</a>
</form>
<?php
include "./footer.php";
?>