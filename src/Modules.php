<?php namespace Ionut\Modules;

use Illuminate\Filesystem\ClassFinder;
use Ionut\Modules\Traits\Config;
use Symfony\Component\Finder\Finder;

class Modules {
	use Config;

	/**
	 * @var string
	 */
	protected $path;

	/**
	 * @var string
	 */
	protected $configFilename = 'modules.json';


	/**
	 * @param  string  $path
	 * @throws \Exception
	 */
	public function __construct($path)
	{
		$this->path = $path;
		$this->collection = new ModulesCollection();
		$this->getConfig();
	}

	/**
	 * @param  string  $path
	 * @return self
	 */
	static public function bootstrapIfExists($path)
	{
		return (new static($path))->bootstrapModules();
	}

	/**
	 * @return self
	 */
	public function bootstrapModules()
	{
		foreach(Finder::create()->in($this->path)->directories()->depth(0) as $module){
			$this->collection->push(new Module($module->getPathName()));
		}

		return $this;
	}

	/**
	 * @return self
	 */
	public function getClasses()
	{
		$finder = new ClassFinder();

		$justEnabled = function(Module $module) use($finder){
			return $finder->findClasses($module->getPath());
		};
		$classes = $this->getEnabledModules()->map($justEnabled)->flatten();

		return $classes;
	}

	/**
	 * @return self
	 */
	public function getEnabledModules()
	{
		return $this->collection->filter(function(Module $module){
			return $module->config('enabled');
		});
	}
} 