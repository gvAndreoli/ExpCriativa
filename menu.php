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
    <?php
    require('./db/conn.php');
    session_start();
    if (!isset($_SESSION['login'])) {
      header('Location: ./index.php');
      $_SESSION['not-authenticated'] = true; 
    }
    ?>
    <div class="logo-container">
      <a href="./index.php">
        <h1 class="logo">BioRecord</h1>
      </a>
    </div>
    <div id="nav-container" class="navbar is-success">
      <nav>
        <a class="navbar-item is-success" href="./acervo_pessoal.php">Acervo Pessoal</a>
      </nav>
      <div>
        <button class="button is-info" style="cursor: default;"><strong>Usuário -
            <?php echo $_SESSION['nomeUsuario'] ?></strong></button>
        <button class="button is-info" style="cursor: default;"><strong>Privilégios -
            <?php
              if ($_SESSION['tipo_usuario'] == 2) {
                echo "Especialista";
              }
              if ($_SESSION['tipo_usuario'] == 3) {
                echo "Usuário Comum";
              }
              if ($_SESSION['tipo_usuario'] == 1) {
                echo "Administrador";
              }
            ?></strong></button>
        <a class="button is-danger" href="./logout.php">Logout</a>
        <?php
          if ($_SESSION['tipo_usuario'] == 2 || $_SESSION['tipo_usuario'] == 1) {
        ?>
        <button type="button" class="button is-warning js-modal-trigger" data-target="modal-js-cadastro">
          Cadastrar espécie
        </button>
        <?php
          }
        ?>
      </div>
    </div>
  </header>
  <main>
    <h1 id="menu-title">Acervo Global</h1>
    <br />
    <div class="container" id="acervo-pessoal-container">
      <?php
        $sql = "SELECT id_publicacao, id_autor, estado_conservacao, nivel_trofico, nome_especie, nome_cientifico, url_imagem from publicacao
        inner join usuario on usuario.id_usuario = publicacao.id_autor
        inner join tipo_usuario on usuario.tipo_usuario = tipo_usuario.id_tipo
        where tipo_usuario = 1 or tipo_usuario = 2";

        $resultado = mysqli_query($conn, $sql);

        if (mysqli_num_rows($resultado) > 0) {
          // Exiba cada imagem em uma tag HTML <img>
          while ($row = mysqli_fetch_assoc($resultado)) {
            $id_estado = $row['estado_conservacao'];
            $estado_cons = "SELECT * FROM estado_conservacao where id_estado='$id_estado'";
            $result_estado = $conn->query($estado_cons);
            if ($result_estado->num_rows > 0) {
              $row_estado = $result_estado->fetch_assoc();
            }
        ?> <br>
      <div class="card w-100 mb-3" style="width: 18rem">
        <img src="<?php echo $row['url_imagem'] ?>" style="height: 40vh;" class="card-img-top">
        <div class="card-body">
          <h5 class="card-title"><strong> <?php echo $row['nome_especie'] ?></strong></h5>
          <p class="card-text">
            <strong>Nível trófico:</strong> <?php echo $row['nivel_trofico'] ?>
          </p>
          <p class="card-text">
            <strong>Nome científico:</strong> <?php echo $row['nome_cientifico'] ?>
          </p>
          <p class="card-text">
            <strong>Estado de conservação:</strong> <?php echo $row_estado['descricao'] ?>
          </p>
        </div>
        <br>
        <?php
          if ($_SESSION['tipo_usuario'] == 2 || $_SESSION['tipo_usuario'] == 1) {
        ?>
        <a class="button is-info" href="acervo_global_editar.php?id=<?php echo $row['id_publicacao']; ?>">Editar</a>
        <a class="button is-danger"
          href="acervo_pessoal_excluir.php?id=<?php echo $row['id_publicacao']; ?>">Excluir</a>
        <?php
          }
        ?>
      </div>
      <?php
          }
        } else {
            echo '<div class="notification is-warning is-light">Não foram encontradas publicações</div>';
        }
      ?>
    </div>
    <section>
      <!--Modal de Cadastro-->
      <section>
        <div id="modal-js-cadastro" class="modal">
          <div class="modal-background"></div>
          <div class="modal-content">
            <div class="box">
              <h2 class="form-title">Cadastro de Espécie</h2>
              <form id="register-form" method="post" action="./cad_acervo_global.php" enctype="multipart/form-data">
                <div class="field">
                  <p class="control">
                    <input class="input" type="text" placeholder="Nome da espécie" name="nome_especie" required
                      pattern=".{4,}" title="Por favor, insira pelo menos 4 caracteres" />
                  </p>
                </div>
                <div class="field">
                  <p class="control">
                    <input class="input" type="text" placeholder="Nome científico da espécie" name="nome_cientifico"
                      required pattern=".{4,}" title="Por favor, insira pelo menos 4 caracteres" />
                  </p>
                </div>
                <div class="field">
                  <p class="control">
                    <input class="input" type="text" placeholder="Nível trófico" name="nivel_trofico" required
                      pattern=".{4,}" title="Por favor, insira pelo menos 4 caracteres" />
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
                        echo '<option value="' . $row['id_estado'] . '">' . $row['descricao'] . '</option>';
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
                      Cadastrar
                    </button>
                  </p>
                </div>
              </form>
              <br />
            </div>
          </div>

          <button class="modal-close is-large" aria-label="close"></button>
        </div>
      </section>
    </section>
  </main>
  <script src="./js/index.js"></script>
</body>

</html>