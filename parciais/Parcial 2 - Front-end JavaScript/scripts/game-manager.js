
"use strict";

var linhas, colunas, qtdbombs, gamemode;
var forms;

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

    var game = new CampoMinado("tabela", linhas, colunas, qtdbombs, gamemode);
    //game.assembleTable();

    //montarTabela(linhas, colunas);
    //teste_recursivo(2, 4);

    //game._tabela.onclick = verifyCell;
}

function teste_recursivo(l, c)
{
    var linhas = getTabelaDim()[0];
    var colunas = getTabelaDim()[1];

    for (var i = l - 1; i <= l + 1; i++) 
    {
        for (var j = c - 1; j <= c + 1; j++) 
        {
            if (i >= 0 && i < linhas && j >= 0 && j < colunas)
            {
                console.log(i, j);
                //console.log(tabela.rows[i].cells[j].className = "A");
                console.log(tabela.rows[i].cells[j].innerHTML = "x");

                if (tabela.rows[i].cells[j].innerHTML === "")
                {
                    teste_recursivo(i, j);
                }
                else
                {
                    console.log("PARADA");
                }
            }
        }
    }
}

onload = init;