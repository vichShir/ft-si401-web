
"use strict";

class GameSettings
{
	constructor ()
	{
		this._tabSizeArr = new Array();
		this._numBombs = 0;
		this._gameMode = "classic";
	}

	/* SETTERS */
	set setTabSize(tabSize)
	{
		this._tabSizeArr = tabSize;
	}

	set setNumBombs(numBombs)
	{
		this._numBombs = numBombs;
	}

	set setGameMode(gameMode)
	{
		this._gameMode = gameMode;
	}

	/* GETTERS */
	get getTabSize()
	{
		return this._tabSizeArr;
	}

	get getTabRows()
	{
		return this.getTabSize[0];
	}

	get getTabColumns()
	{
		return this.getTabSize[1];
	}

	get getNumBombs()
	{
		return this._numBombs;
	}

	get getGameMode()
	{
		return this._gameMode;
	}
}

class GameForm extends GameSettings
{
	constructor (formName)
	{
		super();
		this._myForm = document.forms[formName];
		this._selectionTabSize = this._myForm["tabsize"];
		this._selectionNumBombs = this._myForm["qtdbombs"];
		this._selectionGameMode = this._myForm["mode"];
	}

	#getValueFromSelection(selection)
	{
	    return selection[selection.selectedIndex].value;
	}

	#defineTabSize()
	{
	    var tabsize = this.#getValueFromSelection(this._selectionTabSize);

	    // Dividindo em linhas e colunas como valores
	    var linhas = parseInt(tabsize.split("x")[0]);
	    var colunas = parseInt(tabsize.split("x")[1]);

	    // Array com os valores de linhas e colunas a serem retornados
	    this.setTabSize = [linhas, colunas];
	}

	#defineNumBombs()
	{
	    var qtdbombsValue = this.#getValueFromSelection(this._selectionNumBombs);
		this.setNumBombs = parseInt(qtdbombsValue);
	}

	#defineGameMode()
	{
	    var qtdbombsValue = this.#getValueFromSelection(this._selectionGameMode);
		this.setGameMode = qtdbombsValue;
	}

	updateGameSettings()
	{
		this.#defineTabSize();
		this.#defineNumBombs();
		this.#defineGameMode();
	}

	static updateBombsOptions(linhas, colunas)
	{
	    var selectBombs = document.getElementById("select-bombas");
	    var conteudo_select = "";
	    var tamanhoTabuleiro = linhas * colunas; 
	    
	    selectBombs.innerHTML = "";
	    // Definir as opções
	    if (tamanhoTabuleiro <= 30)
	    {
	        conteudo_select = this.#gerarOpcoesBombas([2, 3, 4]);
	    }
	    else if (tamanhoTabuleiro > 30 && tamanhoTabuleiro <= 56)
	    {
	        conteudo_select = this.#gerarOpcoesBombas([5, 6, 7, 8]);
	    }
	    else if (tamanhoTabuleiro > 56 && tamanhoTabuleiro <= 100)
	    {
	        conteudo_select = this.#gerarOpcoesBombas([9, 10, 11]);
	    }
	    else
	    {
	        conteudo_select = this.#gerarOpcoesBombas([12, 13, 14]);
	    }

	    selectBombs.innerHTML = conteudo_select;
	}

	static #gerarOpcoesBombas(listaValores)
	{
	    var htmlOptions = "";

	    for (var i = 0; i < listaValores.length; i++)
	    {
	        htmlOptions += "<option value='" + listaValores[i] + "'>" + listaValores[i] + "</option>";
	    }

	    return htmlOptions;
	}
}