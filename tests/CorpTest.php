<?php declare(strict_types=1);
namespace corp;

use PHPUnit\Framework\TestCase;
use corp\Corp;
use corp\Project;

final class CorpTest extends TestCase
{
    public function testGetEmployeeCount(): void
    {
        $corp = new Corp(4);
        $this->assertEquals(4, $corp->employeeCount());
    }

    public function testGetEmployeeCount3(): void
    {
        $corp = new Corp(3);
        $this->assertEquals(3, $corp->employeeCount());
    }

    public function testGetEmployeeCount2(): void
    {
        $corp = new Corp(2);
        $this->assertEquals(2, $corp->employeeCount());
    }

    public function testGetEmployeeCount1(): void
    {
        $corp = new Corp(1);
        $this->assertEquals(1, $corp->employeeCount());
    }

    public function testGetEmployeeCount5(): void
    {
        $this->expectException(\Exception::class);
        $corp = new Corp(5);
    }

    public function testGetEmployeeCount0(): void
    {
        $this->expectException(\Exception::class);
        $corp = new Corp(0);
    }

    public function testSetupEmployeeClass(): void
    {
        $corp = new Corp(1);
        $workingEmployee = $corp->getWorkingEmployee();
        $this->assertInstanceOf(Employee::class, $workingEmployee);
    }

    public function testSetupEmployeeColor(): void
    {
        $corp = new Corp(1);
        $workingEmployee = $corp->getWorkingEmployee();
        $this->assertEquals("red", $workingEmployee->getColor());
    }

    public function testSetupEmployeeColors(): void
    {
        $corp = new Corp(4);
        $workingEmployee = $corp->getWorkingEmployee();
        $this->assertEquals("red", $workingEmployee->getColor());
        $corp->nextTurn();
        $this->assertEquals("blue", $corp->getWorkingEmployee()->getColor());
        $corp->nextTurn();
        $this->assertEquals("yellow", $corp->getWorkingEmployee()->getColor());
        $corp->nextTurn();
        $this->assertEquals("green", $corp->getWorkingEmployee()->getColor());
        $corp->nextTurn();
        $this->assertEquals("red", $corp->getWorkingEmployee()->getColor());
    }

    public function testWorkhours(): void
    {
        $corp = new Corp(1);
        $workingEmployee = $corp->getWorkingEmployee();
        $this->assertEquals(3, $workingEmployee->getWorkhours());
    }

    public function testWorkhoursSpending1(): void
    {
        $corp = new Corp(1);
        $workingEmployee = $corp->getWorkingEmployee();
        $this->assertEquals(3, $workingEmployee->getWorkhours());
        $workingEmployee->spendHours("place", 1);
        $this->assertEquals(2, $workingEmployee->getWorkhours());
    }

    public function testWorkhoursSpending2(): void
    {
        $corp = new Corp(1);
        $workingEmployee = $corp->getWorkingEmployee();
        $this->assertEquals(3, $workingEmployee->getWorkhours());
        $workingEmployee->spendHours("place", 2);
        $this->assertEquals(1, $workingEmployee->getWorkhours());
    }

    public function testWorkhoursSpending3(): void
    {
        $corp = new Corp(1);
        $workingEmployee = $corp->getWorkingEmployee();
        $this->assertEquals(3, $workingEmployee->getWorkhours());
        $workingEmployee->spendHours("place", 3);
        $this->assertEquals(0, $workingEmployee->getWorkhours());
    }

    public function testWorkhoursSpendingTooMany(): void
    {
        $corp = new Corp(1);
        $workingEmployee = $corp->getWorkingEmployee();
        $this->assertEquals(3, $workingEmployee->getWorkhours());
        $this->expectException(\Exception::class);
        $workingEmployee->spendHours("place", 4);
    }

    public function testWorkhoursSpent1(): void
    {
        $corp = new Corp(1);
        $workingEmployee = $corp->getWorkingEmployee();
        $this->assertEquals(3, $workingEmployee->getWorkhours());
        $workingEmployee->spendHours("place", 1);
        $this->assertEquals(1, $workingEmployee->getSpentHours("place"));
    }

