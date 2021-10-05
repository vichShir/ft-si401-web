
"use strict";

class Tabuleiro
{
    constructor(tableName, linhas, colunas)
    {
        this._tabela = document.getElementById(tableName);
        this._matrix;
        this._linhas = linhas;
        this._colunas = colunas;

        this.#assembleTable();
    }

    #assembleTable()
    {
        this.#createMatrix();

        var conteudo_tabela = "";
        for (var linha = 0; linha < this._linhas; linha++)
        {
            conteudo_tabela += "<tr>";
            for (var coluna = 0; coluna < this._colunas; coluna++)
            {
                conteudo_tabela += "<td class='blocked'></td>";
            }
            conteudo_tabela += "</tr>";
        }

        this._tabela.innerHTML = conteudo_tabela;
    }

    #createMatrix()
    {
        this._matrix = new Array(this._linhas);

        for (var i = 0; i < this._matrix.length; i++)
        {
            this._matrix[i] = new Array(this._colunas).fill(0);
        }

        console.log(this._matrix);
    }
}

class CampoMinado extends Tabuleiro
{
    constructor(tableName, linhas, colunas, qtdBombas, gameMode)
    {
        super(tableName, linhas, colunas);
        this._numBombs = qtdBombas;
        this._gameMode = gameMode;
        this._stopwatch; // Cronômetro
        this._timer; // Temporizador
    }

    initializer()
    {
        this.#configureGameMode();
        this.#configureGameTime();
        this.#generateBombs();
    }

    #configureGameMode()
    {
        if(this._gameMode === "rivotril")
        {
            // Rivotril
        }
        else
        {
            // Clássico
        }
    }

    #configureGameTime()
    {
        /**** Game Time Settings ****/

        // Modo Rivotril (Stopwatch & Timer)
        if(this._gameMode === "rivotril")
        {
            // Mostrar Timer em Game Info
            GameInfo.showTimerDiv();

            // Criar stopwatch e timer
            this._stopwatch = new Time();
            this._timer = new Time();

            // Definindo suas engines
            this._stopwatch.setEngineToStopWatch();
            this._timer.setEngineToTimer();

            // Teste de engine
            this._stopwatch.helloWorld();
            this._timer.helloWorld();
        }
        else // Modo Clássico (Stopwatch)
        {
            // Esconder Timer de Game Info
            GameInfo.hideTimerDiv();

            this._stopwatch = new Time();
            this._stopwatch.setEngineToStopWatch();

            // Teste de engine
            this._stopwatch.helloWorld();
        }

        // Mostrar o painel de Game Info
        GameInfo.showGameInfo();
    }

    /*|*******************************|*/
    /*| Configuracao do Campo Minado  |*/
    /*|*******************************|*/
    #generateBombs()
    {
        for (var b = 0; b < this._numBombs;)
        {
            var linha = this.#genRandomRow();
            var coluna = this.#genRandomColumn();
            if (this._matrix[linha][coluna] === 0) 
            {
                console.log(linha + "x" + coluna);
                this._matrix[linha][coluna] = -1;
                b++;

                // TESTE
                this._tabela.rows[linha].cells[coluna].innerHTML = "&#128163";
            }
        }

        console.log(this._matrix);
    }

    #genRandomRow()
    {
        return Math.floor(Math.random() * this._linhas);
    }

    #genRandomColumn()
    {
        return Math.floor(Math.random() * this._colunas);
    }

    // Gerar celulas com numeros de bombas na vizinhanca


    /*|*******************************|*/
    /*| Verificacao da acao do player |*/
    /*|*******************************|*/
    set setTableOnClick(onClickFunc)
    {
        this._tabela.onclick = onClickFunc;
    }

    verifyCell(linha, coluna)
    {
        console.log(linha + "x" + coluna);
    }
}

class GameInfo
{   
    static #SEC_INFO_NAME = "game-info";
    static #DIV_TIMER_NAME = "game-div-timer";

