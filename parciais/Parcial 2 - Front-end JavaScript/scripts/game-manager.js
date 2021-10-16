/**
 * Gerenciador do game
 */

"use strict";

/**
 * Funcionalidades faltantes:
 * - Sistema de time (Stopwatch & Timer)
 * - Mostrar celulas recursivamente (verificar celula)
 * - Game over
 * - Botão de trapaça
 * - Contagem de pontuação
 */

/* Variáveis do game */
var linhas, colunas, qtdbombs, gamemode;
var forms;
var game;

/** 
 * Função inicializadora:
 * - Estabelece a conexão com o formulário do jogo
 * - Esconde as informações do jogo
 * */
function init()
{
    forms = new GameForm("formulario-jogo");
    updateBombsOptions();
    GameInfo.hideGameInfo();
}

/** 
 * Função para iniciar jogo:
 * - Atualiza as variáveis do game
 * - Cria um novo Campo Minado (classe em game.js)
 * - Configura o Campo Minado
 * */
function initGameButton()
{
    updateGameSettings();

    game = new CampoMinado("tabela", linhas, colunas, qtdbombs, gamemode);
    game.setTableOnClick = onClickCell;
    game.init();

    console.log("linhasXcolunas:");
    console.log(linhas + "X" + colunas);
    console.log("quantidade bombas:");
    console.log(qtdbombs);
    console.log("game mode:");
    console.log(gamemode);

    return false;
}

/** 
 * Função para atualizar as opções de bombas (chamada de name="tabsize")
 * - Atualiza as variáveis do game
 * - Chama o metodo de GameForm para exibir as opções
 * */
function updateBombsOptions()
{
    updateGameSettings();
    GameForm.updateBombsOptions(linhas, colunas);
}

/** 
 * Função para atualizar as variáveis do game pelo Formulário:
 * - Atualiza os dados do formulário dentro de GameForm (formulario-game.js)
 * - Atualiza as variáveis do game
 * */
function updateGameSettings()
{
    forms.updateGameSettings();
    linhas = forms.getTabRows;
    colunas = forms.getTabColumns;
    qtdbombs = forms.getNumBombs;
    gamemode = forms.getGameMode;
}

/** 
 * Função de captar as ações do player no tabuleiro:
 * - Determina a ação da celula do tabuleiro
 * - Determina a linha e a coluna da celula
 * - Verifica a ação a ser determinada no método do game
 * */
function onClickCell(event)
{
    var cell = event.target;
    var linha = cell.parentNode.rowIndex;
    var coluna = cell.cellIndex;
    game.verifyCell(linha, coluna);
}

// Chamar a função inicializadora ao carregar a página
onload = init;