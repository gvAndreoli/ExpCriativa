<?php
  require('./db/conn.php');
  session_start();

  $id = $_POST['id'];
  $nome = $_POST['nome'];
  $email = $_POST['email'];
  $lattes = $_POST['lattes'];
  $senha = $_POST['senha'];
  $senhaC = $_POST['senhaC'];
  $tipo_usuario = 2;
  
  if ($senha == $senhaC) {
    $sql = "UPDATE usuario SET nome = '$nome', email = '$email', lattes='$lattes', senha='$senha' where id_usuario = $id";

    if ($conn->query($sql) == TRUE) {
      unset($_SESSION['nao-autenticado']);
      unset($_SESSION['msg-title']);
      unset($_SESSION['mensagem']);
    } else {
      $_SESSION['nao-autenticado'] = true;
      $_SESSION['msg-title']= "Erro de cadastro";
      $_SESSION['mensagem'] = "Falha ao atualizar usuário.";
    }
  } else {
    $_SESSION['nao-autenticado'] = true;
    $_SESSION['msg-title']= "Erro de atualização";
    $_SESSION['mensagem'] = "Falha ao atualizar usuário. Senhas não conferem";
  }


  header('Location: ./admin.php');
?>