<?php declare(strict_types=1);
namespace corp;
use corp\Employee;


final class Corp
{
	private $employees = [];
	private $employeeColors = ["red", "blue", "yellow", "green"];
	private $workingEmployee;
	private $memos = 0;
	public function __construct(int $employeeCount)
	{
		if($employeeCount > 4){
			throw new \Exception("4 players maximum");
		} elseif($employeeCount < 1){
			throw new \Exception("1 players minimum");
		}
		for($i = 0; $i < $employeeCount; $i++){
			$this->employees[] = new Employee($this->employeeColors[$i], $this);
		}
		$this->workingEmployee = 0;
	}
	public function employeeCount(): int
	{
		return count($this->employees);
	}
	public function getWorkingEmployee(): Employee{
		return $this->employees[$this->workingEmployee];
	}
	public function nextTurn(){
		$this->employees[$this->workingEmployee]->setWorkingHours(3);
		$this->employees[$this->workingEmployee]->resetSpentHours();
		$this->workingEmployee += 1;
		if($this->workingEmployee == count($this->employees)){
			$this->workingEmployee = 0;
		}
	}

	public function memoCount(){
		return $this->memos;
	}
	public function addMemo(){
		$this->memos += 1;
	}
}