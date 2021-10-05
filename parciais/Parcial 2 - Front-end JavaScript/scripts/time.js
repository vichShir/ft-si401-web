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

	helloWorld()
	{
		console.log("Eu sou um Timer!");
	}
}