<?php
  session_start();

  $email = $_POST['login-form-email'];
  $senha = $_POST['login-form-password'];

  if ($email == 'root@gmail.com' && $senha == '123') {
    header('Location: admin.php');
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