    static hideGameInfo()
    {
        var _gameInfoSection = document.getElementById(this.#SEC_INFO_NAME);
        _gameInfoSection.style.display = "none";
    }

    static showGameInfo()
    {
        var _gameInfoSection = document.getElementById(this.#SEC_INFO_NAME);
        _gameInfoSection.style.display = "block";
    }

    static hideTimerDiv()
    {
        var _timerDiv = document.getElementById(this.#DIV_TIMER_NAME);
        _timerDiv.style.display = "none";
    }

    static showTimerDiv()
    {
        var _timerDiv = document.getElementById(this.#DIV_TIMER_NAME);
        _timerDiv.style.display = "flex";
    }
}


/*


var linhas, colunas, bombas, matriz, tabela;
function gerarMatriz(l, c) {
    matriz = [];
    for (var i = 0; i < l; i++) {
        matriz[i] = new Array(c).fill(0);
    }
    console.log(matriz);
}
function gerarTabela(l, c) {
    gerarMatriz(l, c);
    var str = "";
    for (var i = 0; i < l; i++) {
        str += "<tr>";
        for (var j = 0; j < c; j++) {
            str += "<td class='blocked'></td>";
        }
        str += "</tr>";
    }
    tabela.innerHTML = str;
}
function mostrarMatriz() {
    for (var i = 0; i < linhas; i++) {
        for (var j = 0; j < colunas; j++) {
            if (matriz[i][j] === -1) {
                tabela.rows[i].cells[j].innerHTML = "&#128163;";
            } else {
                tabela.rows[i].cells[j].innerHTML = matriz[i][j];
            }
        }
    }
}
function gerarBombas() {
    for (var i = 0; i < bombas;) {
        var linha = Math.floor((Math.random() * linhas));
        var coluna = Math.floor((Math.random() * colunas));
        if (matriz[linha][coluna] === 0) {
            matriz[linha][coluna] = -1;
            i++;
        }
    }
}
function gerarNumero(l, c) {
    var count = 0;
    for (var i = l - 1; i <= l + 1; i++) {
        for (var j = c - 1; j <= c + 1; j++) {
            if (i >= 0 && i < linhas && j >= 0 && j < colunas) {
                if (matriz[i][j] === -1) {
                    count++;
                }
            }
        }
    }
    matriz[l][c] = count;
}
function gerarNumeros() {
    for (var i = 0; i < linhas; i++) {
        for (var j = 0; j < colunas; j++) {
            if (matriz[i][j] !== -1) {
                gerarNumero(i, j);
            }
        }
    }
}
function bandeira(event) {
    var cell = event.target;
    var linha = cell.parentNode.rowIndex;
    var coluna = cell.cellIndex;
    if (cell.className === "blocked") {
        cell.className = "flag";
        cell.innerHTML = "&#128681;";//&#9873;
    } else if (cell.className === "flag") {
        cell.className = "blocked";
        cell.innerHTML = "";
    }
    return false;
}
function init() {
    tabela = document.getElementById("tabela");
    tabela.onclick = verificar;
    tabela.oncontextmenu = bandeira;
    var diff = document.getElementById("dificuldade");
    switch (parseInt(diff.value)) {
        case 0:
            linhas = 9;
            colunas = 9;
            bombas = 10;
            break;
        case 1:
            linhas = 16;
            colunas = 16;
            bombas = 40;
            break;
        default:
            linhas = 16;
            colunas = 30;
            bombas = 99;
            break;
    }
    gerarTabela(linhas, colunas);
    gerarBombas();
    gerarNumeros();
    //    mostrarMatriz();
}
function limparCelulas(l, c) {
    for (var i = l - 1; i <= l + 1; i++) {
        for (var j = c - 1; j <= c + 1; j++) {
            if (i >= 0 && i < linhas && j >= 0 && j < colunas) {
                var cell = tabela.rows[i].cells[j];
                if (cell.className !== "blank") {
                    switch (matriz[i][j]) {
                        case -1:
                            break;
                        case 0:
                            cell.innerHTML = "";
                            cell.className = "blank";
                            limparCelulas(i, j);
                            break;
                        default:
                            cell.innerHTML = matriz[i][j];
                            cell.className = "n" + matriz[i][j];
                    }
                }
            }
        }
    }
}
function mostrarBombas() {
    for (var i = 0; i < linhas; i++) {
        for (var j = 0; j < colunas; j++) {
            if (matriz[i][j] === -1) {
                var cell = tabela.rows[i].cells[j];
                cell.innerHTML = "&#128163;";
                cell.className = "blank";
            }
        }
    }
}
function verificar(event) {
    var cell = event.target;
    if (cell.className !== "flag") {
        var linha = cell.parentNode.rowIndex;
        var coluna = cell.cellIndex;
        switch (matriz[linha][coluna]) {
            case -1:
                mostrarBombas();
                cell.style.backgroundColor = "red";
                tabela.onclick = undefined;
                tabela.oncontextmenu = undefined;
                alert("Você perdeu!");
                break;
            case 0:
                limparCelulas(linha, coluna);
                break;
            default:
                cell.innerHTML = matriz[linha][coluna];
                cell.className = "n" + matriz[linha][coluna];
        }
        fimDeJogo();
    }
}
function fimDeJogo() {
    var cells = document.querySelectorAll(".blocked, .flag");
    if (cells.length === bombas) {
        mostrarBombas();
        tabela.onclick = undefined;
        tabela.oncontextmenu = undefined;
        alert("Você venceu!");
    }
}
function registerEvents() {
    init();
    var diff = document.getElementById("dificuldade");
    diff.onchange = init;
}
onload = registerEvents;


*/