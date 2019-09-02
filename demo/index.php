<?php

namespace FixMind\Enum;

include '..\src\EnumCore.php';
include '..\src\Enum.php';


// COLLECTOIN DEFINITION
class Vertical extends Enum
{
	const TOP = 'TOP';
	const MIDDLE = 'MIDDLE';
	const BOTTOM = 'BOTTOM';
}

class Horizontal extends Enum
{
	const VALUE = ['LEFT', 'CENTER', 'RIGHT'];
}

// STRICT USAGE
class MyClass 
{
	public $vertical;
	public $horizontal;
	
	public function setVertical(Vertical $vertical)
	{
		$this->vertical = $vertical;
		echo "set vertical option: {$vertical}<br>";
	}
	
	public function setHorizontal(Horizontal $horizontal)
	{
		$this->horizontal = $horizontal;
		echo "set horizontal option: {$horizontal}<br>";
	}
	
}

// USAGE
try{

	
	$myClass = new MyClass();
	
	// set vertical option: TOP
	$myClass->setVertical(Vertical::TOP());
	
	// set horizontal option: RIGHT
	$myClass->setHorizontal(Horizontal::RIGHT());
	
	// vertical option is TOP
	if ($myClass->vertical == Vertical::TOP())
	{
		echo "vertical option is TOP<br>";
	}
	
	// vertical option is still TOP
	if ($myClass->vertical->is(Vertical::TOP()) === true)
	{
		echo "vertical option is still TOP<br>";
	}
	
	// vertical option is not BOTTOM
	if ($myClass->vertical->is(Vertical::BOTTOM()) === false)
	{
		echo "vertical option is not BOTTOM<br>";
	}
	
	// vertical hasn't option CENTER, all 3 possibilities: TOP, MIDDLE, BOTTOM
	if (Vertical::isValid('CENTER') === false)
	{
		echo "vertical hasn't option CENTER, all " . Vertical::getOptionCount() . " possibilities: " . implode(', ', Vertical::getOptionList()) . "<br>";
	}
	
}
catch (\Exception $error)
{
	echo $error->getMessage();
}
