/**
 * Gerenciadores dos tempos
 */

"use strict";

/**
 * Classe responsável por controlar os detalhes do cronômetro:
 * - 
 * */
class StopWatch
{
	static stopwatch = document.getElementById("stopwatch"); // Elemento html
	static timeout; // Objeto setTimeout
	static sec = 0; // Segundos
	static min = 0; // Minutos
	static hour = 0; // Horas

	constructor()
	{
		
	}

	static start()
	{
		console.log("Eu sou um StopWatch!");
	}
}

/**
 * Classe responsável por controlar os detalhes do temporizador:
 * - 
 * */
class Timer
{
	static timer = document.getElementById("timer"); // Elemento html
	static timeout; // Objeto setTimeout
	static totalSeconds; // Tempo total
	static timerOver = false; // Tempo esgotado
	static sec = 0; // Segundos
	static min = 0; // Minutos
	static hour = 0; // Horas

	constructor()
	{
		
	}

	static start(totalSeconds)
	{
		this.totalSeconds = totalSeconds;
		console.log("Eu sou um Timer! Meu tempo é de: " + this.totalSeconds + " segundos");
	}
}