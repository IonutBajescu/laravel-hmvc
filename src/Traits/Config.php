<?php namespace Ionut\Modules\Traits;

use ArrayObject;
use Exception;

/**
 * @property string $configFilename
 */
trait Config {

	/**
	 * @var string
	 */
	protected $path;

	/**
	 * @var ArrayObject
	 */
	protected $config;

	/**
	 * @param  string  $key
	 * @return mixed
	 * @throws Exception
	 */
	public function config($key)
	{
		return data_get($this->getConfig(), $key);
	}

	/**
	 * @return ArrayObject
	 * @throws Exception
	 */
	public function getConfig()
	{

		if( ! $this->config){
			$this->updateConfig();
		}

		return $this->config;
	}

	/**
	 * @param  array|ArrayObject  $default
	 * @param  array|ArrayObject  $config
	 * @return ArrayObject
	 */
	public function mergeConfig($default, $config)
	{
		foreach($config as $k => $v){
			$default[$k] = $v;
		}

		return new ArrayObject($default);
	}

	public function updateConfig()
	{
		$file = $this->path . '/' . $this->configFilename;
		if (file_exists($file)) {
			$json = json_decode(file_get_contents($file));
			if (!$json) {
				throw new Exception("Your config $file cannot be correctly json decode.");
			}
			$this->config = $this->mergeConfig($this->config, $json);
		}
	}
} 