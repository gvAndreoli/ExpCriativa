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
  <?php
    session_start();
    require('./db/conn.php');
  ?>
  <?php
  if ($_SESSION['tipo_usuario'] == 1) {
    unset($_SESSION['not-authenticated']); 
  } else {
    header('Location: ./index.php');
    $_SESSION['not-authenticated'] = true;
  }
  ?>
  <header>
    <div class="logo-container">
      <a href="#">
        <h1 class="logo">BioRecord</h1>
      </a>
    </div>
    <div id="nav-container" class="navbar is-success">
      <nav>
        <a class="navbar-item is-success" href="./menu.php">Acervo global</a>
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
        <a class="button is-danger">Logout</a>
        <button type="button" class="button is-warning js-modal-trigger" data-target="modal-js-cadastro">
          Cadastrar espécie
        </button>
      </div>
    </div>
  </header>
  <main>
    <h1 id="menu-title">Acervo Pessoal</h1>
    <br />
    <div class="container" id="acervo-pessoal-container">
      <?php
        $user_id = $_SESSION['user_id'];
        $sql = "SELECT * FROM publicacao where id_autor='$user_id'";

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
        <a class="button is-info">Editar</a>
        <a class="button is-danger">Excluir</a>
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
              <form action="" id="register-form" method="post">
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
                  <p class="control">
                    <input class="input" type="text" placeholder="Estado de conservação" name="estado_conservacao" />
                  </p>
                </div>
                <label>Escolha uma imagem: </label><br>
                <div class="file">
                  <label class="file-label">
                    <input class="file-input" type="file" name="especie_img" required
                      title="Por favor, insira uma imagem!">
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