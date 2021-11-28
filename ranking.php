<?php
    require('resources/php/session.php');
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <title>Campo Minado Online - Ranking Global</title>
    <link href="resources/css/main-style.css" rel="stylesheet" type="text/css" />
    <link href="resources/css/footer-style.css" rel="stylesheet" type="text/css" />
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

    <!-- Painel com os rankings -->
    <section class="sec-panel">
        <h2>Ranking Global</h2>
        <hr>

        <?php
            require "resources/php/database.php";
            try
            {
                $db = new Database();
                $result = $db->getAllRowsFromQuery(DBCommands::GET_TOP_GAMEMATCHS());
                $db->close();
                
                $rank_pos = 0;
                $coroa = "";
                foreach($result as $partida)
                {
                    $rank_pos++;
                    if($rank_pos === 1) $coroa = "<img src='images/icons/crown_1_byFreepik.png' alt='coroa-dourada'>";
                    else if($rank_pos === 2) $coroa = "<img src='images/icons/crown_2_byFreepik.png' alt='coroa-prata'>";
                    else if($rank_pos === 3) $coroa = "<img src='images/icons/crown_3_byFreepik.png' alt='coroa-bronze'>";
                    else $coroa = "";

                    echo "<!-- Conteudo Ranking -->
                        <section class='sec-rk'>
                            <!-- Player Name -->
                            <h4 class='to-left'>" . $partida["username"] . "</h4>
                            <!-- Player Rank -->
                            <div class='side-two to-right'>"
                               . $coroa . "<p>Rank " . $rank_pos . "</p>
                            </div>
                            <!-- TabSize -->
                            <div class='side-two to-left'>
                                <img src='images/icons/square-matrix.png' alt='tamanho-tabuleiro'>
                                <p>" . $partida["tablinhas"] . "x" . $partida["tabcolunas"] . "</p>
                            </div>
                            <!-- Time-Played -->
                            <div class='side-two to-right'>
                                <img src='images/icons/clock.png' alt='tempo-jogado'>
                                <p>" . $partida["tempojogado"] . "</p>
                            </div>
                        </section>
                        <hr class='rk-line'>";
                }
            }
            catch(DatabaseConnectionException $e)
            {
                echo $e->errorMessage();
            }
            catch(DatabaseQueryException $e)
            {
                echo $e->errorMessage();
            }
            catch(PDOException $e)
            {
                echo $e->getMessage();
            }
        ?>

        <a class="button" href="game.php">Voltar</a>
        
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