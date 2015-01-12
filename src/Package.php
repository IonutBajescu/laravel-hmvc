<?php namespace Ionut\Modules;

use League\Flysystem\Filesystem;
use Illuminate\Container\Container;
use League\Flysystem\Adapter\Local as Adapter;

class Package extends Container {

	public $name    = 'The Modules Framework';
	public $version = 'v0.x';

	public function __construct()
	{
		$this['files']     = new Filesystem(new Adapter(dirname(__DIR__)));
		$this['modules']   = new Modules();
		$this[self::class] = $this;
	}
} 