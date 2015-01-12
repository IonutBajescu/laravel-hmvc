<?php namespace Ionut\Modules;

use Ionut\Modules\Traits\Config;

class Module
{
	use Config;

	/**
	 * @var string
	 */
	protected $path;

	/**
	 * @var string
	 */
	protected $configFilename = 'module.json';

	/**
	 * @var array
	 */
	protected $config = [
		'enabled' => false
	];


	/**
	 * @param  string $path
	 * @throws \Exception
	 */
	public function __construct($path)
	{
		$this->path = $path;
		$this->updateConfig();
	}

	/**
	 * @return mixed
	 */
	public function getPath()
	{
		return $this->path;
	}


} 