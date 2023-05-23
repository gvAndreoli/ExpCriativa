<?php
require('./db/conn.php');
session_start();
$autor = $_SESSION['user_id'];
$nome_especie = $_POST['nome_especie'];
$nome_cientifico = $_POST['nome_cientifico'];
$nivel_trofico = $_POST['nivel_trofico'];
$estado_conservacao = $_POST['estado_conservacao'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $imagens = []; // Inicia array para imagens

  if (!empty($_FILES['imagens']['name'][0])) {
    $totalImagens = count($_FILES['imagens']['name']); // Contagem das imagens recebidas

    for ($i = 0; $i < $totalImagens; $i++) { // Loop for para total de imagens
      if ($_FILES['imagens']['error'][$i] !== UPLOAD_ERR_OK) {
        echo 'Ocorreu um erro no upload da imagem ' . ($i + 1); // Se der erro de upload
        continue;
      }

      // Verifique se um arquivo foi enviado
      if ($_FILES['imagens']['error'][$i] == UPLOAD_ERR_OK) { // Se não der erro de upload
        // Obtenha o caminho temporário do arquivo
        $caminho_temporario = $_FILES['imagens']['tmp_name'][$i];

        // Gere um nome de arquivo único para evitar conflitos
        $nome_arquivo = uniqid() . '_' . $_FILES['imagens']['name'][$i];

        // Defina o caminho onde a imagem será salva
        $caminho_destino = './imgs/' . $nome_arquivo;

        // Tente mover o arquivo para o destino
        if (move_uploaded_file($caminho_temporario, $caminho_destino)) {
          // Salve o caminho da imagem no array
          $imagens[] = $caminho_destino;
        } else {
          $_SESSION['msg'] = 'Erro ao mover o arquivo para o destino.';
        }
      }
    }
  }

  $imagensJson = !empty($imagens) ? json_encode($imagens) : null; // Convertendo as imagens para o formato JSON, se houver imagens

  $sql = "UPDATE publicacao SET estado_conservacao = '$estado_conservacao', nivel_trofico = '$nivel_trofico', nome_especie='$nome_especie', nome_cientifico='$nome_cientifico'";
  
  if (!empty($imagensJson)) {
    $sql .= ", url_imagem='$imagensJson'"; // Adiciona a cláusula de atualização do campo url_imagem, se houver imagens
  }

  if ($conn->query($sql) === TRUE) {
    $_SESSION['msg'] = 'Cadastro realizado com sucesso!';
  } else {
    $_SESSION['msg'] = 'Erro ao cadastrar espécie: ' . $conn->error;
  }

  // Redirecione de volta para a página acervo_pessoal.php
  header('Location: ./acervo_pessoal.php');
  exit();
}
?>