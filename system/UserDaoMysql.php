<?php
require_once 'models/User.php';
require_once 'models/Project.php';
require_once 'models/Task.php';
require_once 'models/Statistic.php';
require_once 'Helper.php';

class UserDaoMysql implements UserDao {
    private $pdo;

    public function __construct(PDO $driver) {
        $this->pdo = $driver;
    }


   

    public function add(User $u) {

    
         $sql = $this->pdo->prepare('INSERT INTO Users (name, email, passHash, logTry, typeUser,
                expiration, token, pomodoroTime, shortBreakTime, longBreakTime, qtdCicle,
                template) VALUES (:name, :email, :passHash, :logTry, :typeUser,
                :expiration, :token, :pomodoroTime, :shortBreakTime, :longBreakTime, :qtdCicle,
                :template)');
        $sql->bindValue(':name', $u->getName());
        $sql->bindValue(':email', $u->getEmail());
        $sql->bindValue(':passHash', $u->getPassHash());
        $sql->bindValue(':logTry', $u->getLogTry());
        $sql->bindValue(':typeUser', $u->getTypeUser());
        $sql->bindValue(':expiration', $u->getExpiration());
        $sql->bindValue(':token', $u->getToken());
        $sql->bindValue(':pomodoroTime', $u->getPomodoroTime());
        $sql->bindValue(':shortBreakTime', $u->getShortBreakTime());
        $sql->bindValue(':longBreakTime', $u->getLongBreakTime());
        $sql->bindValue(':qtdCicle', $u->getQtdCicle());
        $sql->bindValue(':template', $u->getTemplate());
        
        $sql->execute();

        $sql->debugDumpParams();

        //$sql->debugDumpParams();

        $u->setId( $this->pdo->lastInsertId() );
        //print_r($u); */
        return $u;
    }
    
    public function findAll() {
        $array = [];

        $sql = $this->pdo->query('SELECT * FROM users');
        if($sql->rowCount() > 0) {
            $data = $sql->fetchAll();

            foreach($data as $item) {
                $u = new User();
                $u->setId($item['id']);
                $u->setNome($item['nome']);
                $u->setEmail($item['email']);
                $array[] = $u;
            }          
        }

        return $array;
    }

    public function findByEmail($email) {
        $sql = $this->pdo->prepare('SELECT * FROM Users WHERE email = :email');
        $sql->bindValue(':email', $email);
        $sql->execute();
        //echo 'find by email - procurando email';

        if ($sql->rowCount() > 0) {
            $data = $sql->fetch();
            $u = new User();
            $u->setId($data['id']);
            $u->setName($data['name']);
            $u->setEmail($data['email']);
            $u->setPassHash($data['passHash']);
            $u->setLogtry($data['logTry']);
            $u->setTypeUser($data['typeUser']);         
            $u->setExpiration($data['expiration']);
            $u->setToken($data['token']);
            $u->setPomodoroTime($data['pomodoroTime']);
            $u->setShortBreakTime($data['shortBreakTime']);
            $u->setLongBreakTime($data['longBreakTime']);
            $u->setQtdCicle($data['qtdCicle']);
            $u->setTemplate($data['template']);

            //Pegar array com os projetos relacionados com o User
            //$userId = $u->getId();
            $userId = $u->getId();
            $sqlProjects = $this->pdo->prepare('SELECT * FROM Projects WHERE userId = :userId');
            $sqlProjects->bindValue(':userId', $userId);
            $sqlProjects->execute();
            $dataProjects = $sqlProjects->fetchAll(PDO::FETCH_ASSOC);
            echo('<br/>'.'Projetos do UserId '.$userId.' : '.'<br/>');
            //print_r($dataProjects);
            $projects = [];
            foreach($dataProjects as $item) {
                $p = new Project();
                $p->setId($item['id']);
                $p->setDescription($item['description']);
                $p->setNotes($item['notes']);
                $p->setHidden($item['hidden']);

                $projectId = $p->getId();
                $sqlTasks = $this->pdo->prepare('SELECT * FROM Tasks WHERE projectId = :projectId');
                $sqlTasks->bindValue(':projectId', $projectId);
                $sqlTasks->execute();
                $dataTasks = $sqlTasks->fetchAll(PDO::FETCH_ASSOC);

                echo('Tarefas do projeto ID#'.$projectId.'<br/>');
                print_r($dataTasks);
                echo('<br/>'.'**** Objetos t - new Task*****'.'<br/>');
                $tasks = []; 
                foreach($dataTasks as $item) {
                    $t = new Task();
                    $t->setId($item['id']);
                    $t->setDescription($item['description']);
                    $t->setNotes($item['notes']);
                    array_push($tasks, $t);
                    //print_r($t);
                    //echo('<br/>');
                }
                $p->setTasks($tasks);
                array_push($projects, $p);
                //echo('<br/><br/>');

                /* echo('Tarefas do projeto ID#'.$projectId.'<br/>');
                print_r($dataTasks);
                echo('<br/><br/>'); */


               /*  print_r($item);
                echo('<br/>');
                echo('*** Objeto p - New Project*****'.'<br/>');
                print_r($p);
                echo('<br/><br/>'); */
            }

            $u->setProjects($projects);


            $sqlStatistics = $this->pdo->prepare('SELECT * FROM Statistics WHERE userId = :userId');
            $sqlStatistics->bindValue(':userId', $userId);
            $sqlStatistics->execute();
            $dataStatistics = $sqlStatistics->fetchAll(PDO::FETCH_ASSOC);
            $statiscs = []; 
            foreach($dataStatistics as $item) {
                $s = new Statistic();
                $s->setDay($item['day']);
                $s->setMinWork($item['minWork']);
                $s->setMinBreak($item['minBreak']);
                array_push($statiscs, $s);
                //print_r($t);
                //echo('<br/>');
            }
            $u->setStatistics($statiscs);
           
           

            //criar um array de objetos Projetos e já colocar as Tasks relacionadas a cada projeto



            //return Helper::constructUser($u, $data);
            //return constructUser($u, $data);
            //echo('<br/>'.'****objeto $u --- new User***'.'<br/>');
            var_dump($u);
            return $u;

        } else {
            //echo 'findByEmail - false';
            return false;
        }
    }

    public function findById($id) {
        $sql = $this->pdo->prepare('SELECT * FROM users WHERE id = :id');
        $sql->bindValue(':id', $id);
        $sql->execute();
        //$sql->debugDumpParams();
        

        if ($sql->rowCount() > 0) {
            $data = $sql->fetch();
            $u = new User();
            $u->setId($data['id']);
            $u->setNome($data['nome']);
            $u->setEmail($data['email']);
            return $u;
        } else {
            return false;
        }

    }

    public function update(User $u) {
       $sql = $this->pdo->prepare('UPDATE users SET nome = :nome, email = :email WHERE id = :id');
       $sql->bindValue(':nome', $u->getNome());
       $sql->bindValue(':email', $u->getEmail());
       $sql->bindValue(':id', $u->getId());
       $sql->execute();

       return true;
    }

    public function delete($id) {
        $sql = $this->pdo->prepare('DELETE FROM users WHERE id=:id');
        $sql->bindValue(':id', $id);
        $sql->execute();
    }



}