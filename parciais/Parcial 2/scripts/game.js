function iniciarJogo()
{
    var myForm = document.forms["formulario-jogo"];

    var selection = myForm["tabsize"];
    var tabsize = selection[selection.selectedIndex].value;

    var linhas = parseInt(tabsize.split("x")[0]);
    var colunas = parseInt(tabsize.split("x")[1]);

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