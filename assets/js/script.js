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

let config = {
    pomodoro: 25,
    short:  5,
    long: 15,
    longBreakInterval: 4
};

let taskIndexControl = -1;


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

   
    timer.pomodoro.m = config.pomodoro;
    timer.pomodoro.s = 0;
    timer.short.m = config.short;
    timer.short.s = 0;
    timer.long.m = config.long;
    timer.long.s = 0;
    longBreakInterval = config.longBreakInterval;

    

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



function clearModalTasks() {
    const title = document.getElementById('task-title'); 
    const note = document.getElementById('task-note');
    title.value = '';
    note.value = '';
    taskIndexControl = -1;
    document.querySelector('.btn-task-delete').style.display='none';
    document.querySelector('.btn-task').classList.remove('save-active');
}


function startModal(modalID, clear=true) {
    const modal = document.getElementById(modalID);


    if(modal) {

      
        if(clear) {
            clearModalTasks();
        }

       modal.classList.add('show');

       modal.addEventListener('click', (e) => {

             

            if(e.target.id == modalID || e.target.className == "close") {
                modal.classList.remove('show');
            }    

            if(e.target.id == modalID || e.target.className == "btn-set") {
                console.log('salvar configurações');
                config.pomodoro = document.getElementById('pomodoroTime').value;
                config.short = document.getElementById('shortTime').value;
                config.long = document.getElementById('longTime').value;
                config.longBreakInterval = document.getElementById('qtdPomodoros').value;
                modal.classList.remove('show');
                reset();
            }


        });
 


    }


}


function setTaskModal() {

       

        saveActive = false;
        btnTask = document.querySelector('.btn-task');
        btnTaskDelete = document.querySelector('.btn-task-delete');

        btnTask.addEventListener('click', (e) => {
            if (saveActive) {           
                saveNewTask(taskIndexControl);
            }
        });

        btnTaskDelete.addEventListener('click', (e) => {
            saveNewTask(taskIndexControl, true); 
        });




       


        document.querySelector("#task-title").addEventListener("input", function(){
            //let botao_proximo = document.body.querySelector("#proximo");
            
            // habilita o botão com 3 ou mais caracteres digitados
            saveActive = this.value.length >= 1 ? true : false;   
            
           
            if (saveActive) {
                btnTask.classList.add('save-active');
            } else {
                btnTask.classList.remove('save-active');
            }
            
        });
    
}



function saveNewTask(index=-1, del=false) {   //-1 = newTask

    const titleValue = document.getElementById('task-title').value; 
    const noteValue = document.getElementById('task-note').value;
    
    console.log(`Tarefa: ${titleValue}.  Anotações: ${noteValue}`);

    newTask = {};
    newTask.title = titleValue;
    newTask.note = noteValue;
    
    
    if (index==-1) {
        tasks.push(newTask);
    } else if (del=false) {
        tasks[index] = newTask;
    } else {
        tasks.splice(index,1);
    }
    
    
        
    

    localStorage.setItem("tasks", JSON.stringify(tasks)); // coloca os dados do array no localStorage
  
    const modal = document.getElementById('modal-set-task');
    modal.classList.remove('show');
    
    fillTasksStorage();

}


function editTask(index) {
    let title = tasks[index].title;
    let note = tasks[index].note;

    const titleForm = document.getElementById('task-title'); 
    const noteForm = document.getElementById('task-note');
    titleForm.value = title;
    noteForm.value = note;

    document.querySelector('.btn-task-delete').style.display='flex';
    taskIndexControl = index;
    startModal('modal-set-task', false);
}



function fillTasksStorage() {

     

         /* let tasks = [
            { title:'Exemplo de tarefa 1', note:''},
            { title:'Exemplo de tarefa 2', note:'Notas da tarefa 2'},
            { title:'Exemplo de tarefa 3', note:'Notas da tarefa 3'}
        ]; 

        localStorage.setItem("tasks", JSON.stringify(tasks)); */
        //tasks = JSON.parse(localStorage.getItem("tasks"));
        /*
        console.log(typeof tasks); //object
        console.log(tasks); //[1, 2, 3]
        */

       tasks = JSON.parse(localStorage.getItem("tasks"));  // colocando os dados do localStorage no array.
        
       if (tasks) {                // if tasks is not null
            // preencher na tela

            document.querySelector('.task-list').innerHTML = '';
               
            let opt;
            tasks.map((item, index)=>{
                let taskItem = document.querySelector('.model-task').cloneNode(true);
                taskItem.querySelector('.task-title').innerHTML = item.title + '-' + index;
                taskItem.classList.remove('model-task');
                taskItem.classList.add('task');

                if (item.note) {
                    taskItem.querySelector('.task-note').innerHTML = item.note;
                } else {
                    taskItem.querySelector('.task-note').style.display = 'none';
                }

                opt = taskItem.querySelector('.opt');
                opt.style.cursor='pointer';
                opt.addEventListener('click', (e)=>{
                    editTask(index);
                    //addTask();
                });
      
                
                document.querySelector('.task-list').append(taskItem);
                //console.log(item);
            }); 

       } 

       //console.log(tasks);

       //localStorage.clear();

}


function addTask() {
    console.log('Clicou em adicionar tarefa.');
    startModal('modal-set-task');
    //abrir modal para preencher dados da tarefa
    //
    // O que ter no modal?
    // descrição da tarefa
    // notas sobre a tarefa
    // criar projeto com lista de tarefas
    

}

function addNote() {
    console.log('Clicou em add anotações');

    //input-note   mudar displey para flex
    document.querySelector('.input-note').style.display='flex';
    document.querySelector('.add-note').style.display='none';

}



function tdoro() {

     /* let tasks = [
        { title:'Exemplo de tarefa 1', note:''},
        { title:'Exemplo de tarefa 2', note:'Notas da tarefa 2'},
        { title:'Exemplo de tarefa 3', note:'Notas da tarefa 3'}
    ];  */

    let tasks = [];
    localStorage.setItem("tasks", JSON.stringify(tasks)); // colocando os dados do array no localstorage

    setTaskModal();

    

    activate("pomodoro"); 
    fillTasksStorage();  // coloca os dados do local storage no array.

    //Verificar localstorage a procura das tarefas cadastradas
    // se tiver tarefas, colocar na tela
   


    document.querySelector('.add-task').addEventListener('click', (e) => {
        addTask();
    }) 

    document.querySelector('.add-note').addEventListener('click', (e) => {
    addNote();

   /*  document.querySelector('.btn-task').addEventListener('click', (e) => {
        // e.preventDefault();
        console.log('teste');
        saveNewTask();
    }); */


    

}) 


   


}

// localStorage.clear();
tdoro();
