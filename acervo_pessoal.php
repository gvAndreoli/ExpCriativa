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
        <a class="navbar-item is-success" href="./menu.php">Acervo global</a>
      </nav>
      <div>
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
        <br>
        <a class="button is-info">Editar</a>
        <a class="button is-danger">Excluir</a>
      </div>
    </div>
    <section>
      <!--Modal de Cadastro-->
      <section>
        <div id="modal-js-cadastro" class="modal">
          <div class="modal-background"></div>
          <div class="modal-content">
            <div class="box">
              <h2 class="form-title">Cadastro de Espécie</h2>
              <form action="" id="register-form">
                <div class="field">
                  <p class="control">
                    <input class="input" type="text" placeholder="Nome da espécie" name="nome_especie" />
                  </p>
                </div>
                <div class="field">
                  <p class="control">
                    <input class="input" type="text" placeholder="Nome científico da espécie" name="nome_cientifico" />
                  </p>
                </div>
                <div class="field">
                  <p class="control">
                    <input class="input" type="text" placeholder="Nível trófico" name="nivel_trofico" />
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
                    <input class="file-input" type="file" name="especie_img">
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