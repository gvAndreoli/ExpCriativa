<?php
  require('./db/conn.php');
  session_start();

  $nome = $_POST['nome'];
  $email = $_POST['email'];
  $lattes = $_POST['lattes'];
  $senha = $_POST['senha'];
  $tipo_usuario = 2; // usuario especialista

  // ver se o usuario ja existe
  $sql_verificar_registros = "SELECT email FROM usuario WHERE email = '$email'";
  $result_verificacao = mysqli_query($conn, $sql_verificar_registros);
  
  // adição no bd
  $sql = "INSERT INTO usuario (nome, email, senha, lattes, tipo_usuario) VALUES ('$nome', '$email', '$senha', '$lattes', '$tipo_usuario')";
  $sql_verificar_registros = "SELECT email FROM usuario WHERE email = '$email'";
  
  if (mysqli_num_rows($result_verificacao) > 0) {
    // Exibe uma mensagem de erro caso o e-mail já tenha sido usado em outro cadastro
    $_SESSION['nao-autenticado'] = true;
    $_SESSION['msg-title']= "Erro de cadastro";
    $_SESSION['mensagem'] = "Este e-mail já foi usado! Tente Novamente.";
    header('Location: ./admin.php');
  } else {
    // mandar msg de acordo com o resultado da operação no bd
    if ($result = $conn->query($sql)) {
      $msg = "Registro cadastrado com sucesso!";
      unset($_SESSION['nao-autenticado']);
      unset($_SESSION['msg-title']);
      unset($_SESSION['mensagem']);
      header('Location: ./admin.php');
    } else {
      $_SESSION['nao-autenticado'] = true;
      $_SESSION['msg-title']= "Erro de cadastro";
      $msg = "Erro executando INSERT: " . $conn-> error . " Tente novo cadastro.";
      header('Location: ./admin.php');
    }
  }
?>