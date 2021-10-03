
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

	defineGameSettings()
	{
		this.#defineTabSize();
		this.#defineNumBombs();
		this.#defineGameMode();
	}
}