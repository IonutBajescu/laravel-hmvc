<?php namespace Ionut\Modules\Tests;

use Ionut\Modules\Modules;

class ModuleTest extends TestCase {

	public function testEnabledDisabled()
	{
		$collection = Modules::bootstrapIfExists($this->fixture('EnabledDisabled/Modules'));

		$activeClasses = $collection->getClasses();
		$this->assertCount(1, $activeClasses);
		$this->assertSame('Ionut\Modules\Tests\Fixutres\EnabledDisabled\EnabledModule\EnabledClass', $activeClasses[0]);
	}
} 