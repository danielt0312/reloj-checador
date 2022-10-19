<?php
class Quincenas{
    protected $quincenas_anuales = 24;
    public $year;
    public $fortnight;
    public $month;
    public $day;
    public $dateFormat;


    public function startLibrary($date){
        $this->setYear($date);;
        $this->setFortnight($date);
        $this->setMonth();
        $this->setDay();
    }

    public function setYear($date){
        $this->year = substr($date, 0, 4);
    }
    public function setFortnight($date){
        $this->fortnight = substr($date, -2);
    }
    public function setMonth(){
        $this->month = ceil($this->fortnight / 2);
    }
    public function setDay(){
        $this->day = (($this->fortnight % 2) == 0) ? '28' : '01';
    }
    public function getMonth(){
        return $this->month;
    }
    public function getDay(){
        return $this->day;
    }
    public function getDateformat(){
        return $this->dateFormat = $this->year.'-'.$this->month.'-'.$this->day;
    }

}