    public function testWorkhoursSpent(): void
    {
        $corp = new Corp(1);
        $workingEmployee = $corp->getWorkingEmployee();
        $this->assertEquals(3, $workingEmployee->getWorkhours());
        $this->assertEquals(0, $workingEmployee->getSpentHours("place"));
    }

    public function testWorkhoursSpending3TurnReset(): void
    {
        $corp = new Corp(1);
        $workingEmployee = $corp->getWorkingEmployee();
        $this->assertEquals(3, $workingEmployee->getWorkhours());
        $workingEmployee->spendHours("place", 3);
        $this->assertEquals(0, $workingEmployee->getWorkhours());
        $corp->nextTurn();
        $this->assertEquals(3, $workingEmployee->getWorkhours());
    }

    public function testWorkhoursSpentPlace(): void
    {
        $corp = new Corp(1);
        $workingEmployee = $corp->getWorkingEmployee();
        $this->assertEquals(3, $workingEmployee->getWorkhours());
        $workingEmployee->spendHours("place", 3);
        $this->assertEquals(3, $workingEmployee->getSpentHours("place"));
    }

    public function testWorkhoursSpentMove(): void
    {
        $corp = new Corp(1);
        $workingEmployee = $corp->getWorkingEmployee();
        $this->assertEquals(3, $workingEmployee->getWorkhours());
        $this->assertEquals(0, $workingEmployee->getSpentHours("move"));
    }

    public function testWorkhoursSpentMove3(): void
    {
        $corp = new Corp(1);
        $workingEmployee = $corp->getWorkingEmployee();
        $this->assertEquals(3, $workingEmployee->getWorkhours());
        $workingEmployee->spendHours("move", 3);
        $this->assertEquals(3, $workingEmployee->getSpentHours("move"));
    }

    public function testWorkhoursSpentResearch(): void
    {
        $corp = new Corp(1);
        $workingEmployee = $corp->getWorkingEmployee();
        $this->assertEquals(3, $workingEmployee->getWorkhours());
        $this->assertEquals(0, $workingEmployee->getSpentHours("research"));
    }

    public function testWorkhoursSpentResearch3(): void
    {
        $corp = new Corp(1);
        $workingEmployee = $corp->getWorkingEmployee();
        $this->assertEquals(3, $workingEmployee->getWorkhours());
        $workingEmployee->spendHours("research", 3);
        $this->assertEquals(3, $workingEmployee->getSpentHours("research"));
    }

    public function testWorkhoursSpentMemo(): void
    {
        $corp = new Corp(1);
        $workingEmployee = $corp->getWorkingEmployee();
        $this->assertEquals(3, $workingEmployee->getWorkhours());
        $this->assertEquals(0, $workingEmployee->getSpentHours("memo"));
    }

    public function testWorkhoursSpentMemo1(): void
    {
        $corp = new Corp(1);
        $corp->addMemo();
        $workingEmployee = $corp->getWorkingEmployee();
        $this->assertEquals(3, $workingEmployee->getWorkhours());
        $workingEmployee->setMemo(false);
        $workingEmployee->spendHours("memo", 1);
        $this->assertEquals(1, $workingEmployee->getSpentHours("memo"));
    }

    public function testWorkhoursSpentMix(): void
    {
        $corp = new Corp(1);
        $workingEmployee = $corp->getWorkingEmployee();
        $this->assertEquals(3, $workingEmployee->getWorkhours());
        $workingEmployee->spendHours("research", 2);
        $workingEmployee->spendHours("move", 1);
        $this->assertEquals(2, $workingEmployee->getSpentHours("research"));
        $this->assertEquals(1, $workingEmployee->getSpentHours("move"));
    }

    public function testWorkhoursSpentMemoReset(): void
    {
        $corp = new Corp(1);
        $corp->addMemo();
        $workingEmployee = $corp->getWorkingEmployee();
        $this->assertEquals(3, $workingEmployee->getWorkhours());
        $workingEmployee->setMemo(false);
        $workingEmployee->spendHours("memo", 1);
        $this->assertEquals(1, $workingEmployee->getSpentHours("memo"));
        $corp->nextTurn();
        $this->assertEquals(0, $workingEmployee->getSpentHours("memo"));
    }

