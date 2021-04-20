<?php
include '../database/bd.php';

$objBD = new bd();

if (!empty($_POST['nome'])) {

    if (!empty($_POST['id'])) {
        $objBD->update($dados);
    } else {
        $objBD->insert($dados);
    }

    header("location:UsuarioList.php");
} elseif (!empty($_GET['id'])) {
    $result = $objBD->find($_GET['id']);
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

        <label for="">Nome</label>
        <input type="text" name="nome" id="" value="<?php echo !empty($result->nome) ? $result->nome : "" ?>" required><br>

        <label for="">Telefone</label>
        <input type="text" name="telefone" id="" value="<?php echo !empty($result->telefone) ? $result->telefone : "" ?>" required><br>

        <label for="">CPF</label>
        <input type="text" name="cpf" id="" value="<?php echo !empty($result->cpf) ? $result->cpf : "" ?>" required><br>

        <button type="submit" class="btn btn-success"> <i class="fas fa-save"></i> Salvar</button>
        <a href="./UsuarioList.php" class="btn btn-primary"> <i class="fas fa-arrow-left"></i> Voltar</a>
</form>
<?php
include "./footer.php";
?>