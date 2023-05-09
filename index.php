<!DOCTYPE html>
<html>
<?php
  session_start();
  if(isset($_SESSION['not-authenticated'])){
    echo "<script>alert('Acesso negado!')</script>";
    unset($_SESSION['not-authenticated']);
  }
?>

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>BIORECORD</title>
  <!--FAVICON-->
  <link rel="shortcut icon" href="./imgs/plant_nature_leaves_leaf_dirt_earth_icon_141982.svg" type="image/x-icon" />
  <!--BULMA-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css" />
  <!--W3 CSS PARA ICONS-->
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <link rel="stylesheet" href="./styles/index.css" />
</head>

<body>
  <header>
    <div class="logo-container">
      <h1 class="logo">BioRecord</h1>
    </div>
    <div id="nav-container" class="navbar is-success">
      <nav>
        <a class="navbar-item is-success js-modal-trigger" data-target="modal-js-login">Login</a>
        <a class="navbar-item is-success js-modal-trigger" data-target="modal-js-cadastro">Cadastro</a>
      </nav>
    </div>
  </header>
  <main>

    <div class="container">
      <!--Modal de login-->
      <section>
        <div id="modal-js-login" class="modal">
          <div class="modal-background"></div>
          <div class="modal-content">
            <div class="box">
              <h2 class="form-title">Login</h2>
              <form action="./login.php" method="post" class="box form">
                <div class="field">
                  <p class="control has-icons-left has-icons-right">
                    <input class="input" type="email" placeholder="Email" name="login-form-email" name="emailC"
                      pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}" required
                      title="Por favor, insira um e-mail válido!" />
                    <span class="icon is-small is-left">
                      <i class="fa fa-envelope-o"></i>
                    </span>
                  </p>
                </div>
                <div class="field">
                  <p class="control has-icons-left">
                    <input class="input" type="password" placeholder="Senha" name="login-form-password" />
                    <span class="icon is-small is-left">
                      <i class="fa fa-lock"></i>
                    </span>
                  </p>
                </div>
                <div class="field">
                  <p class="control" id="btn-login-container">
                    <button class="button is-info" id="btn-entrar">
                      Entrar
                    </button>
                  </p>
                </div>
              </form>
              <br />
              <a href="" id="forgotten-pass-link">Esqueci minha senha</a>
            </div>
          </div>

          <button class="modal-close is-large" aria-label="close"></button>
        </div>
      </section>
      <!--Modal de Cadastro-->
      <section>
        <div id="modal-js-cadastro" class="modal">
          <div class="modal-background"></div>
          <div class="modal-content">
            <div class="box">
              <h2 class="form-title">Cadastro</h2>
              <form action="./cadastro.php" class="form box" method="post">
                <div class="field">
                  <p class="control has-icons-left has-icons-right">
                    <input class="input" type="text" placeholder="Nome" name="nomeC" pattern=".{4,}"
                      title="Por favor, insira pelo menos 4 caracteres" required />
                    <span class="icon is-small is-left">
                      <i class="fa fa-user"></i>
                    </span>
                  </p>
                </div>
                <div class="field">
                  <p class="control has-icons-left has-icons-right">
                    <input class="input" type="email" placeholder="Email" name="emailC"
                      pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}" required
                      title="Por favor, insira um e-mail válido!" />
                    <span class="icon is-small is-left">
                      <i class="fa fa-envelope-o"></i>
                    </span>
                  </p>
                </div>
                <div class="field">
                  <p class="control has-icons-left">
                    <input class="input" type="password" placeholder="Senha" name="senhaC" pattern=".{4,}"
                      title="Por favor, insira pelo menos 4 caracteres" required />
                    <span class="icon is-small is-left">
                      <i class="fa fa-lock"></i>
                    </span>
                  </p>
                </div>
                <div class="field">
                  <p class="control has-icons-left">
                    <input class="input" type="password" placeholder="Confirme a senha" name="senha_confC"
                      pattern=".{4,}" title="Por favor, insira pelo menos 4 caracteres" required />
                    <span class="icon is-small is-left">
                      <i class="fa fa-check"></i>
                    </span>
                  </p>
                </div>
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
    </div>


    <!--MODAL DE FALHA DE LOGIN OU CADASTRO-->
    <?php 
      if (isset($_SESSION['nao-autenticado']) && $_SESSION['nao-autenticado'] == true){
        echo '<div class="modal" id="notification-modal">
                <div class="modal-background"></div>
                <div class="modal-content">
                  <div class="notification">'.
                  '<h4 class="title is-4">'. $_SESSION['msg-title'].'</h4>' . 
                    $_SESSION['mensagem'] .
                  '</div>
                </div>
                <button class="modal-close is-large" aria-label="close"></button>
              </div>';
    ?>
    <script>
    const notification_modal = document.getElementById('notification-modal').classList.add('is-active')
    </script>
    <?php
      unset($_SESSION['nao-autenticado']);
      }
    ?>

    <!--MODAL DE SUCESSO-->
    <?php 
      if (isset($_SESSION['sucesso_cadastro']) && $_SESSION['sucesso_cadastro'] == true){
        echo '<div class="modal" id="success-modal">
                <div class="modal-background"></div>
                <div class="modal-content">
                  <div class="notification is-success">'.
                  '<h4 class="title is-4">Usuário cadastrado com sucesso!</h4> 
                    Você já pode fazer login
                  </div>
                </div>
                <button class="modal-close is-large" aria-label="close"></button>
              </div>';
    ?>
    <script>
    const success_notification_modal = document.getElementById('success-modal').classList.add('is-active')
    </script>
    <?php
      unset($_SESSION['sucesso_cadastro']);
      }
    ?>

    <!--Seção da imagem da página index-->
    <section id="section-animal" class="section is-large">
      <h2>BioRecord</h2>
      <br />
      <h4>
        Onde você pode encontrar de tudo sobre espécies da fauna e flora
      </h4>
    </section>
  </main>
  <script src="./js/index.js">
  </script>
</body>

</html>