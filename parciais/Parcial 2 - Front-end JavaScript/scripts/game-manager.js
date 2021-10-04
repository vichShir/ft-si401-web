
"use strict";

var linhas, colunas, qtdbombs, gamemode;
var forms;
var game;

function init()
{
    forms = new GameForm("formulario-jogo");
}

function updateSettings()
{
    forms.updateGameSettings();
    linhas = forms.getTabRows;
    colunas = forms.getTabColumns;
    qtdbombs = forms.getNumBombs;
    gamemode = forms.getGameMode;
}

function updateBombsOptions()
{
    updateSettings();
    GameForm.updateBombsOptions(linhas, colunas);
}

function initGameButton()
{
    updateSettings();

    console.log(linhas + "/" + colunas);
    console.log(qtdbombs);
    console.log(gamemode);

    game = new CampoMinado("tabela", linhas, colunas, qtdbombs, gamemode);
}

onload = init;