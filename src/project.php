<?php declare(strict_types=1);
namespace corp;


final class Project
{
    private $value;
    public function __construct(int $value)
	{
        $this->value = $value;
    }

    public function getValue(){
        return $this->value;
    }

    public function hasNote($x, $y){
        if($this->value == 0){
            if($y <= 0){
                return true;
            } else {
                return false;
            }
        } elseif($this->value == 1){
            if($y == -1){
                return true;
            } else {
                return false;
            }
        } elseif($this->value == 2){
            if(($y == -1 && $x == -1) || ($y == -1 && $x == 0) || ($y == 0 && $x == -1)){
                return true;
            } else {
                return false;
            }
        } elseif($this->value == 3){
            if(($y == -1 && $x == -1) || ($y == -1 && $x == 0)){
                return true;
            } else {
                return false;
            }
        }
        return true;
    }
}