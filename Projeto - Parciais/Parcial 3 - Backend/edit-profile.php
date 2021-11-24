<?php
  include('resources/php/session.php');
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <title>Campo Minado Online - Editar Perfil</title>
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
    <header>
      <h1>Campo Minado Online</h1>
      <!-- Menu -->
      <?php require("resources/php/menu.php"); ?>
    </header>

    <!-- Formulário de Editar Cadastro -->
    <section class="sec-panel sec-form">
        <h2>Editar Cadastro</h2>
        <hr>
        <form name="formulario-edit">
            <p class="form-input">Nome Completo</p>
            <input type="text" name="name" placeholder="Insira seu nome completo" size="40" maxlength="40" required>
            <p class="form-input">Telefone</p>
            <input type="tel" name="phone" placeholder="Exemplo: 00111112222" pattern="[0-9]{2}[0-9]{5}[0-9]{4}" size="11" maxlength="11" required>
            <p class="form-input">Email</p>
            <input type="email" name="email" placeholder="Exemplo: user@email.com" size="40" maxlength="40" required>
            <p class="form-input">Nova senha</p>
            <input type="password" name="pwd" placeholder="Insira sua nova senha" size="20" maxlength="20" required>
            <p class="form-input">Confirme sua nova senha</p>
            <input type="password" name="pwd" placeholder="Digite novamente sua nova senha" size="20" maxlength="20" required>

            <!-- atributo onclick é temporário p/ esta Parcial 1 -->
            <p><input id="form-button" type="submit" value="Editar" onclick="window.location.href = 'game.php'"></p>
        </form>

        <!-- Link para voltar ao game -->
        <p><a href="game.php">Voltar</a></p>
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

