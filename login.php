<?php
  session_start();
  
  require('./db/conn.php');

  $email = $_POST['login-form-email'];
  $senha = $_POST['login-form-password'];

  $sql = "SELECT * FROM usuario WHERE email = '$email' AND senha = '$senha'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    unset($_SESSION['nao-autenticado']);
    unset($_SESSION['msg-title']);
    unset($_SESSION['mensagem']);
    
    $row = $result->fetch_assoc();
    $nomeUsuario = $row['nome'];
    $_SESSION['nomeUsuario'] = $nomeUsuario;
    $_SESSION['tipo_usuario'] = $row['tipo_usuario'];
    $_SESSION['user_id'] = $row['id_usuario'];
    if ($_SESSION['tipo_usuario'] == 1) {
      header('Location: ./admin.php');
    } else {
      header('Location: ./menu.php');
    }
  }
  else {
    $_SESSION['nao-autenticado'] = true;
    $_SESSION['msg-title']= "Erro de login";
    $_SESSION['mensagem'] = "O e-mail ou senha estão incorretos! Tente Novamente.";
    $_SESSION['notification-color']= 'is-info';
    header('Location: ./index.php');
  }
?>