<?php declare(strict_types=1);
namespace corp;
use corp\Employee;
use corp\Project;


final class Corp
{
	private $employees = [];
	private $employeeColors = ["red", "blue", "yellow", "green"];
	private $workingEmployee;
	private $memos = 0;
	private $projects = [];
	private $office = [];
	public function __construct(int $employeeCount)
	{
		if($employeeCount > 4){
			throw new \Exception("4 players maximum");
		} elseif($employeeCount < 1){
			throw new \Exception("1 players minimum");
		}
		$this->projects = $this->getStartingProjects();
		shuffle($this->projects);
		
		for($i = 0; $i < 5; $i++){
			$this->office[$i] = [];
			for($j = 0; $j < 5; $j++){
				$this->office[$i][$j] = null;
			}
		}
		$this->office[0][0] = new Project(-1, "review");
		$this->office[4][0] = new Project(-1, "red");
		$this->office[4][4] = new Project(-1, "green");
		$this->office[0][4] = new Project(-1, "blue");
		

		for($i = 0; $i < $employeeCount; $i++){
			$employee = new Employee($this->employeeColors[$i], $this);
			$employee->addProject(array_shift($this->projects));
			$employee->addProject(array_shift($this->projects));
			$this->employees[] = $employee;
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
	public function getProjectCount(){
		return count($this->projects);
	}
	public function getStartingProjects(){
		$projects = [];
		for($i = 0; $i < 6; $i++){
			$projects[] = new Project(0);
		}
		for($i = 0; $i < 10; $i++){
			$projects[] = new Project(1);
		}
		for($i = 0; $i < 5; $i++){
			$projects[] = new Project(2);
		}
		for($i = 0; $i < 4; $i++){
			$projects[] = new Project(3);
		}
		return $projects;
	}
	public function getOffice(){
		return $this->office;
	}
	public function placeProject($x, $y, $project){
		$this->office[$x][$y] = $project;
	}
}