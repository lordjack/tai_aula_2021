<?php
include "./head.php";
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