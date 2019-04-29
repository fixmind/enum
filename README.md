# Enum - missing type in PHP
Class organizes collections of constants. Gives the ability to keep code clear, transparent and strict. Like the SplEnum class, but much better.

# USAGE - two ways to define a collection
```php
class Vertical extends Enum
{
	const TOP = 'TOP';
	const MIDDLE = 'MIDDLE';
	const BOTTOM = 'BOTTOM';
}

// OR

class Horizontal extends Enum
{
	const VALUE = ['LEFT', 'CENTER', 'RIGHT'];
}
```
# 4 REASONS TO USE

### 1 REASON - use ENUM to extortion type of param method
```php
class MyClass
{
	public function __construct(Vertical $vertical)
	{
	}
}

new MyClass(Vertical::TOP());
```

### 2 USAGE - easy value compare
```php
if (Vertical::TOP() == 'TOP')
{
	if (Vertical::TOP()->is(Vertical::TOP))
	{
	}
}
```

### 3 USAGE - list of posibilitis
```php
foreach(Vertical::getOptionList() as $option)
{
	echo $option;
}
```

### 4 USAGE - check if option exists  
```php
if (Vertical::isValid('TOP'))
{
	echo 'TOP is a valid value of Vertical Enum';
}
if (Vertical::isValid('LEFT') == false)
{
	echo 'LEFT is not a valid value of Vertical Enum';
}
```
