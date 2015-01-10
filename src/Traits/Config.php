<?php namespace Ionut\Modules\Traits;

use ArrayObject;
use Exception;

trait Config {

	/**
	 * @var string
	 */
	protected $path;

	/**
	 * @var string
	 */
	protected $configFilename = 'config.json';

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
			$this->config = new ArrayObject([
				'enabled' => true
			]);

			$file = $this->path . '/'.$this->configFilename;
			if (file_exists($file)) {
				$json = json_decode(file_get_contents($file));
				if( ! $json){
					throw new Exception("Your config $file cannot be correctly json decode.");
				}
				$this->config = $this->mergeConfig($this->config, new ArrayObject($json));
			}
		}

		return $this->config;
	}

	/**
	 * @param  ArrayObject  $default
	 * @param  ArrayObject  $config
	 * @return mixed
	 */
	public function mergeConfig($default, $config)
	{
		foreach($config as $k => $v){
			$default[$k] = $v;
		}

		return $default;
	}
} 