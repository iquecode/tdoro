<?php
class Task {
    private $id;
    private $description;
    private $notes;
    // private $projectId;

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
}








