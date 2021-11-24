<?php
    include "resources/php/database.php";
    session_start();

    if(isset($_POST["username"]))
    {
        try
        {
            $cmd = new DBCommands();

            // Insert
            $cpf = $_POST["cpf"]; 
            $nome = $_POST["name"]; 
            $dtnascimento = $_POST["birth"]; 
            $telefone = $_POST["phone"];
            $email = $_POST["email"];
            $username = $_POST["username"];
            $password = $_POST["pwd"];

            $db = new Database();
            $insertCMD = $cmd::INSERT_INTO_USER($cpf, $nome, $dtnascimento, $telefone, $email, $username, $password);
            $db->executeCommand($insertCMD);

            $db = new Database();
            $sql = $cmd::GET_USER_LOGIN($_POST["username"], $_POST["pwd"]);
            $result = $db->getRowFromQuery($sql);

            $_SESSION['codusuario'] = $result["codusuario"];
            $_SESSION['username'] = $result["username"];
            header("Location: game.php");
        }
        catch(DatabaseException $e)
        {
            $error = "Erro ao cadastrar. Tente novamente.";
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
    <title>Campo Minado Online - Cadastro</title>
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

    <!-- Formulário de Cadastro -->
    <section class="sec-panel sec-form">
        <h2>Cadastro</h2>
        <hr>
        <form name="formulario-cadastro" action="cadastro.php" method="POST">
            <p class="form-input">Nome Completo</p>
            <input type="text" name="name" placeholder="Insira seu nome completo" size="40" maxlength="40" required>
            <p class="form-input">Data de nascimento</p>
            <input type="date" name="birth" required>
            <p class="form-input">CPF</p>
            <input type="text" name="cpf" placeholder="Exemplo: 11122233344" pattern="[0-9]{3}[0-9]{3}[0-9]{3}[0-9]{2}" size="11" maxlength="11" required>
            <p class="form-input">Telefone</p>
            <input type="tel" name="phone" placeholder="Exemplo: 00111112222" pattern="[0-9]{2}[0-9]{5}[0-9]{4}" size="11" maxlength="11" required>
            <p class="form-input">Email</p>
            <input type="email" name="email" placeholder="Exemplo: user@email.com" size="40" maxlength="40" required>
            <p class="form-input">Nome de usuário</p>
            <input type="text" name="username" placeholder="Insira seu nome de usuário" size="30" maxlength="30" required>
            <p class="form-input">Senha</p>
            <input type="password" name="pwd" placeholder="Insira sua senha" size="20" maxlength="20" required>

            <!-- atributo onclick é temporário p/ esta Parcial 1 -->
            <p><input id="form-button" type="submit" value="Cadastrar"></p>
        </form>

        <!-- Link para voltar ao login -->
        <p><a href="index.php">Login</a></p>

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

