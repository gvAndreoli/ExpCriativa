<?php
  session_start();
  
  require_once 'conn.php';

  $email = $_POST['login-form-email'];
  $senha = $_POST['login-form-password'];

  $sql = "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    header('Location: logged.php');
    unset($_SESSION['nao-autenticado']);
    unset($_SESSION['msg-title']);
    unset($_SESSION['mensagem']);
  }
  else {
    $_SESSION['nao-autenticado'] = true;
    $_SESSION['msg-title']= "Erro de login";
    $_SESSION['mensagem'] = "O e-mail ou senha estão incorretos! Tente Novamente.";
    $_SESSION['notification-color']= 'is-info';
    header('Location: ./menu.php');
  }
?>
