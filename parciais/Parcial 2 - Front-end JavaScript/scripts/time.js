class Time
{
	constructor()
	{
		this._myEngine;
	}

	setEngineToStopWatch()
	{
		this._myEngine = new StopWatch();
	}

	setEngineToTimer()
	{
		this._myEngine = new Timer();
	}

	// Metodo de TESTE
	helloWorld()
	{
		this._myEngine.helloWorld();
	}
}

class StopWatch
{
	constructor()
	{

	}

	// Metodo de TESTE
	helloWorld()
	{
		console.log("Eu sou um StopWatch!");
	}
}

class Timer
{
	constructor()
	{
		
	}

	// Metodo de TESTE
	helloWorld()
	{
		console.log("Eu sou um Timer!");
	}
}