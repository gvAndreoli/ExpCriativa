<?php
  require('./db/conn.php');
session_start();
$autor = $_SESSION['user_id'];
$nome_especie = $_POST['nome_especie'];
$nome_cientifico = $_POST['nome_cientifico'];
$nivel_trofico = $_POST['nivel_trofico'];
$estado_conservacao = $_POST['estado_conservacao'];

if (isset($_FILES['imagem'])) {
  $imagem = $_FILES['imagem'];

  // Verifique se um arquivo foi enviado
  if ($imagem['error'] == UPLOAD_ERR_OK) {
    // Obtenha o caminho temporário do arquivo
    $caminho_temporario = $imagem['tmp_name'];

    // Gere um nome de arquivo único para evitar conflitos
    $nome_arquivo = uniqid() . '_' . $imagem['name'];

    // Defina o caminho onde a imagem será salva
    $caminho_destino = './imgs/' . $nome_arquivo;

    // Tente mover o arquivo para o destino
    if (move_uploaded_file($caminho_temporario, $caminho_destino)) {
      // Salve o caminho da imagem no banco de dados
      $sql = "INSERT INTO publicacao (id_autor, estado_conservacao, nivel_trofico, nome_especie, nome_cientifico, url_imagem) VALUES ('$autor', '$estado_conservacao', '$nivel_trofico', '$nome_especie', '$nome_cientifico' ,'./imgs/" . $nome_arquivo . "')";
      if (mysqli_query($conn, $sql)) {
        $_SESSION['msg'] = 'Espécie cadastrada com sucesso!';
      } else {
        $_SESSION['msg'] = 'Erro ao cadastrar espécie ';
      }
    } else {
      $_SESSION['msg'] = 'Erro ao mover o arquivo para o destino.';
    }
  } else {
    $_SESSION['msg'] = 'Erro ao fazer o upload da imagem: ' . $imagem['error'];
  }

  // Redirecione de volta para a página imagens.php
  header('Location: ./menu.php');
  exit();
}
?>