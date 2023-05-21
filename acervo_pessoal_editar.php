<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>BIORECORD</title>
  <link rel="shortcut icon" href="./imgs/plant_nature_leaves_leaf_dirt_earth_icon_141982.svg" type="image/x-icon" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css" />
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <link rel="stylesheet" href="./styles/index.css" />
</head>

<body>
  <header>
    <div class="logo-container">
      <a href="./index.html">
        <h1 class="logo">BioRecord</h1>
      </a>
    </div>
    <div id="nav-container" class="navbar is-success">
      <nav>
        <a class="navbar-item is-success" href="./acervo_pessoal.php">Acervo Pessoal</a>
      </nav>
      <div>
        <a class="button is-danger">Logout</a>
      </div>
    </div>
  </header>
  <main>
    <h1 id="menu-title">Editar Usuário</h1>
    <br />
    <section>
      <?php
        require('./db/conn.php');
        session_start();
        $id = $_GET['id'];
        $sql = "SELECT * FROM publicacao where id_publicacao = $id";
        // Executando a consulta SQL
        $resultado = $conn->query($sql);
        if ($resultado->num_rows > 0) {
          while ($row = $resultado->fetch_assoc()) {
            $nome_especie = $row['nome_especie'];
            $nome_cientifico = $row['nome_cientifico'];
            $nivel_trofico = $row['nivel_trofico'];
            $estado_conservacao = $row['estado_conservacao'];
            $url_imagem = $row['url_imagem'];
          }
        }
      ?>
      <div class="container">
        <form id="register-form" method="post" action="./acervo_pessoal_editar_exe.php" enctype="multipart/form-data">
          <input type="hidden" value="<?php echo $id?>" name="id"></input>
          <div class="field">
            <p class="control">
              <input class="input" type="text" placeholder="Nome da espécie" name="nome_especie" required
                pattern=".{4,}" title="Por favor, insira pelo menos 4 caracteres" value=<?php echo $nome_especie ?> />
            </p>
          </div>
          <div class="field">
            <p class="control">
              <input class="input" type="text" placeholder="Nome científico da espécie" name="nome_cientifico" required
                pattern=".{4,}" title="Por favor, insira pelo menos 4 caracteres"
                value=<?php echo $nome_cientifico ?> />
            </p>
          </div>
          <div class="field">
            <p class="control">
              <input class="input" type="text" placeholder="Nível trófico" name="nivel_trofico" required pattern=".{4,}"
                title="Por favor, insira pelo menos 4 caracteres" value=<?php echo $nivel_trofico ?> />
            </p>
          </div>
          <div class="field">
            <label for="estado_conservacao">Estado de conservação: </label>
            <select name="estado_conservacao">
              <?php
                    $sql = "SELECT * FROM estado_conservacao";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                      while ($row = $result->fetch_assoc()) {
                        $selected = ($row['id_estado'] == $valor_do_banco_de_dados) ? 'selected' : '';
                        echo '<option value="' . $row['id_estado'] . '" ' . $selected . '>' . $row['descricao'] . '</option>';
                      }
                    }
                  ?>
            </select>
          </div>
          <label>Escolha uma imagem: </label><br>
          <div class="file">
            <label class="file-label">
              <input class="file-input" type="file" name="imagem" required title="Por favor, insira uma imagem!">
              <span class="file-cta">
                <span class="file-icon">
                  <i class="fa fa-upload"></i>
                </span>
                <span class="file-label">
                  Escolha um arquivo
                </span>
              </span>
            </label>
          </div>
          <br>
          <div class="field">
            <p class="control" id="btn-login-container">
              <button class="button is-info" id="btn-register">
                Editar
              </button>
            </p>
          </div>
        </form>
      </div>
    </section>
  </main>
  <script src="./js/index.js"></script>
</body>

</html>