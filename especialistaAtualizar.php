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
        <a class="navbar-item is-success" href="./admin.php">Administrativo</a>
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
        $sql = "SELECT * FROM usuario where id_usuario = $id";
        // Executando a consulta SQL
        $resultado = $conn->query($sql);
        if ($resultado->num_rows > 0) {
          while ($row = $resultado->fetch_assoc()) {
            $nome = $row['nome'];
            $email = $row['email'];
            $senha = $row['senha'];
            $lattes = $row['lattes'];
          }
        }
      ?>
      <div class="container">
        <form action="./especialistaAtualizar_exe.php" id="register-form" method="post">
          <div class="field">
            <input type="hidden" value="<?php echo $id?>" name="id"></input>
            <p class="control has-icons-left has-icons-right">
              <input class="input" type="text" placeholder="Nome" value="<?php echo $nome ?>" name="nome" required
                pattern=".{4,}" title="Por favor, insira pelo menos 4 caracteres" />
              <span class="icon is-small is-left">
                <i class="fa fa-user"></i>
              </span>
            </p>
          </div>
          <div class="field">
            <p class="control has-icons-left has-icons-right">
              <input class="input" type="email" placeholder="Email" value="<?php echo $email?>" name="email"
                pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}" required
                title="Por favor, insira um e-mail válido!">
              <span class=" icon is-small is-left">
                <i class="fa fa-envelope-o"></i>
              </span>
            </p>
          </div>
          <div class="field">
            <p class="control has-icons-left">
              <input class="input" type="password" placeholder="Senha" value="<?php echo $senha?>" name="senha" required
                pattern=".{4,}" title="Por favor, insira pelo menos 4 caracteres" />
              <span class=" icon is-small is-left">
                <i class="fa fa-lock"></i>
              </span>
            </p>
          </div>
          <div class="field">
            <p class="control has-icons-left">
              <input class="input" type="password" placeholder="Confirme a senha" value="<?php echo $senha?>"
                name="senhaC" required pattern=".{4,}" title="Por favor, insira pelo menos 4 caracteres" />
              <span class=" icon is-small is-left">
                <i class="fa fa-lock"></i>
              </span>
            </p>
          </div>
          <div class="field">
            <p class="control has-icons-left">
              <input class="input" type="text" placeholder="Lattes" value="<?php echo $lattes?>" name="lattes"
                pattern="https?://.+" title="Por favor, insira um link válido!" required>
              <span class=" icon is-small is-left">
                <i class="fa fa-link"></i>
              </span>
            </p>
          </div>
          <div class="field">
            <p class="control" id="btn-login-container">
              <button class="button is-info" id="btn-register">
                Atualizar
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