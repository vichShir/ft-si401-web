<?php
    include "resources/php/database.php";
    session_start();

    if(isset($_POST["username"]))
    {
      try
      {
        $db = new Database();
        $cmd = new DBCommands();
        $sql = $cmd::GET_USER_LOGIN($_POST["username"], $_POST["pwd"]);
        $result = $db->getRowFromQuery($sql);

        $_SESSION['codusuario'] = $result["codusuario"];
        $_SESSION['username'] = $result["username"];
        header("location: game.php");
      }
      catch(DatabaseException $e)
      {
        $error = "Usuário ou senha incorretos. Faça seu cadastro ou tente novamente.";
      }
    }

    if(isset($_SESSION['username']))
    {
        header("Location: game.php");
        die();
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <title>Campo Minado Online - Login</title>
    <link href="resources/css/main-style.css" rel="stylesheet" type="text/css"/>
    <link href="resources/css/form-style.css" rel="stylesheet" type="text/css"/>
    <link href="resources/css/footer-style.css" rel="stylesheet" type="text/css"/>
    <!-- Importando fontes Google -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="images/icons/iconweb-bomb.ico"/>
  </head>

  <body>

    <!-- Cabeçalho -->
    <header style="height: 90px"><h1>Campo Minado Online</h1></header>

    <!-- Formulário de Login -->
    <section class="sec-panel sec-form">
        <h2>Login</h2>
        <hr>
        <form name="formulario-login" action="index.php" method="POST">
            <p class="form-input"><input type="text" name="username" placeholder="Usuário" size="30" maxlength="30" required></p>
            <p class="form-input"><input type="password" name="pwd" placeholder="Senha" size="20" maxlength="20" required></p>

            <!-- atributo onclick é temporário p/ esta Parcial 1 -->
            <p><input id="form-button" type="submit" value="Entrar"></p>
        </form>

        <!-- Link para cadastro -->
        <p><a href="cadastro.php">Cadastrar</a></p>

        <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo isset($error) ? $error : ""; ?></div>

    </section>

    <!-- Rodapé -->
    <footer>
        <!-- Rodapé principal -->
        <div class="ft-topics">
            <!-- About -->
            <section class="ft-about">
                <h3>SOBRE</h3>
                <p>Website do jogo Campo Minado desenvolvido na disciplina de Programação para a Web na FT - Unicamp.</p>
            </section>
            <!-- Devs -->
            <section class="ft-devs">
                <h3>DESENVOLVEDORES</h3>
                <ul>
                    <li>Caio Masseu</li>
                    <li>Jonatas Goes</li>
                    <li>Matheus Silva</li>
                    <li>Victor Shirasuna</li>
                </ul>
            </section>
        </div>
      
        <!-- Rodapé inferior -->
        <div class="ft-info">
            <p>SI401 - Programação Web 2021 - Grupo 8</p>
        </div>
    </footer>

  </body>
</html>