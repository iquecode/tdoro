<?php
class Statistic {
    private $day;
    private $minWork;
    private $minBreak;
    // private $userId;

    public function getDay(){
        return $this->day;
    }
    public function setDay($i){
        $this->day = $i;
    }
    public function getMinWork(){
        return $this->minWork;
    }
    public function setMinWork($n){
        $this->minWork = $n;
    }
    public function getMinBreak() {
        return $this->minBreak;
    }
    public function setMinBreak($e){
        $this->minBreak = $e;
    }
}