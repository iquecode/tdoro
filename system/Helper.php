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
        $u->setPassword($data['password']);
        $u->setLogtry($data['logTry']);
        $u->setTypeUser($data['typeUser']);         
        $u->setExpiration($data['expiration']);
        $u->setToken($data['token']);
        $u->setPomodoroTime($data['pomodoroTime']);
        $u->setShortBreakTime($data['shortBreakTime']);
        $u->setLongBreakTime($data['longBreakTime']);
        $u->setQtdCicle($data['qtdCicle']);
        $u->setTemplate($data['template']);
        $u->setProjects($data['projects']);
        $u->setStatistics($data['statistics']);
        return $u;
    }


    
    public static function newToken() {
        return 'testeabc123';
    }

    






}




