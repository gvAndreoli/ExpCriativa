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
      session_start();
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
      </div>
    </div>
  </header>
  <main>
    <h1 id="menu-title">Acervo Global</h1>
    <br />
    <div class="container" id="acervo-global-container">
      <div class="card" style="width: 18rem">
        <img src="./imgs/chris-ensminger-gWo-hfRotrI-unsplash.jpg" class="card-img-top" alt="..." />
        <div class="card-body">
          <h5 class="card-title">Card title</h5>
          <p class="card-text">
            Some quick example text to build on the card title and make up the
            bulk of the card's content.
          </p>
        </div>
      </div>
    </div>
  </main>
  <script src="./js/index.js"></script>
</body>

</html>