<?php
  require('./db/conn.php');
  session_start();

  $id = $_POST['id'];
  $nome = $_POST['nome'];
  $email = $_POST['email'];
  $senha = $_POST['senha'];
  $tipo_usuario = 3;
  
  $sql = "UPDATE usuario SET nome = '$nome', email = '$email', senha='$senha' where id_usuario = $id";

  if ($conn->query($sql) == TRUE) {
    unset($_SESSION['nao-autenticado']);
    unset($_SESSION['msg-title']);
    unset($_SESSION['mensagem']);
  } else {
    $_SESSION['nao-autenticado'] = true;
    $_SESSION['msg-title']= "Erro de cadastro";
    $_SESSION['mensagem'] = "Falha ao atuWalizar usuário.";
  }

  header('Location: ./admin.php');
?>