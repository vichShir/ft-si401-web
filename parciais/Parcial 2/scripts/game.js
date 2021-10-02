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
}

function montarTabela(linhas, colunas)
{
    var tabela = document.getElementById("tabela");
    var conteudo_tabela = "";

    for (var linha = 0; linha < linhas; linha++)
    {
        conteudo_tabela += "<tr>";
        for (var coluna = 0; coluna < colunas; coluna++)
        {
            conteudo_tabela += "<td class='blocked'></td>";
        }
        conteudo_tabela += "</tr>";
    }

    tabela.innerHTML = conteudo_tabela;
}