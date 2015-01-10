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
	 * @var \ArrayObject
	 */
	protected $config;

	/**
	 * @var string
	 */
	protected $configFilename = 'module.json';


	/**
	 * @param  string $path
	 * @throws \Exception
	 */
	public function __construct($path)
	{
		$this->path = $path;
		$this->getConfig();
	}

	/**
	 * @return mixed
	 */
	public function getPath()
	{
		return $this->path;
	}


} 