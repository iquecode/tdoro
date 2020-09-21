
let m = 25;  //- pomodoro 
let s = 0;   //-
let m1 = 5;  //-- pausa curta 
let s1 = 0;  //-- 
let m2 = 15; //--- pausa longa
let s2 = 0;  //---
// false-Cronometro parado  true-Cronometro Funcionando
let TypeTimer = 0; // 0-Pomodoro  1-Pausa Curta   2-Pausa Longa

class Timer{

        constructor(m, s) {
            this.m = m;
            this.s = s;  
        }

        working = false;
        timerInterval;

        show() {
            let sText = s.toString();
            let mText = m.toString();
            if (sText.length < 2) sText = "0" + sText;
            if (mText.length < 2) mText = "0" + mText;
            document.getElementById('ss').innerHTML = sText;
            document.getElementById('mm').innerHTML = mText;
        }

        calculate() {
            console.log("chegou no calculate");
            if (s > 0) {
                s--;
            } else {
                if (m > 0) {
                    s = 59;
                    m = m - 1;
                } else {
                    console.log('acabou');
                }
            }
        }


        teste() {
            console.log("teste");
        }

        work() {
            this.show();
            this.calculate();
        }

        action() {
            let btn;
            switch (this.working) {
                case false: // cronometro parado
                    this.working = true; // coloca status do cronometro como funcionando
                    btn = document.querySelector('.start-stop');
                    btn.innerHTML = "PARAR";
                    btn.classList.add('press');
                    this.start();
                    break;

                case true: // cronometro funcionando
                    this.working = false; // coloca status do cronometro como parado    
                    btn = document.querySelector('.start-stop');
                    btn.innerHTML = "INICIAR";
                    btn.classList.remove('press');
                    this.stop();
                    break;
            }
        }

        start() {
            this.timerInterval = setInterval(this.work, 1000);
        }

        stop() {
            clearInterval(timerInterval);
        };
    
}




function tdoro() {
   pomodoro = new Timer(3,3);
   short = new Timer();
   long = new Timer(); 

   pomodoro.show();

}

tdoro();