    public function testWorkhoursSpentMoveReset(): void
    {
        $corp = new Corp(1);
        $workingEmployee = $corp->getWorkingEmployee();
        $this->assertEquals(3, $workingEmployee->getWorkhours());
        $workingEmployee->spendHours("move", 1);
        $this->assertEquals(1, $workingEmployee->getSpentHours("move"));
        $corp->nextTurn();
        $this->assertEquals(0, $workingEmployee->getSpentHours("move"));
    }

    public function testWorkhoursSpentPlaceReset(): void
    {
        $corp = new Corp(1);
        $workingEmployee = $corp->getWorkingEmployee();
        $this->assertEquals(3, $workingEmployee->getWorkhours());
        $workingEmployee->spendHours("place", 1);
        $this->assertEquals(1, $workingEmployee->getSpentHours("place"));
        $corp->nextTurn();
        $this->assertEquals(0, $workingEmployee->getSpentHours("place"));
    }

    public function testWorkhoursSpentResearchReset(): void
    {
        $corp = new Corp(1);
        $workingEmployee = $corp->getWorkingEmployee();
        $this->assertEquals(3, $workingEmployee->getWorkhours());
        $workingEmployee->spendHours("research", 1);
        $this->assertEquals(1, $workingEmployee->getSpentHours("research"));
        $corp->nextTurn();
        $this->assertEquals(0, $workingEmployee->getSpentHours("research"));
    }

    public function testHaveMemo(): void
    {
        $corp = new Corp(1);
        $workingEmployee = $corp->getWorkingEmployee();
        $this->assertEquals(true, $workingEmployee->getMemo());
    }

    public function testSetMemo(): void
    {
        $corp = new Corp(1);
        $workingEmployee = $corp->getWorkingEmployee();
        $this->assertEquals(true, $workingEmployee->getMemo());
        $workingEmployee->setMemo(false);
        $this->assertEquals(false, $workingEmployee->getMemo());
    }

    public function testAlreadyHaveMemo(): void
    {
        $corp = new Corp(1);
        $workingEmployee = $corp->getWorkingEmployee();
        $this->assertEquals(true, $workingEmployee->getMemo());
        $this->expectException(\Exception::class);
        $workingEmployee->spendHours("memo", 1);
    }

    public function testCorpHasMemo(): void
    {
        $corp = new Corp(1);
        $workingEmployee = $corp->getWorkingEmployee();
        $workingEmployee->setMemo(false);
        $this->assertEquals(0, $corp->memoCount());
        $corp->addMemo();
        $this->assertEquals(1, $corp->memoCount());
        $workingEmployee->spendHours("memo", 1);
        $this->assertEquals(1, $workingEmployee->getSpentHours("memo"));
    }

    public function testCorpHasNoMemo(): void
    {
        $corp = new Corp(1);
        $workingEmployee = $corp->getWorkingEmployee();
        $workingEmployee->setMemo(false);
        $this->assertEquals(0, $corp->memoCount());
        $this->expectException(\Exception::class);
        $workingEmployee->spendHours("memo", 1);
    }

    public function testCorpProjects(): void
    {
        $corp = new Corp(1);
        $this->assertEquals(23, $corp->getProjectCount());
        $workingEmployee = $corp->getWorkingEmployee();
        $this->assertEquals(2, $workingEmployee->getProjectCount());
    }

    public function testCorpProjects2(): void
    {
        $corp = new Corp(2);
        $this->assertEquals(21, $corp->getProjectCount());
        $workingEmployee = $corp->getWorkingEmployee();
        $this->assertEquals(2, $workingEmployee->getProjectCount());
        $corp->nextTurn();
        $workingEmployee = $corp->getWorkingEmployee();
        $this->assertEquals(2, $workingEmployee->getProjectCount());
    }

    public function testCorpProjects3(): void
    {
        $corp = new Corp(3);
        $this->assertEquals(19, $corp->getProjectCount());
        $workingEmployee = $corp->getWorkingEmployee();
        $this->assertEquals(2, $workingEmployee->getProjectCount());
        $corp->nextTurn();
        $workingEmployee = $corp->getWorkingEmployee();
        $this->assertEquals(2, $workingEmployee->getProjectCount());
        $corp->nextTurn();
        $workingEmployee = $corp->getWorkingEmployee();
        $this->assertEquals(2, $workingEmployee->getProjectCount());
    }

