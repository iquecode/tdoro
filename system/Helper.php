<?php
class Helper {
    
    public static function validatePass($p) {
        $validate = false;
        if (strlen($p) >= 4) {
            $validate = true;
        }
        return $validate;
    }




    public static function constructUser($u, $data) {
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

        
       /*  // Pegar array com os projetos relacionados com o User
        $userId = $u->getId();
        $sqlProjects = $this->pdo->prepare('SELECT * FROM Projects WHERE userId = :userId');
        $sqlProjects->bindValue(':userId', $userId);
        $sqlProjects->execute();
        $dataProjects = $sqlProjects->fetchAll(PDO::FETCH_ASSOC);

        echo('Projetos do UserId '.$userId.' : '.'<br/>');
        print_r($dataProjects); */



        //
        //$u->setProjects($data['projects']);
        //$u->setStatistics($data['statistics']);
        return $u;
    }


    
    public static function newToken() {
        return 'testeabc123';
    }

    






}




