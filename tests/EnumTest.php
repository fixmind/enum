<?php

/**
 * Enum 1.0.1
 * Copyright 2019 Michal Barcikowski
 * Available via the MIT or new BSD @license.
 * Project: https://github.com/fixmind/enum/
 */

namespace FixMind\Tests\Enum;

class EnumTest extends \PHPUnit\Framework\TestCase
{
	/**
	 * enum as string
	 */
	public function testString()
	{
		$enum = EnumExample::LOW();
		$this->assertTrue($enum == 'LOW');
	}
	
	/**
	 * enum as object
	 */
	public function testObject()
	{
		$enum = EnumExample::LOW();
		$this->assertTrue(is_object($enum));
	}
	
	/**
	 * is()
	 */
	public function testCompare()
	{
		$enum = EnumExample::LOW();
		$this->assertTrue($enum->is(EnumExample::LOW()));
	}
	
	/**
	 * is()
	 */
	public function testCompare2()
	{
		$enum = EnumExample::LOW();
		$this->assertTrue($enum->is(new EnumExample(EnumExample::LOW)));
	}
	
	/**
	 * invalid value Exception
	 */
	public function testInvalidValue()
	{
		$this->expectExceptionMessage('Unrecognize value "COOL". Possible values [LOW, MEDIUM, FAST].');
		EnumExample::COOL();
	}
	
	/**
	 * invalid class Exception
	 */
	public function testInvalidCompareClass()
	{
		$this->expectExceptionCode(2);
		EnumExample::FAST()->is(EnumAnotherExample::COOL());
	}
	
	/**
	 * @dataProvider compareListProvider 
	 */
	public function testCompareList($compare1, $compare2, $success)
	{
		if ($success)
		{
			$this->assertTrue($compare1->is($compare2));
		}
		else
		{
			$this->assertNotTrue($compare1->is($compare2));
		}
	}
	
	public function compareListProvider()
	{
		return [
			
			[EnumExample::FAST(), new EnumExample(EnumExample::FAST), true],
			[EnumExample::LOW(), 'LOW', true],
			[EnumExample::MEDIUM(), EnumExample::MEDIUM, true],
			[EnumExample::MEDIUM(), EnumExample::LOW, false],
			
		];
	}

	/**
	 * getOptionList()
	 */
	public function testOptionList()
	{
		$this->assertTrue(count(EnumExample::getOptionList()) == 3);
	}
	
	
	/**
	 * isValid()
	 */
	public function testValidOption()
	{
		$this->assertTrue(EnumExample::isValid('LOW'));
		$this->assertNotTrue(EnumExample::isValid('EASY'));
	}
	
	
}

