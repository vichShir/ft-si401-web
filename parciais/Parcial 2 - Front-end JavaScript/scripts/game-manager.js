
"use strict";

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
    updateSettings();

    game = new CampoMinado("tabela", linhas, colunas, qtdbombs, gamemode);
    game.setTableOnClick = onClickCell;
    game.initializer();

    console.log(linhas + "/" + colunas);
    console.log(qtdbombs);
    console.log(gamemode);
}

/** 
 * Função para atualizar as variáveis do game pelo Formulário:
 * - Atualiza os dados do formulário dentro de GameForm (formulario-game.js)
 * - Atualiza as variáveis do game
 * */
function updateSettings()
{
    forms.updateGameSettings();
    linhas = forms.getTabRows;
    colunas = forms.getTabColumns;
    qtdbombs = forms.getNumBombs;
    gamemode = forms.getGameMode;
}

/** 
 * Função para atualizar as opções de bombas (chamada de name="tabsize")
 * - Atualiza as variáveis do game
 * - Chama o metodo de GameForm para exibir as opções
 * */
function updateBombsOptions()
{
    updateSettings();
    GameForm.updateBombsOptions(linhas, colunas);
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