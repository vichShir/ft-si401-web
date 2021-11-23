<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <title>Campo Minado Online - Game</title>
    <link href="styles/main-style.css" rel="stylesheet" type="text/css"/>
    <link href="styles/game-style.css" rel="stylesheet" type="text/css"/>
    <link href="styles/footer-style.css" rel="stylesheet" type="text/css"/>
    <script src="scripts/formulario-game.js"></script>
    <script src="scripts/time.js"></script>
    <script src="scripts/game.js"></script>
    <script src="scripts/data-manager.js"></script>
    <script src="scripts/game-manager.js"></script>
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
      <?php require("resources/menu.php"); ?>
    </header>

    <!-- Painel do game (Game & Historico) -->
    <section class="sec-panel sec-game">

        <!-- Game -->
        <h2>Campo Minado</h2>
        <hr>

        <!-- Opções do Jogo -->
        <section class="game-settings">
          <h4>Escolha seu jogo:</h4>

          <!-- Formulário para definir Jogo -->
          <form name="formulario-jogo" onsubmit="return initGameButton()">
            <!-- Organizar as opções em linha -->
            <div class="form-options">
              <!-- TabSize -->
              <div>
                <img src="images/icons/square-matrix.png" alt="tamanho-tabuleiro">
                <select name="tabsize" onchange="updateBombsOptions();">
                  <option value="5x5">5x5</option>
                  <option value="5x6">5x6</option>
                  <option value="6x6">6x6</option>
                  <option value="7x7">7x7</option>
                  <option value="8x8">8x8</option>
                  <option value="9x9">9x9</option>
                  <option value="10x10">10x10</option>
                  <option value="15x15">15x15</option>
                </select>
              </div>
              <!-- Quantidade de Bombas -->
              <div>
                <img src="images/icons/round-bomb_byFreepik.png" alt="numero-bombas">
                <select id="select-bombas" name="qtdbombs">
                  <option value='3'>3</option>
                </select>
              </div>
              <!-- Modo Jogo -->
              <div>
                <img src="images/icons/rubik_byFreepik.png" alt="modo-jogo">
                <select name="mode">
                  <option value="classic">Clássico</option>
                  <option value="rivotril">Rivotril</option>
                </select>
              </div>
            </div>

            <!-- Botão para definir Jogo -->
            <input id="form-button" type="submit" value="Iniciar Jogo">
          </form>
        </section>

        <!-- Informações da Partida -->
        <section id="game-info">
          <h4 onclick="getPartida();">Partida:</h4>

          <!-- Tempos -->
          <div class="game-time">
            <!-- Tempo Jogado -->
            <div class="side-two" id="game-div-stopwatch">
              <img src="images/icons/clock.png" alt="tempo-decorrido">
              <p id="stopwatch">--.--.--</p>
            </div>

            <!-- Timer (Se for Modo Rivotril) -->
            <div class="side-two" id="game-div-timer">
              <img src="images/icons/timer_byFreepik.png" alt="timer">
              <p id="timer">--.--.--</p>
            </div>
          </div>

          <!-- Botão de Trapaça -->
          <div class="side-two active-trap" onclick="ativarTrapaca();">
            <img src="images/icons/target_bySmashicons.png" alt="trapaca">
            <p>Ativar Trapaça</p>
          </div>

          <!-- Pontuação do Player -->
          <p id="p-score">Pontuação: xx</p>
          <!-- Número de Células Abertas -->
          <p id="p-opencells">Células abertas: xx</p>
        </section>

        <!-- Implementar Tabuleiro Aqui -->
        <table id="tabela"></table>
        
        <!-- Historico Jogadores -->
        <h2>Histórico</h2>
        <hr>

        <div id="hist-partidas"></div>

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
        