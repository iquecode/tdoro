<?php
require_once 'config.php';
require_once 'UserDaoMysql.php';
require_once 'Helper.php';

$userDao = new UserDaoMysql($pdo);

$email = filter_input(INPUT_POST, 'new-email', FILTER_VALIDATE_EMAIL);
$pass  = filter_input(INPUT_POST, 'new-password1', FILTER_SANITIZE_STRING);
$pass2 = filter_input(INPUT_POST, 'new-password2', FILTER_SANITIZE_STRING); 

$passEqual = $pass == $pass2;
$passOk = Helper::validatePass($pass); 

echo 'email: '.$email.'<br/>';
echo 'senha : '.$pass.'<br/>';
echo 'senha2: '.$pass2.'<br/>';

echo 'isset($email): '.isset($email).'<br/>';
echo '$passEqual: '.$passEqual.'</br>'; 
echo '$passOk: '.$passOk;


if(isset($email) && $passEqual && $passOk) {

    if($userDao->findByEmail($email) === false) {
        $user = new User();
        $user->setName('');
        $user->setEmail($email);
        $user->setPassword( password_hash($pass, PASSWORD_DEFAULT) );
        $user->setLogtry(0);
        $user->setTypeUser(0);
        $user->setExpiration('2021-06-01');
        $user->setToken( Helper::newToken() );
        $user->setPomodoroTime(25);
        $user->setShortBreakTime(5);
        $user->setLongBreakTime(15);
        $user->setQtdCicle(4);
        $user->setTemplate(0);
        
        $projectDefault = new Project();
        $projectDefault->setHidden(true);
        $projectsArray = [$projectDefault];  
        $user->setProjects($projectsArray);



        $userDao->add( $user );

        //print_r( $novoUsuario );

        /* header('Location: index.php');
        exit;  */
    }  /* else {
        header('Location: adicionar.php');
        exit;
    } */

} /* else {
    header('Location: adicionar.php');
    exit;
}   */