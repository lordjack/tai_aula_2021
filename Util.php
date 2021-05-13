<?php
session_start();

function verificarLogin()
{
    if (empty($_SESSION['usuario'])) {
        session_destroy();
        header("Location: LoginForm.php");
    }
}
