<?php
  session_start();
  require('./db/conn.php');
  $id = $_GET['id'];

  $sql_publicacoes = "DELETE FROM publicacao WHERE id_autor=$id";

  if ($conn->query($sql_publicacoes) === TRUE) {
    $sql = "DELETE FROM usuario WHERE id_usuario =$id";

    if ($conn->query($sql) === TRUE) {
      unset($_SESSION['nao-autenticado']);
      unset($_SESSION['msg-title']);
      unset($_SESSION['mensagem']);
    } else {
      $_SESSION['nao-autenticado'] = true;
      $_SESSION['msg-title']= "Erro de exclusão";
      $_SESSION['mensagem'] = "Falha ao excluir usuário.";
    }
  }

  header('Location: ./admin.php');
?>