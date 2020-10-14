<?php
require_once 'models/User.php';
require_once 'Helper.php';

class UserDaoMysql implements UserDao {
    private $pdo;

    public function __construct(PDO $driver) {
        $this->pdo = $driver;
    }

    public function add(User $u) {

    
         $sql = $this->pdo->prepare('INSERT INTO Users (name, email, password, logTry, typeUser,
                expiration, token, pomodoroTime, shortBreakTime, longBreakTime, qtdCicle,
                template) VALUES (:name, :email, :password, :logTry, :typeUser,
                :expiration, :token, :pomodoroTime, :shortBreakTime, :longBreakTime, :qtdCicle,
                :template)');
        $sql->bindValue(':name', $u->getName());
        $sql->bindValue(':email', $u->getEmail());
        $sql->bindValue(':password', $u->getPassword());
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
        $sql = $this->pdo->prepare('SELECT * FROM users WHERE email = :email');
        $sql->bindValue(':email', $email);
        $sql->execute();
        //echo 'find by email - procurando email';

        if ($sql->rowCount() > 0) {
            $data = $sql->fetch();
            $u = new User();
            return Helper::constructUser($u, $data);
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