<?php declare(strict_types=1);
namespace corp;


final class Project
{
    private $value;
    private $type;
    private $rotation;
    public function __construct(int $value, string $type = "project")
	{
        $this->value = $value;
        $this->type = $type;
        $this->rotation = 0;
    }

    public function getValue(){
        return $this->value;
    }

    public function hasNote($x, $y){
        //Oops counter clockwise rotation
        for($i = 0; $i < $this->rotation; $i++){
            if($x == 1 && $y == 1){
                $newX = 1;
                $newY = -1;
            }
            if($x == 1 && $y == -1){
                $newX = -1;
                $newY = -1;
            }
            if($x == -1 && $y == -1){
                $newX = -1;
                $newY = 1;
            }
            if($x == -1 && $y == 1){
                $newX = 1;
                $newY = 1;
            }
            if($x == 0 && $y == 1){
                $newX = 1;
                $newY = 0;
            }
            if($x == 1 && $y == 0){
                $newX = 0;
                $newY = -1;
            }
            if($x == 0 && $y == -1){
                $newX = -1;
                $newY = 0;
            }
            if($x == -1 && $y == 0){
                $newX = 0;
                $newY = 1;
            }
            $x = $newX;
            $y = $newY;
        }
        
        return $this->unrotatedHasNote($x, $y);
    }

    public function unrotatedHasNote($x, $y){
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

    public function getType(){
        return $this->type;
    }

    public function setRotation($rotation){
        $this->rotation = $rotation;
    }
}