    public function testCorpProjects4(): void
    {
        $corp = new Corp(4);
        $this->assertEquals(17, $corp->getProjectCount());
        $workingEmployee = $corp->getWorkingEmployee();
        $this->assertEquals(2, $workingEmployee->getProjectCount());
        $corp->nextTurn();
        $workingEmployee = $corp->getWorkingEmployee();
        $this->assertEquals(2, $workingEmployee->getProjectCount());
        $corp->nextTurn();
        $workingEmployee = $corp->getWorkingEmployee();
        $this->assertEquals(2, $workingEmployee->getProjectCount());
        $corp->nextTurn();
        $workingEmployee = $corp->getWorkingEmployee();
        $this->assertEquals(2, $workingEmployee->getProjectCount());
    }

    public function testBossDefault(): void
    {
        $corp = new Corp(1);
        $workingEmployee = $corp->getWorkingEmployee();
        $this->assertFalse($workingEmployee->getVisitedBoss('red'));
    }

    public function testBossSet(): void
    {
        $corp = new Corp(1);
        $workingEmployee = $corp->getWorkingEmployee();
        $this->assertFalse($workingEmployee->getVisitedBoss('red'));
        $workingEmployee->setVisitedBoss('red');
        $this->assertTrue($workingEmployee->getVisitedBoss('red'));
    }

    public function testBossSetAll(): void
    {
        $corp = new Corp(1);
        $workingEmployee = $corp->getWorkingEmployee();
        $this->assertFalse($workingEmployee->getVisitedBoss('red'));
        $this->assertFalse($workingEmployee->getVisitedBoss('blue'));
        $this->assertFalse($workingEmployee->getVisitedBoss('green'));
        $workingEmployee->setVisitedBoss('red');
        $this->assertTrue($workingEmployee->getVisitedBoss('red'));
        $this->assertFalse($workingEmployee->getVisitedBoss('blue'));
        $this->assertFalse($workingEmployee->getVisitedBoss('green'));
    }

    public function testBossSetAllVisit(): void
    {
        $corp = new Corp(1);
        $workingEmployee = $corp->getWorkingEmployee();
        $this->assertFalse($workingEmployee->getVisitedBoss('red'));
        $this->assertFalse($workingEmployee->getVisitedBoss('blue'));
        $this->assertFalse($workingEmployee->getVisitedBoss('green'));
        $workingEmployee->setVisitedBoss('red');
        $workingEmployee->setVisitedBoss('blue');
        $workingEmployee->setVisitedBoss('green');
        $this->assertTrue($workingEmployee->getVisitedBoss('red'));
        $this->assertTrue($workingEmployee->getVisitedBoss('blue'));
        $this->assertTrue($workingEmployee->getVisitedBoss('green'));
    }

    public function testGetProjectCards(): void
    {
        $corp = new Corp(1);
        $workingEmployee = $corp->getWorkingEmployee();
        $projects = $workingEmployee->getProjects();
        $this->assertTrue(is_array($projects));
    }
    
    public function testGetProjectCardCount(): void
    {
        $corp = new Corp(1);
        $workingEmployee = $corp->getWorkingEmployee();
        $projects = $workingEmployee->getProjects();
        $this->assertEquals(2, count($projects));
    }

    public function testGetProjectCardValue(): void
    {
        $corp = new Corp(1);
        $workingEmployee = $corp->getWorkingEmployee();
        $projects = $workingEmployee->getProjects();
        $this->assertTrue($projects[0]->getValue() >= 0 && $projects[0]->getValue() <= 3);
    }

    public function testGetProjectValue(): void
    {
        $project = new Project(0);
        $this->assertEquals(0, $project->getValue());
        $project = new Project(1);
        $this->assertEquals(1, $project->getValue());
        $project = new Project(2);
        $this->assertEquals(2, $project->getValue());
        $project = new Project(3);
        $this->assertEquals(3, $project->getValue());
    }

