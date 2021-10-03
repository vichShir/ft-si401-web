function mostrarBombas()
{
    var selectBombs = document.getElementById("select-bombas");
    var conteudo_select = "";

    var linhas = getTabelaDim()[0];
    var colunas = getTabelaDim()[1];

    selectBombs.innerHTML = "";
    // Definir as opções
    if (linhas <= 7 && colunas <= 7)
    {
        conteudo_select += "<option value='b3'>3</option>";
        conteudo_select += "<option value='b4'>4</option>";
        conteudo_select += "<option value='b5'>5</option>";
    }
    else
    {
        conteudo_select += "<option value='b10'>10</option>";
        conteudo_select += "<option value='b12'>12</option>";
        conteudo_select += "<option value='b15'>15</option>";
    }

    selectBombs.innerHTML = conteudo_select;
}

function getTabelaDim()
{
    var myForm = document.forms["formulario-jogo"];

    var selection = myForm["tabsize"];
    var tabsize = selection[selection.selectedIndex].value;

    var linhas = parseInt(tabsize.split("x")[0]);
    var colunas = parseInt(tabsize.split("x")[1]);

    var dim = [linhas, colunas];

    return dim;
}

function iniciarJogo()
{
    var linhas = getTabelaDim()[0];
    var colunas = getTabelaDim()[1];

    montarTabela(linhas, colunas);
    teste_recursivo(2, 4);
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

function montarTabela(linhas, colunas)
{
    var bombas = [[1, 3], [1, 4]];

    var tabela = document.getElementById("tabela");
    var conteudo_tabela = "";

    for (var linha = 0; linha < linhas; linha++)
    {
        conteudo_tabela += "<tr>";
        for (var coluna = 0; coluna < colunas; coluna++)
        {
            bombs = bombas[1];
            blinha = bombs[0];
            bcoluna = bombs[1];

            if (linha == blinha && coluna == bcoluna)
            {
                conteudo_tabela += "<td class='blocked'>1</td>";
            }
            else
            {
                conteudo_tabela += "<td class='blocked'></td>";
            }
        }
        conteudo_tabela += "</tr>";
    }

    tabela.innerHTML = conteudo_tabela;
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