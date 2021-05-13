<?php
include "../database/bd.php";
include "./head.php";

session_start();

$_SESSION['usuario'] = null;

$obj = new bd();

if (!empty($_POST)) {
    $objUsuario = $obj->logar($_POST['login'], $_POST['senha']);

    // var_dump($objUsuario);
    //exit;
    if (!empty($objUsuario)) {
        $_SESSION['usuario'] = $objUsuario;
        header("Location: ./principal.php");
    } else {
        echo "<p style='color:red;'>Login ou Senha errado, tente novamente!</p>";
    }
}

?>

<h2>Bem vindo, informe suas credênciais</h2>
<form action="LoginForm.php" method="post">
    <div class="col-3">
        <label for="login">Login</label>
        <input type="text" name="login" class="form-control" require id="login" placeholder="usuario"><br>
    </div>
    <div class="col-3">
        <label for="senha">Senha</label>
        <input type="password" name="senha" class="form-control" id="senha" require placeholder="******">
    </div>
    <div class="col-3">
        <br>
        <button type="submit" class="btn btn-success"> <i class="fas fa-user"></i> Entrar</button>
    </div>
</form>
<?php
include "./footer.php";
?>