    public function testGetProjectSidesValue0(): void
    {
        $project = new Project(0);
        $this->assertEquals(true, $project->hasNote(-1, 0));
        $this->assertEquals(true, $project->hasNote(-1, -1));
        $this->assertEquals(true, $project->hasNote(0, -1));
        $this->assertEquals(true, $project->hasNote(1, -1));
        $this->assertEquals(true, $project->hasNote(1, 0));
        $this->assertEquals(false, $project->hasNote(1, 1));
        $this->assertEquals(false, $project->hasNote(0, 1));
        $this->assertEquals(false, $project->hasNote(-1, 1));
    }

    public function testGetProjectSidesValue1(): void
    {
        $project = new Project(1);
        $this->assertEquals(false, $project->hasNote(-1, 0));
        $this->assertEquals(true, $project->hasNote(-1, -1));
        $this->assertEquals(true, $project->hasNote(0, -1));
        $this->assertEquals(true, $project->hasNote(1, -1));
        $this->assertEquals(false, $project->hasNote(1, 0));
        $this->assertEquals(false, $project->hasNote(1, 1));
        $this->assertEquals(false, $project->hasNote(0, 1));
        $this->assertEquals(false, $project->hasNote(-1, 1));
    }

    public function testGetProjectSidesValue2(): void
    {
        $project = new Project(2);
        $this->assertEquals(true, $project->hasNote(-1, 0));
        $this->assertEquals(true, $project->hasNote(-1, -1));
        $this->assertEquals(true, $project->hasNote(0, -1));
        $this->assertEquals(false, $project->hasNote(1, -1));
        $this->assertEquals(false, $project->hasNote(1, 0));
        $this->assertEquals(false, $project->hasNote(1, 1));
        $this->assertEquals(false, $project->hasNote(0, 1));
        $this->assertEquals(false, $project->hasNote(-1, 1));
    }

    public function testGetProjectSidesValue3(): void
    {
        $project = new Project(3);
        $this->assertEquals(false, $project->hasNote(-1, 0));
        $this->assertEquals(true, $project->hasNote(-1, -1));
        $this->assertEquals(true, $project->hasNote(0, -1));
        $this->assertEquals(false, $project->hasNote(1, -1));
        $this->assertEquals(false, $project->hasNote(1, 0));
        $this->assertEquals(false, $project->hasNote(1, 1));
        $this->assertEquals(false, $project->hasNote(0, 1));
        $this->assertEquals(false, $project->hasNote(-1, 1));
    }

    public function testGetProjectSidesValueMinus(): void
    {
        $project = new Project(-1);
        $this->assertEquals(true, $project->hasNote(-1, 0));
        $this->assertEquals(true, $project->hasNote(-1, -1));
        $this->assertEquals(true, $project->hasNote(0, -1));
        $this->assertEquals(true, $project->hasNote(1, -1));
        $this->assertEquals(true, $project->hasNote(1, 0));
        $this->assertEquals(true, $project->hasNote(1, 1));
        $this->assertEquals(true, $project->hasNote(0, 1));
        $this->assertEquals(true, $project->hasNote(-1, 1));
    }

    public function testGetStartingProjects(): void
    {
        $corp = new Corp(1);
        $projects = $corp->getStartingProjects();
        $this->assertEquals(25, count($projects));
    }

    public function testGetStartingProjectsCount(): void
    {
        $corp = new Corp(1);
        $projects = $corp->getStartingProjects();
        $counts = [];
        $counts[0] = 0;
        $counts[1] = 0;
        $counts[2] = 0;
        $counts[3] = 0;
        foreach($projects as $project){
            $counts[$project->getValue()] += 1;
        }
        $this->assertEquals(6, $counts[0]);
        $this->assertEquals(10, $counts[1]);
        $this->assertEquals(5, $counts[2]);
        $this->assertEquals(4, $counts[3]);
    }

    public function testGetOffice(): void
    {
        $corp = new Corp(1);
        $office = $corp->getOffice();
        $project = $office[0][0];
        $this->assertTrue($project != null);
        $this->assertEquals("review", $project->getType());
        $project = $office[1][0];
        $this->assertTrue($project == null);
        $project = $office[4][0];
        $this->assertTrue($project != null);
        $this->assertEquals("red", $project->getType());
        $project = $office[4][4];
        $this->assertTrue($project != null);
        $this->assertEquals("green", $project->getType());
        $project = $office[0][4];
        $this->assertTrue($project != null);
        $this->assertEquals("blue", $project->getType());
    }

