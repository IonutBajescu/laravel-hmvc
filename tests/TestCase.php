<?php namespace Ionut\Modules\Tests;

use PHPUnit_Framework_TestCase;

class TestCase extends PHPUnit_Framework_TestCase {

	public function fixture($append)
	{
		return __DIR__.'/Fixtures/'.$append;
	}
} 