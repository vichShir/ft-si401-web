/**
 * Gerenciador de dados do game
 */

"use strict";

let xhttp;

function enviarDados(tabsize, numBombs, gameMode, playedTime, date, status)
{
    xhttp = new XMLHttpRequest();

    if (!xhttp) 
    {
        alert('Não foi possível criar um objeto XMLHttpRequest.');
        return false;
    }
    xhttp.onreadystatechange = mostraResposta;
    xhttp.open('POST', 'resources/php/salvar_partida.php', true);
    xhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhttp.send('tabsize=' + encodeURIComponent(tabsize) + 
        '&numBombs=' + encodeURIComponent(numBombs) +
        '&gameMode=' + encodeURIComponent(gameMode) +
        '&playedTime=' + encodeURIComponent(playedTime) +
        '&date=' + encodeURIComponent(date) +
        '&status=' + encodeURIComponent(status));
}

function mostraResposta() 
{
    try
    {
        if (xhttp.readyState === XMLHttpRequest.DONE)
        {
            if (xhttp.status === 200)
            {
                let resposta = JSON.parse(xhttp.responseText);
                let conteudo = "<!-- Conteudo Partida -->\
                    <section class='sec-hist'>\
                    <!-- Primeira linha de conteudos(3) -->\
                    <div class='hist-row'>\
                    <!-- Player Name -->\
                    <h4 class='to-left'>" + resposta.username + "</h4>\
                    <!-- Game Status -->\
                    <h4 class='game-status'>" + resposta.status + "</h4>\
                    <!-- Played Date -->\
                    <div class='side-two to-right'>\
                        <img src='images/icons/calendar_byFreepik.png' alt='tamanho-tabuleiro'>\
                        <p>" + resposta.date + "</p>\
                    </div>\
                    </div>\
                    <!-- Segunda linha de conteudos(4) -->\
                    <div class='hist-row hist-row2'>\
                    <!-- TabSize -->\
                    <div class='side-two to-left'>\
                        <img src='images/icons/square-matrix.png' alt='coroa-dourada'>\
                        <p>" + resposta.tabsize + "</p>\
                    </div>\
                    <!-- Quantidade de Bombas -->\
                    <div class='side-two'>\
                        <img src='images/icons/round-bomb_byFreepik.png' alt='numero-bombas'>\
                        <p>" + resposta.numBombs + "</p>\
                        </div>\
                    <!-- Game Mode -->\
                    <div class='side-two'>\
                        <img src='images/icons/rubik_byFreepik.png' alt='modo-jogo'>\
                        <p>" + resposta.gameMode + "</p>\
                        </div>\
                    <!-- Time Played -->\
                    <div class='side-two to-right'>\
                        <img src='images/icons/clock.png' alt='tempo-jogado'>\
                        <p>" + resposta.playedTime + "</p>\
                    </div>\
                    </div>\
                </section>\
                <hr class='hist-line'>";
                
                document.getElementById("hist-partidas").innerHTML += conteudo;
            }
            else
            {
                alert('Um problema ocorreu.');
            }
        }
    } 
    catch (e)
    {
        alert("Ocorreu uma exceção: " + e.description);
    }
}