    public function testPlaceProjectCard(): void
    {
        $corp = new Corp(1);
        $workingEmployee = $corp->getWorkingEmployee();
        $projects = $workingEmployee->getProjects();
        $project = $projects[0];
        $office = $corp->getOffice();
        $this->assertTrue($office[1][1] == null);
        $corp->placeProject(1, 1, $project);
        $office = $corp->getOffice();
        $this->assertTrue($office[1][1] != null);
        //$corp->drawOffice();
    }

    public function testGetProjectSidesRotate(): void
    {
        $project = new Project(3);
        $project->setRotation(0);
        $this->assertEquals(false, $project->hasNote(-1, 0));
        $this->assertEquals(true, $project->hasNote(-1, -1));
        $this->assertEquals(true, $project->hasNote(0, -1));
        $this->assertEquals(false, $project->hasNote(1, -1));
        $this->assertEquals(false, $project->hasNote(1, 0));
        $this->assertEquals(false, $project->hasNote(1, 1));
        $this->assertEquals(false, $project->hasNote(0, 1));
        $this->assertEquals(false, $project->hasNote(-1, 1));
        $project->setRotation(1);
        $this->assertEquals(false, $project->hasNote(-1, 0));
        $this->assertEquals(false, $project->hasNote(-1, -1));
        $this->assertEquals(false, $project->hasNote(0, -1));
        $this->assertEquals(true, $project->hasNote(1, -1));
        $this->assertEquals(true, $project->hasNote(1, 0));
        $this->assertEquals(false, $project->hasNote(1, 1));
        $this->assertEquals(false, $project->hasNote(0, 1));
        $this->assertEquals(false, $project->hasNote(-1, 1));
        $project->setRotation(2);
        $this->assertEquals(false, $project->hasNote(-1, 0));
        $this->assertEquals(false, $project->hasNote(-1, -1));
        $this->assertEquals(false, $project->hasNote(0, -1));
        $this->assertEquals(false, $project->hasNote(1, -1));
        $this->assertEquals(false, $project->hasNote(1, 0));
        $this->assertEquals(true, $project->hasNote(1, 1));
        $this->assertEquals(true, $project->hasNote(0, 1));
        $this->assertEquals(false, $project->hasNote(-1, 1));
        $project->setRotation(3);
        $this->assertEquals(true, $project->hasNote(-1, 0));
        $this->assertEquals(false, $project->hasNote(-1, -1));
        $this->assertEquals(false, $project->hasNote(0, -1));
        $this->assertEquals(false, $project->hasNote(1, -1));
        $this->assertEquals(false, $project->hasNote(1, 0));
        $this->assertEquals(false, $project->hasNote(1, 1));
        $this->assertEquals(false, $project->hasNote(0, 1));
        $this->assertEquals(true, $project->hasNote(-1, 1));
    }

    public function testMove(): void
    {
        $corp = new Corp(1);
        $workingEmployee = $corp->getWorkingEmployee();
        $projects = $workingEmployee->getProjects();
        $project = $projects[0];
        $office = $corp->getOffice();
        $corp->placeProject(1, 1, $project);
        $office = $corp->getOffice();
        $this->assertTrue($corp->canMove(0, 0, 1, 1));
        $this->assertTrue($corp->canMove(1, 1, 0, 0));
        $this->assertFalse($corp->canMove(0, 0, 0, 1));
        $this->assertFalse($corp->canMove(0, 0, 1, 0));
    }
    public function testMoveRotate(): void
    {
        $corp = new Corp(1);
        $workingEmployee = $corp->getWorkingEmployee();
        $projects = $workingEmployee->getProjects();
        $project = $projects[0];
        $office = $corp->getOffice();
        $corp->placeProject(1, 0, $project);
        $project->setRotation(3);
        $office = $corp->getOffice();
        $this->assertTrue($corp->canMove(0, 0, 1, 0));
        //$corp->drawOffice();
    }

    
}


