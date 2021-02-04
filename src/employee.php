<?php declare(strict_types=1);
namespace corp;


final class Employee
{
    private $color;
    private $workingHours;
    private $spentHours;
    private $hasMemo;
	public function __construct(string $color)
	{
        $this->color = $color;
        $this->workingHours = 3;
        $this->resetSpentHours();
        $this->hasMemo = true;
    }
    
    public function getColor() :string
    {
        return $this->color;
    }

    public function setWorkingHours(int $workingHours){
        $this->workingHours = $workingHours;
    }

    public function getWorkhours() :int
    {
        return $this->workingHours;
    }
    public function spendHours($task, $hours){
        if($task == 'memo'){
            if($this->hasMemo == true){
                throw new \Exception('Can only have one memo');
            }
        }
		if($this->workingHours >= $hours){
            $this->spentHours[$task] += $hours;
            $this->workingHours -= $hours;
        } else {
            throw new \Exception('Not enough hours');
        }
    }
    
    public function getSpentHours($task){
		return $this->spentHours[$task];
    }
    
    public function resetSpentHours(){
        $this->spentHours = ['move' => 0, 'research' => 0, 'place' => 0, 'memo' => 0];
    }

    public function getMemo(){
        return $this->hasMemo;
    }

    public function setMemo(bool $memo){
        $this->hasMemo = $memo;
    }
}