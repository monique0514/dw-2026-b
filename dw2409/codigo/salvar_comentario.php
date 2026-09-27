<?php
session_start();
require_once "conexao.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $texto = $_POST['texto'] ?? '';
    $idpostagem = $_POST['idpostagem'] ?? '';
    $idusuario = $_POST['idusuario'] ?? '';

    $_SESSION['texto'] = $texto;
    $_SESSION['idusuario'] = $idusuario;

    $sql = "INSERT INTO comentario (idusuario, idpostagem, texto) VALUES (?, ?, ?)";
    $comando = mysqli_prepare($conexao, $sql);

    if ($comando) {
        mysqli_stmt_bind_param($comando, "iis", $idusuario, $idpostagem, $texto);
        
        mysqli_stmt_execute($comando);
        mysqli_stmt_close($comando);
    }

    header("Location: listar_postagem.php");
    exit();
}
?>