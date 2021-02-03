<?php declare(strict_types=1);
namespace corp;

use PHPUnit\Framework\TestCase;
use corp\Corp;

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

    /*
    $workingEmployee->spendHours("move", 1);
        $workingEmployee->spendHours("research", 1);
        $workingEmployee->spendHours("memo", 1);
        */
}
