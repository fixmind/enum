<?php

/**
 * Enum 1.0.1
 * Copyright 2019 Michal Barcikowski
 * Available via the MIT or new BSD @license.
 * Project: https://github.com/fixmind/enum/
 */

namespace FixMind\Enum;

class EnumCore
{
	static $enum = [];
	
	protected $class = null;
	
	protected $value = null;
	
	/**
	 * Create ENUM object
	 * @param String $value
	 * @return Enum
	 */
	public function __construct($value)
	{
		$this->class = self::mapEnumClass();
		if ($this->isValid($value) == true)
		{
			$this->value = $value;
		}
		else
		{
			throw new \Exception('Unrecognize value "' . $value . '". Possible values ['. implode(', ', self::$enum[$this->class]['options']) .'].', 1);
		}
	}

	/**
	 * Create ENUM object based on static call
	 * @param string $value - class name
	 * @param string $param - option value
	 * @return Enum
	 */
	public function __callstatic($value, $param)
	{		
		$class = self::mapEnumClass();
		return new $class($value);
	}

	/**
	 * Get value of ENUM option as string, when object was treated like string 
	 * @return String
	 */
	public function __toString()
	{
		return $this->getValue();
	}
	
	/**
	 * Get value of ENUM option as string, when object was treated like function
	 * @return String
	 */
	public function __invoke()
	{
		return $this->getValue();
	}

	/**
	 * Build Enumerable static Array of values and return class name 
	 * @return String
	 */
	protected static function mapEnumClass()
	{
		$className = get_called_class();
		
		if (array_key_exists($className, self::$enum) == false)
		{
			$classReflection = new \ReflectionClass($className);
			$classOptions = [];
			foreach(array_keys($classReflection->getConstants()) as $value)
			{
				if (is_array($classReflection->getConstant($value)) == true)
				{
					foreach($classReflection->getConstant($value) as $value)
					{
						$classOptions[$value] = (string) $value;
					}
				}
				else
				{
					$classOptions[$value] = (string) $value;
				}
			}
			self::$enum[$className] = [
				
				'name' => $className,
				'reflection' => $classReflection,
				'options' => $classOptions,
			
			];
		}
		
		return $className;
	}
}

