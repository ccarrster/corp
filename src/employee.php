<?php declare(strict_types=1);
namespace corp;


final class Employee
{
	private $color;
	public function __construct(string $color)
	{
        $this->color = $color;
    }
    
    public function getColor() :string
    {
        return $this->color;
    }

    public function getWorkhours() :int
    {
        return 3;
    }

}