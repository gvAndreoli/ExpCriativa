<?php
require('./db/conn.php');
session_start();
$id = $_POST['id'];
$autor = $_SESSION['user_id'];
$nome_especie = $_POST['nome_especie'];
$nome_cientifico = $_POST['nome_cientifico'];
$nivel_trofico = $_POST['nivel_trofico'];
$estado_conservacao = $_POST['estado_conservacao'];

if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == UPLOAD_ERR_OK) {
  $imagem = $_FILES['imagem'];

  // Obtenha o caminho temporário do arquivo
  $caminho_temporario = $imagem['tmp_name'];

  // Gere um nome de arquivo único para evitar conflitos
  $nome_arquivo = uniqid() . '_' . $imagem['name'];

  // Defina o caminho onde a imagem será salva
  $caminho_destino = './imgs/' . $nome_arquivo;

  // Tente mover o arquivo para o destino
  if (move_uploaded_file($caminho_temporario, $caminho_destino)) {
    // Salve o caminho da imagem no banco de dados
    $sql = "UPDATE publicacao SET estado_conservacao = '$estado_conservacao', nivel_trofico = '$nivel_trofico', nome_especie='$nome_especie', nome_cientifico='$nome_cientifico', url_imagem='./imgs/" . $nome_arquivo . "' WHERE id_publicacao = $id";
    if (mysqli_query($conn, $sql)) {
      $_SESSION['msg'] = 'Espécie atualizada com sucesso!';
    } else {
      $_SESSION['msg'] = 'Erro ao atualizar a espécie.';
    }
  } else {
    $_SESSION['msg'] = 'Erro ao mover o arquivo para o destino.';
  }
} else {
  // Se nenhum arquivo de imagem foi enviado, atualize apenas os outros campos no banco de dados
  $sql = "UPDATE publicacao SET estado_conservacao = '$estado_conservacao', nivel_trofico = '$nivel_trofico', nome_especie='$nome_especie', nome_cientifico='$nome_cientifico' WHERE id_publicacao = $id";
  if (mysqli_query($conn, $sql)) {
    $_SESSION['msg'] = 'Espécie atualizada com sucesso!';
  } else {
    $_SESSION['msg'] = 'Erro ao atualizar a espécie.';
  }
}

// Redirecione de volta para a página acervo_pessoal.php
header('Location: ./menu.php');
exit();
?>