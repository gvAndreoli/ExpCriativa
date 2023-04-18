<?php
  require('./db/conn.php');
  session_start();

  $nome = $_POST['nome'];
  $email = $_POST['email'];
  $lattes = $_POST['lattes'];
  $senha = $_POST['senha'];
  $tipo_usuario = 2;
  
  $sql = "INSERT INTO usuario (nome, email, senha, lattes, tipo_usuario) VALUES ('$nome', '$email', '$senha', '$lattes', '$tipo_usuario')";

  if ($result = $conn->query($sql)) {
    $msg = "Registro cadastrado com sucesso! Você já pode realizar login.";
  } else {
    $_SESSION['nao-autenticado'] = true;
    $_SESSION['msg-title']= "Erro de cadastro";
    $msg = "Erro executando INSERT: " . $conn-> error . " Tente novo cadastro.";
  }

  header('Location: ./admin.php');
?>