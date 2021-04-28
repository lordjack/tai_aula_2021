<?php
include '../database/bd.php';

$objBD = new bd();

$tabela = "tb_usuario";
$resultCategoria = $objBD->select("tb_categoria");

if (!empty($_POST['nome'])) {

    if (!empty($_POST['id'])) {
        $objBD->update($tabela, $_POST);
    } else {

        $objBD->insert($tabela, $_POST);
    }

    header("location:UsuarioList.php");
} elseif (!empty($_GET['id'])) {
    $result = $objBD->find($tabela, $_GET['id']);
}
?>

<?php
include "./head.php";
?>
<h3>Formulário Usuário</h3>

<form action="UsuarioForm.php" method="post">
    <input type="hidden" name="id" value="<?php echo !empty($result->id) ? $result->id : ""; ?>"><br>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="nome">Nome</label>
            <input type="text" name="nome" id="nome" class="form-control" value="<?php echo !empty($result->nome) ? $result->nome : "" ?>" required placeholder="Nome"><br>
        </div>
        <div class="form-group col-md-6">
            <label for="cpf">CPF</label>
            <input type="text" name="cpf" id="cpf" class="form-control" value="<?php echo !empty($result->cpf) ? $result->cpf : "" ?>" required placeholder="000.555.000-55"><br>
        </div>

        <div class="form-group col-md-2">
            <label for="telefone">Telefone</label>
            <input type="text" name="telefone" id="telefone" class="form-control" value="<?php echo !empty($result->telefone) ? $result->telefone : "" ?>" required placeholder="(84) 98800-5500)"><br>
        </div>
        <div class="form-group col-md-3">
            <label for="email">E-mail</label>
            <input type="email" name="email" id="email" class="form-control" value="<?php echo !empty($result->email) ? $result->email : "" ?>" required placeholder="exemplo@gmail.com"><br>
        </div>
        <div class="form-group col-md-2">
            <label for="data_nascimento">Data Nascimento</label>
            <input type="date" name="data_nascimento" id="data_nascimento" class="form-control" value="<?php echo !empty($result->data_nascimento) ? $result->data_nascimento : "" ?>" required placeholder="00/00/2000"><br>
        </div>
        <div class="form-group col-md-3">
            <label for="categoria_id">Categoria</label>
            <select class="custom-select" id="categoria_id" name="categoria_id">
                <?php
                foreach ($resultCategoria as $item) {
                    $item = (object) $item;

                    $selected = $item->id === $result->categoria_id ? "selected" : "";

                    echo " <option value=" . $item->id . " $selected>" . $item->nome . "</option>";
                }
                ?>
            </select>
        </div>
    </div>

    <button type="submit" class="btn btn-success"> <i class="fas fa-save"></i> Salvar</button>
    <a href="./UsuarioList.php" class="btn btn-primary"> <i class="fas fa-arrow-left"></i> Voltar</a>
</form>
<?php
include "./footer.php";
?>