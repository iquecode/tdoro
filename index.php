<!DOCTYPE html />
<html lang="pt">
<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" type="text/css" href="assets/css/style.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@400;600;700&display=swap" rel="stylesheet"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>TDORO</title>

    <script src="https://kit.fontawesome.com/dd2129143d.js" crossorigin="anonymous"></script>

</head>
<body>

    <div class="model-task">
        <span class="task-top">
            <span class="check"></span> 
            <i class="opt"><img src="assets/images/icons/options.svg" alt="Opções" width="15px"></i>
        </span>
        
        <div class="task-title"></div>
        <div class="task-note"></div>
        <!-- <div class="task-note">
            Notas sobre a tarefa
        </div> -->
    </div>

    <div class="model-note"></div>



    <div class="layout">
        <header class="header">
            <a class="logo" href=""><img src="assets/images/logo.png" alt="Logo"/></a>  
            <nav>
                <ul class="menu">
                    <li><span id="set" class="button" onclick="startModal('modal-set')">Configurações</span></li>
                    <li><span id="login" class="button" onclick="startModal('modal-login')">Login</span>
                </ul>
            </nav>
        </header>

        <section class="app">
        
            <div class="timer">
                <div class="btns-type-timer">
                    <span class="button btn-pomodoro" onclick="activate('pomodoro')">Pomodoro</span>
                    <span class="button btn-short" onclick="activate('short')">Pausa Curta</span>
                    <span class="button btn-long" onclick="activate('long')">Pausa Longa</span>
                </div>
                <div class="display">
                    <span id="mm">25</span>:<span id="ss">00</span>
                </div>
                <span class="start-stop button shadow" onclick="action()">Iniciar</span>
            </div>

            <span class="msg">
                Trabalho de Exemplo
            </span>

            <div class="task-header">
                <div>Tarefas</div>
                <div class="add-task button">adicionar tarefa</div>    
            </div>

            <div class="task-list">
                
                
              <!--   <div class="task">
                    <span class="task-top">
                        <span class="check"></span> 
                        <i><img src="assets/images/icons/options.svg" alt="Opções" width="15px"></i>
                    </span>
                    
                    <div>... titulo da tarefa</div>
                    <div class="task-note">
                        Notas sobre a tarefa
                    </div>
                </div>

                <div class="task">
                    <span class="task-top">
                        <span class="check"></span> 
                        <i><img src="assets/images/icons/options.svg" alt="Opções" width="15px"></i>
                    </span>
                    
                    <div>... titulo da tarefa</div>
                    <div class="task-note">
                        Notas sobre a tarefa
                    </div>
                </div> -->


            </div>


        </section> 

        <aside class="ads">

        </aside>

        

        <section class="content">   
            <div class="text">
                <h1>Uma ferramenta on-line, baseada na Técnica Pomodoro, para melhorar a sua produtividade</h1>
                <h2>O que é o TDORO?</h2>
                <p>TDORO é um simples, leve e funcional app web para controle de tempo e melhora na produtividade ( seja para estudo, trabalho ou outras tarefas) e que pode ser acessado tanto pelo computador quanto pelo celular e outros dispositivos móveis, tendo design responsivo.</p>
                <p>O desenvolvimento do app foi inspirado na “Técnica Pomodoro”criada por Francesco Cirillo.</p> 
                <h2>Sobre a Técnica Pomodoro</h2>
                <p>A Técnica Pomodoro é uma metodologia de gestão de tempo desenvolvido pelo italiano Francesco Cirillo, em 1987.</p> 
                <p>A técnica consiste na utilização de um cronômetro para dividir o trabalho em ciclos compostos por períodos de 25 minutos de foco, separados por breves intervalos.</p>
                <p>O nome do método deriva da palavra italiana pomodoro (tomate), como referência ao  cronômetro gastronômico utilizado por Cirillo nos tempos de universidade.</p>
                <p>O método é baseado na idéia de que pausas frequentes podem aumentar a agilidade mental.</p>

                <h2>Como usar o TDORO?</h2> 
                <p>1. Escolha a lista de tarefas a serem executadas.</p>
                <p>2. Selecione a tarefa inicial.</p>
                <p>3. Inicie o cronometro e se foque na tarefa por 25 minutos (pode-se configurar outro tempo).</p>
                <p>4. Descanse por 5 minutos quando o tempo acabar (pode-se configurar outro tempo, refere-se ao “descanso curto”).</p>
                <p>5. Repita o processo por 4 vezes (o padrão é um ciclo de 4 repetições, mas pode-se alterar esse número nas configurações).</p>
                <p>6. Se ainda existirem tarefas a serem executadas, descanse por 15 minutos (pode-se configurar outro tempo, refere-se ao “descanso longo”).</p>
            </div>   
        </section>

        <aside class="ads">

        </aside>


        <footer class="footer">
            ...
        </footer>


        
        <div id="modal-login" class="modal-container">
            <div class="modal">
                <button class="close">x</button>
                
                
                
                <div class="login-div">
                    <form class="form-login" action="" method="">

                        <input class="input-login" type="email" name="login-email" placeholder="email..."  />
                        <input class="input-login" type="password" name= "login-password" placeholder="senha... "/>
                        <input class="login-submit" type="submit" value="Login" />
                    </form>

                    <label class="forgot-password" onclick="setModalLogin('password')">
                        Esqueci a senha
                    </label>    

                    <label class="new-account" onclick="setModalLogin('new')" >
                        <span>Não tem conta no Tdoro?</span>
                        <span class="btn btn-new-account">Criar uma conta</span>
                    </label>
                </div>

                <div class="new-account-div">
                    Digite seu email e escolha uma senha...
                    <form class="form-login" action="system/newAccount.php" method="POST">
                        <input class="input-login" type="email" name="new-email" placeholder="email..."  />
                        <input class="input-login" type="password" name= "new-password1" placeholder="Escolha uma senha... "/>
                        <input class="input-login" type="password" name= "new-password2" placeholder="Confirme a senha... "/>
                        <input class="login-submit" type="submit" value="Criar conta" />
                    </form>
                </div>

                <div class="new-password-div">
                    Digite seu email para prosseguir com cadastro de nova senha.
                    <form class="form-login" action="" method="">
                        <input class="input-login" type="email" name="email-new-password" placeholder="email..."  />
                        <input class="login-submit" type="submit" value="Enviar" />
                    </form>
                </div>


            
            </div>
        </div>





        <div id="modal-set" class="modal-container">
            <div class="modal">
                <button class="close">x</button>
                <h3>Configurações</h3>
                <form action="" method="">

                    <label class="label-title">Tempo (minutos)</label>
                
                    <div class="times">
                        <label class="label-lite">
                            <span>Pomodoro</span>
                            <input class="input-n" type="number" name ="pomodoro" value="25" min="0" max="120" />
                        </label>
                        <label class="label-lite">
                            <span>Pausa Curta</span>
                            <input class="input-n" type="number" name ="short" value="5" min="0" max="60" />    
                        </label>
                        <label class="label-lite">
                            <span>Pausa Longa</span>
                            <input class="input-n" type="number" name ="long" value="15" min="0" max="120" />
                        </label>
                    </div>
                    
                
                    <label class="label-title">
                        <sapan>Qtd. de Pomodoros para a pausa longa</sapan>
                        <input class="input-n" type="number" name ="interval-long" value="4" />
                    </label>          
                    <span class="btn-set">Salvar</span> 
                </form>
            </div>
        </div>

        <div id="modal-set-task" class="modal-container">
            <div class="modal-task">
                <button class="close">x</button>
                <form action="" method="">

                    <input class="input-text" type="text" name ="task-title" id="task-title" placeholder="Digite aqui a descrição da nova tarefa..."/>
                    
                    <textarea class="input-note" name="task-note" id="task-note" placeholder="Você pode digitar anotações sobre a tarefa aqui..." ></textarea>

                    <div class="add-in-tasks">
                        <span class="add-note">+ Anotações</span>
                        <span class="add-project">+ Projeto</span>
                    </div>
                    
                    <div class="btns-new-task">

                        <div><span class="btn-task-delete">Deletar</span></div>
                        <div><span class="btn-task" id="save-new-task">Salvar</span></div>
                           
                    </div>
                          
                     
                </form>
            </div>
        </div>













    </div>



    <script src="assets/js/script.js"></script>    
</body>
</html>