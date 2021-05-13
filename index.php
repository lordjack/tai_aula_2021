<?php

session_start();

if (empty($_SESSION['usuario'])) {
    header("Location: ./screens/LoginForm.php");
} else {
    header("Location:./screens/principal.php");
}
