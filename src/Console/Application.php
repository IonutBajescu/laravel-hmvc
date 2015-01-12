<?php namespace Ionut\Modules\Console;

use Ionut\Modules\Package;

class Application extends \Symfony\Component\Console\Application {

	/**
	 * @var Package
	 */
	public $package;

	public function __construct(Package $package)
	{
		$this->package = $package;

		parent::__construct($this->package->name, $this->package->version);
	}
}