<?php
session_start();

function verificarLogin()
{
    if (empty($_SESSION['usuario'])) {
        session_destroy();
        header("Location: LoginForm.php");
    }
}

function uploadImagem($nome_arquivo)
{
    try {

        $uploadOk = 1;
        $_FILES["nome_arquivo"] = $nome_arquivo;

        if (!isset($_FILES["nome_arquivo"])) {
            $uploadOk = 0;
        }

        $ext = pathinfo($_FILES["nome_arquivo"]["name"], PATHINFO_EXTENSION);
        // Allow certain file formats
        if (
            $ext != "jpg" && $ext != "png" && $ext != "jpeg"
            && $ext != "gif"
        ) {
            echo "Desculpe, só é permitido os formatos JPG, JPEG, PNG & GIF.";
            $uploadOk = 0;
        }

        if ($uploadOk != 0) {

            $nome_arquivo = date("d_m_Y_H_i_s") . "." . $ext;
            $dir = dirname(__FILE__) . DIRECTORY_SEPARATOR . "uploads" . DIRECTORY_SEPARATOR;

            move_uploaded_file($_FILES["nome_arquivo"]["tmp_name"], $dir . $nome_arquivo);

            return $nome_arquivo;
        } else {
            echo "Erro ao fazer upload da imagem.";
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
