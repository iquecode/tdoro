let timerInterval;
let work = false; // false-Cronometro parado  true-Cronometro Funcionando
let typeTimer = 'pomodoro';
let longBreakInterval = 4;
let turnsCounter = 0;  

let timer = {
    pomodoro: { m:1, s:00},
    short: { m: 5, s:0},
    long: {m: 15, s:0}
};


function action() {
    let btn;

    switch (work) {
        case false: // cronometro parado
            work = true; // coloca status do cronometro como funcionando
            btn = document.querySelector('.start-stop');
            btn.innerHTML = "PARAR";
            btn.classList.add('press');
            start();
            break;

        case true: // cronometro funcionando
            work = false; // coloca status do cronometro como parado    
            btn = document.querySelector('.start-stop');
            btn.innerHTML = "INICIAR";
            btn.classList.remove('press');
            stop();
            break;
    }


}


function start() {
    timerInterval = setInterval(working, 1000);
}

function stop() {
    clearInterval(timerInterval);
}


function calculateTime() {
    if (timer[typeTimer].s > 0) {
        timer[typeTimer].s--;
    } else {
        if (timer[typeTimer].m >0) {
            timer[typeTimer].s = 59;
            timer[typeTimer].m--;        
        } else {

            console.log('acabou');

            switch (typeTimer) {
                case "pomodoro":
                    console.log("POMODORO!");
                    turnsCounter++;
                    if (turnsCounter < longBreakInterval) {
                        activate("short");
                    }
                    else {
                        turnsCounter = 0;
                        activate("long");
                    }
                    break;
                case "short":
                    activate("pomodoro");
                    break;
                case "long":
                    activate("pomodoro");
                    break;            
            }


        }
    }
}


function working() {
    showTime();
    calculateTime();
}


function showTime() {
    let sText = timer[typeTimer].s.toString();
    let mText = timer[typeTimer].m.toString();
    if (sText.length < 2) sText = "0"+sText;
    if (mText.length < 2) mText = "0"+mText;   
    document.getElementById('ss').innerHTML = sText;
    document.getElementById('mm').innerHTML = mText;
}


function reset() {
    timer.pomodoro.m = 25;
    timer.pomodoro.s = 0;
    timer.short.m = 5;
    timer.short.s = 0;
    timer.long.m = 15;
    timer.long.s = 0;

    

    showTime();
    stop();
    work = true;
    action();
    
   
}


function activate(t) {  // t - pomodoro - short ou long
    let classActive = "btn-"+t;
    let classBox = t+"-box";
    let classAction = t+"-action";
    document.querySelector("."+"btn-pomodoro").classList.remove('.timer-selected');
    document.querySelector("."+"btn-short").classList.remove('.timer-selected');
    document.querySelector("."+"btn-long").classList.remove('.timer-selected');
    document.querySelector("."+classActive).classList.add('.timer-selected');    
    document.querySelector(".timer").classList.remove('pomodoro-box');
    document.querySelector(".timer").classList.remove('short-box');
    document.querySelector(".timer").classList.remove('long-box');
    document.querySelector(".timer").classList.add(classBox);
    document.querySelector(".start-stop").classList.remove('pomodoro-action');
    document.querySelector(".start-stop").classList.remove('short-action');
    document.querySelector(".start-stop").classList.remove('long-action');
    document.querySelector(".start-stop").classList.add(classAction);
    typeTimer = t;

    switch (typeTimer) {
        case "pomodoro": 
            document.querySelector(".msg").innerHTML = "Hora de focar";
            break;
        default:
            document.querySelector(".msg").innerHTML = "Hora da pausa";
            break;
    }

    reset();
}


function startModal(modalID) {
    const modal = document.getElementById(modalID);

    if(modal) {
        modal.classList.add('show');
        modal.addEventListener('click', (e) => {
            if(e.target.id == modalID || e.target.className == "close") {
                modal.classList.remove('show');
            }
        });
    }
}



function fillTasksStorage() {

     

        let tasks = [
            { head:'Exemplo de tarefa 1', note:''},
            { head:'Exemplo de tarefa 2', note:'Notas da tarefa 2'},
            { head:'Exemplo de tarefa 3', note:'Notas da tarefa 3'}
        ];

        localStorage.setItem("tasks", JSON.stringify(tasks));
        //tasks = JSON.parse(localStorage.getItem("tasks"));
        /*
        console.log(typeof tasks); //object
        console.log(tasks); //[1, 2, 3]
        */

       tasks = JSON.parse(localStorage.getItem("tasks"));
        
       if (tasks) {                // if tasks is not null
            // preencher na tela
               
            tasks.map((item, index)=>{
                let taskItem = document.querySelector('.model-task').cloneNode(true);
                taskItem.querySelector('.task-head').innerHTML = item.head;
                taskItem.classList.remove('model-task');
                taskItem.classList.add('task');

                if (item.note) {
                    taskItem.querySelector('.task-note').innerHTML = item.note;
                } else {
                    taskItem.querySelector('.task-note').style.display = 'none';
                }
      
                
                document.querySelector('.task-list').append(taskItem);
                //console.log(item);
            }); 

       } 

       //console.log(tasks);

       //localStorage.clear();

}



function tdoro() {
   activate("pomodoro"); 
   fillTasksStorage();

   //Verificar localstorage a procura das tarefas cadastradas
   // se tiver tarefas, colocar na tela
   


   document.querySelector('.add-task').addEventListener('click', (e) => {
       console.log('CLICOU - ADICIONAR NOVA TAREFA');
   }) 

}

tdoro();
