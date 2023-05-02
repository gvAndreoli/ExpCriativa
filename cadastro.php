<?php
  session_start();
  require('./db/conn.php');

  $nome = $_POST['nomeC'];
  $email = $_POST['emailC'];
  $senha = $_POST['senhaC'];
  $lattes = null;
  $confirmacao_senha = $_POST['senha_confC'];
  $tipo_usuario = 3; // Usuário Comum

  // ver se o usuario ja existe
  $sql_verificar_registros = "SELECT email FROM usuario WHERE email = '$email'";
  $result_verificacao = mysqli_query($conn, $sql_verificar_registros);

  if (mysqli_num_rows($result_verificacao) > 0) {
    // Exibe uma mensagem de erro caso o e-mail já tenha sido usado em outro cadastro
    $_SESSION['nao-autenticado'] = true;
    $_SESSION['msg-title']= "Erro de cadastro";
    $_SESSION['mensagem'] = "Este e-mail já foi usado! Tente Novamente.";
  } else {
    // Continua com o processo de cadastro
    $sql = "INSERT INTO usuario (nome, email, senha, lattes, tipo_usuario) VALUES ('$nome', '$email', '$senha', '$lattes', '$tipo_usuario')";
    // Tenta inserir no banco de dados
    if ($result = $conn->query($sql)) {
      $_SESSION['sucesso_cadastro'] = true;
      unset($_SESSION['nao-autenticado']);
      unset($_SESSION['msg-title']);
      unset($_SESSION['mensagem']);
    } else {
      // Caso de erro
      $_SESSION['nao-autenticado'] = true;
      $_SESSION['msg-title']= "Erro de cadastro, tente novamente";
      $_SESSION['mensagem'] = "Não foi possivel salvar seus dados! Tente Novamente.";
    }
  }

  header('Location: ./menu.php');


?>