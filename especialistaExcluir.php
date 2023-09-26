<?php
  session_start();
  require('./db/conn.php');
  $id = $_GET['id'];



  $sql = "DELETE FROM usuario WHERE id_usuario =$id";

  if ($conn->query($sql) === TRUE) {
    unset($_SESSION['nao-autenticado']);
    unset($_SESSION['msg-title']);
    unset($_SESSION['mensagem']);
  } else {
    $_SESSION['nao-autenticado'] = true;
    $_SESSION['msg-title']= "Erro de exclusão";
    $_SESSION['mensagem'] = "Falha ao excluir especialista, verifique se não existem publicações associadas a ele.";
  }

  header('Location: ./admin.php');
?>