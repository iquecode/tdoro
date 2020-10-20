<?php
require 'Project.php';
require 'Statistic.php';
class User {
    private $id; 
    private $name;
    private $email;
    private $passHash;
    private $logTry;         
    private $typeUser;
    private $expiration;
    private $token;
    private $pomodoroTime;
    private $shortBreakTime;
    private $longBreakTime;
    private $qtdCicle;
    private $template;
    private $projects=[];
    private $statistics=[];
    
    public function getId(){
        return $this->id;
    }
    public function setId($i){
        $this->id = trim($i);
    }
    public function getName(){
        return $this->name;
    }
    public function setName($n){
        $nTemp = strtolower(trim($n));
        $this->nome = ucwords($nTemp);
    }
    public function getEmail() {
        return $this->email;
    }
    public function setEmail($e){
        $this->email = strtolower(trim($e));
    }
    public function getPassHash(){
        return $this->passHash;
    }
    public function setPassHash($i){
        $this->passHash = trim($i);
    }
    public function getLogTry(){
        return $this->logTry;
    }
    public function setLogTry($n){
        $this->logTry = $n;
    }
    public function getTypeUser() {
        return $this->typeUser;
    }
    public function setTypeUser($e){
        $this->typeUser = $e;
    }
    public function getExpiration(){
        return $this->expiration;
    }
    public function setExpiration($i){
        $this->expiration = $i;
    }
    public function getToken(){
        return $this->token;
    }
    public function setToken($n){
        $this->token = $n;
    }
    public function getPomodoroTime() {
        return $this->pomodoroTime;
    }
    public function setPomodoroTime($e){
        $this->pomodoroTime = $e;
    }
    public function getShortBreakTime() {
        return $this->shortBreakTime;
    }
    public function setShortBreakTime($e){
        $this->shortBreakTime = $e;
    }
    public function getLongBreakTime(){
        return $this->longBreakTime;
    }
    public function setLongBreakTime($i){
        $this->longBreakTime = $i;
    }
    public function getQtdCicle(){
        return $this->qtdCicle;
    }
    public function setQtdCicle($n){
        $this->qtdCicle = $n;
    }
    public function getTemplate() {
        return $this->template;
    }
    public function setTemplate($e){
        $this->template = $e;
    }
    public function getProjects() {
        return $this->projects;
    }
    public function setProjects($e){
        $this->projects = $e;
    }
    public function getStatistics() {
        return $this->statistics;
    }
    public function setStatistics($e){
        $this->statistics = $e;
    }
}

interface UserDao {
    public function add(User $u);
    public function findAll();
    public function findByEmail($email);
    public function findById($id);
    public function update(User $u);
    public function delete($id);
}