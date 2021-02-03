<?php declare(strict_types=1);
namespace corp;


final class Employee
{
    private $color;
    private $workingHours;
    private $spentHours;
	public function __construct(string $color)
	{
        $this->color = $color;
        $this->workingHours = 3;
        $this->spentHours = 0;
    }
    
    public function getColor() :string
    {
        return $this->color;
    }

    public function getWorkhours() :int
    {
        return $this->workingHours;
    }
    public function spendHours($task, $hours){
		if($this->workingHours >= $hours){
            $this->spentHours = $hours;
            $this->workingHours -= $hours;
        } else {
            throw new \Exception('Not enough hours');
        }
    }
    
    public function getSpentHours($task){
		return $this->spentHours;
	}
}