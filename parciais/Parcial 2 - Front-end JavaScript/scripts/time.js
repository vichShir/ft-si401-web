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
	static #cron; // Objeto setInterval
  static hour = 0;
  static minute = 0;
  static second = 0;
  
	static start()
	{
    this.#reset();
    this.#cron = setInterval(() => { this.#timer(); }, 1000);
	}

  static #reset()
  {
    this.hour = 0;
    this.minute = 0;
    this.second = 0;
    this.#print();
    clearTimeout(this.#cron);
  }

  static #timer()
  {
    if ((this.second += 1) == 60) 
    {
      this.second = 0;
      this.minute++;
    }

    if (this.minute == 60) 
    {
      this.minute = 0;
      this.hour++;
    }

    this.#print();
  }

  static #print()
  {
    var second_text = this.second.toLocaleString('en-US', {
      minimumIntegerDigits: 2,
      useGrouping: false
    })
    var minute_text = this.minute.toLocaleString('en-US', {
      minimumIntegerDigits: 2,
      useGrouping: false
    })
    var hour_text = this.hour.toLocaleString('en-US', {
      minimumIntegerDigits: 2,
      useGrouping: false
    })
		stopwatch.innerHTML = hour_text + ":" + minute_text + ":" + second_text;
  }
}

/**
 * Classe responsável por controlar os detalhes do temporizador:
 * - 
 * */
class Timer
{
	static #timerHTML; // Elemento html
	static #timer; // Objeto setTimeout
	static #totalSeconds; // Tempo total
	static #second = 0; // Segundos
	static #minute = 0; // Minutos
	static #hour = 0; // Horas

	static start(totalSeconds)
  {
    this.#timerHTML = document.getElementById("timer");
    this.#totalSeconds = totalSeconds;
    this.reset();
    this.#print();
    this.#convertToTime();
    this.#timer = setInterval(() => { this.#timeCycle(); }, 1000);
  }

  static stop()
  {
    clearTimeout(this.#timer);
  }

  static reset()
  {
    this.#minute = 0;
    this.#second = 0;
    this.#hour = 0;
    clearTimeout(this.#timer);
  }

  static #convertToTime()
  {
    this.#hour = Math.floor(this.#totalSeconds / 3600);
    this.#totalSeconds %= 3600;
    this.#minute = Math.floor(this.#totalSeconds / 60);
    this.#second = this.#totalSeconds % 60;
  }

  static #timeCycle()
  {
    if(this.#second > 0)
    {
      this.#second -= 1;
    }
    else
    {
      if(this.#minute > 0)
      {
        this.#second = 59;
        this.#minute -= 1;
      }
      else
      {
        if(this.#hour > 0)
        {
          this.#second = 59;
          this.#minute = 59;
          this.#hour -= 1;
        }
        else
        {
          this.stop();
          console.log("acabou!")
        }
      }
    }
    this.#print();
  }

  static #print()
  {
    var second_text = this.#second.toLocaleString('en-US', {
      minimumIntegerDigits: 2,
      useGrouping: false
    })
    var minute_text = this.#minute.toLocaleString('en-US', {
      minimumIntegerDigits: 2,
      useGrouping: false
    })
    var hour_text = this.#hour.toLocaleString('en-US', {
      minimumIntegerDigits: 2,
      useGrouping: false
    })

    this.#timerHTML.innerHTML = hour_text + ":" + minute_text + ":" + second_text;
  }
}