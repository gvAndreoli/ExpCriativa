<!DOCTYPE html>
<html lang="en">
<?php
  session_start();
  require('./db/conn.php');
  if ((!isset($_SESSION['login']))) {
    header('Location: ./index.php');
    $_SESSION['not-authenticated'] = true; 
  }
  if ($_SESSION['tipo_usuario'] != 1) {
    header('Location: ./menu.php');
  }
  ?>

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>BioRecord - Administrador</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css" />
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <link rel="stylesheet" href="./styles/index.css" />
</head>

<body>
  <header>
    <div class="logo-container">
      <a href="./index.php">
        <h1 class="logo">BioRecord</h1>
      </a>
    </div>
    <div id="nav-container-admin" class="navbar is-success">
      <p>Administrador(a):<?php echo $_SESSION['nomeUsuario']?></p>
      <div>
        <a class="button is-info" href="./menu.php" id="menu-link">Acervo Global</a>
        <a class="button is-danger" href="./logout.php">Logout</a>
      </div>
    </div>
  </header>
  <main>
    <section>
      <div class="d-flex align-items-start">
        <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
          <button class="button is-warning active" id="v-pills-home-tab" data-bs-toggle="pill"
            data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="false">
            Especialistas
          </button>
          <button class="button is-warning" id="v-pills-profile-tab" data-bs-toggle="pill"
            data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile"
            aria-selected="false">
            Usuários comuns
          </button>
        </div>
        <!--CONTEUDO DAS TABS-->
        <div class="tab-content" id="v-pills-tabContent">
          <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab"
            tabindex="0">
            <div id="tab-especialista-content">
              <table class="table">
                <thead>
                  <th>id</th>
                  <th>nome</th>
                  <th>e-mail</th>
                  <th>lattes</th>
                  <th>Ações</th>
                </thead>
                <tbody>
                  <?php
                    // Selecionando a tabela que deseja ler os dados
                    $sql = "SELECT * FROM usuario where tipo_usuario = 2";

                    // Executando a consulta SQL
                    $resultado = $conn->query($sql);

                    // Verificando se a consulta retornou algum resultado
                      if ($resultado->num_rows > 0) {
                        while ($row = $resultado->fetch_assoc()) {
                          echo "<tr>";
                          echo "<td>" . $row['id_usuario'] . "</td>";
                          echo "<td>" . $row['nome'] . "</td>";
                          echo "<td>" . $row['email'] . "</td>";
                          echo "<td><a class='button is-link is-light' target='blank' href='" . $row['lattes'] . "'</a>". $row['lattes'] ."</td>";
                          echo '<td><a class="button is-info" href="especialistaAtualizar.php?id='. $row['id_usuario'].'">Editar</a> <a class="button is-danger" href="especialistaExcluir.php?id='. $row['id_usuario'].'">Excluir</a></td>';
                          echo '</tr>';
                        }
                      }
                      else {
                        echo "<tr>";
                        echo "<td>" . "Sem Resultados" . "</td>";
                        echo "<td>" . "Sem Resultados" . "</td>";
                        echo "<td>" . "Sem Resultados" . "</td>";
                        echo "<td>" . "Sem Resultados" . "</td>";
                        echo "<td>" . "--------------" . "</td>";
                        echo "</tr>";
                    }
                  ?>
                </tbody>
              </table>
              <div>
                <button type="button" class="button is-primary js-modal-trigger" data-target="modal-js-cadastro">
                  Cadastrar especialista
                </button>
                <!--Modal de Cadastro-->
                <section>
                  <div id="modal-js-cadastro" class="modal">
                    <div class="modal-background"></div>
                    <div class="modal-content">
                      <div class="box">
                        <h2 class="form-title">Cadastro de Especialista</h2>
                        <form action="./cad_especialista.php" id="register-form" method="post">
                          <div class="field">
                            <p class="control has-icons-left has-icons-right">
                              <input class="input" type="text" placeholder="Nome" name="nome" required pattern=".{4,}"
                                title="Por favor, insira pelo menos 4 caracteres" />
                              <span class="icon is-small is-left">
                                <i class="fa fa-user"></i>
                              </span>
                            </p>
                          </div>
                          <div class="field">
                            <p class="control has-icons-left has-icons-right">
                              <input class="input" type="email" placeholder="Email" name="email"
                                pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}" required
                                title="Por favor, insira um e-mail válido!" />
                              <span class="icon is-small is-left">
                                <i class="fa fa-envelope-o"></i>
                              </span>
                            </p>
                          </div>
                          <div class="field">
                            <p class="control has-icons-left">
                              <input class="input" type="text" placeholder="Lattes" name="lattes" pattern="https?://.+"
                                title="Por favor, insira um link válido!" required />
                              <span class="icon is-small is-left">
                                <i class="fa fa-link"></i>
                              </span>
                            </p>
                          </div>
                          <div class="field">
                            <p class="control has-icons-left">
                              <input class="input" type="password" placeholder="Senha" name="senha" required
                                pattern=".{4,}" title="Por favor, insira pelo menos 4 caracteres" />
                              <span class="icon is-small is-left">
                                <i class="fa fa-lock"></i>
                              </span>
                            </p>
                          </div>
                          <div class="field">
                            <p class="control has-icons-left">
                              <input class="input" type="password" placeholder="Confirme a senha" name="senhaC" required
                                pattern=".{4,}" title="Por favor, insira pelo menos 4 caracteres" />
                              <span class="icon is-small is-left">
                                <i class="fa fa-lock"></i>
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
            </div>
          </div>
          <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab"
            tabindex="0">
            <table class="table">
              <thead>
                <th>id</th>
                <th>nome</th>
                <th>e-mail</th>
                <th>Ações</th>
              </thead>
              <tbody>
                <?php
                    // Selecionando a tabela que deseja ler os dados
                    $sql = "SELECT * FROM usuario where tipo_usuario = 3";

                    // Executando a consulta SQL
                    $resultado = $conn->query($sql);

                    // Verificando se a consulta retornou algum resultado
                      if ($resultado->num_rows > 0) {
                        while ($row = $resultado->fetch_assoc()) {
                          echo "<tr>";
                          echo "<td>" . $row['id_usuario'] . "</td>";
                          echo "<td>" . $row['nome'] . "</td>";
                          echo "<td>" . $row['email'] . "</td>";
                          echo '<td><a class="button is-info" href="usuariocomumAtualizar.php?id='. $row['id_usuario'].'">Editar</a> <a class="button is-danger" href="usuariocomumExcluir.php?id='. $row['id_usuario'].'">Excluir</a></td>';
                          echo '</tr>';
                        }
                      }
                      else {
                        echo "<tr>";
                        echo "<td>" . "Sem Resultados" . "</td>";
                        echo "<td>" . "Sem Resultados" . "</td>";
                        echo "<td>" . "Sem Resultados" . "</td>";
                        echo "<td>" . "--------------" . "</td>";
                        echo "</tr>";
                    }
                  ?>
              </tbody>
            </table>
          </div>
        </div>
    </section>
    <!--MODAL DE FALHA DE CADASTRO-->
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
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
  </script>
  <script src="./js/index.js"></script>
</body>

</html>