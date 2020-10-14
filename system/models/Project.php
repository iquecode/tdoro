<?php
require_once 'Task.php';
class Project {
    private $id;
    private $description;
    private $notes;
    private $tasks=[];
    private $hidden;  // padrão: flase 0  -- true 1 : projeto padrão (escondido), mostra apenas as tarefas 
    // private $userId;

    public function getId(){
        return $this->id;
    }
    public function setId($i){
        $this->id = $i;
    }
    public function getDescription(){
        return $this->description;
    }
    public function setDescription($n){
        $this->description = $n;
    }
    public function getNotes() {
        return $this->notes;
    }
    public function setNotes($e){
        $this->notes = $e;
    }
    public function getTasks() {
        return $this->tasks;
    }
    public function setTasks($e){
        $this->tasks = $e;
    }
    public function getHidden() {
        return $this->hidden;
    }
    public function setHidden($e){
        $this->hidden = $e;
    }

}