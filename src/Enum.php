<?php

/**
 * Enum 1.0.2
 * Copyright 2019 Michal Barcikowski
 * Available via the MIT or new BSD @license.
 * Project: https://github.com/fixmind/enum/
 */

namespace FixMind\Enum;

class Enum extends EnumCore
{
	/**
	 * Get avaialble option list
	 * @return Array
	 */	
	public static function getOptionList()
	{
		$class = self::mapEnumClass();
		return self::$enum[$class]['options'];
	}
	
	/**
	 * Get count of avaialble option
	 * @return Integer
	 */
	public static function getOptionCount()
	{
		$class = self::mapEnumClass();
		return count(self::$enum[$class]['options']);
	}

	/**
	 * Check if param $toCompare has the same enum value as self class 
	 * @param Enum $toCompare
	 * @return Boolean
	 */
	public function is($toCompare)
	{
		if (is_string($toCompare))
		{
			return $this->getValue() == $toCompare;
		}
		elseif ($this->getClassName() !== $toCompare->getClassName())
		{
			throw new \Exception("Wrong class collection was compared: {$this->getClassName()} &lt;=&gt; {$toCompare->getClassName()}", 2);
		}
		
		return $this->getValue() === $toCompare->getValue();
	}

	/**
	 * Check if value is on option list
	 * @param String $value
	 * @return Boolean
	 */
	public static function isValid($value)
	{
		$class = self::mapEnumClass();
		return in_array($value, self::$enum[$class]['options']);
	}

	/**
	 * Get class name
	 * @return String
	 */
	public function getClassName()
	{
		return $this->class;
	}
	
	/**
	 * Get value
	 * @return String
	 */
	public function getValue()
	{
		return self::$enum[$this->class]['options'][$this->value];
	}

	
}

