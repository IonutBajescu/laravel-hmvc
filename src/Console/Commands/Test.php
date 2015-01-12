<?php namespace Ionut\Modules\Console\Commands;

use Ionut\Modules\Console\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Test extends Command {

	protected function configure()
	{
		$this->setName('test');
	}

	/**
	 * @todo Test if the modules are proper installed.
	 */
	protected function execute(InputInterface $input, OutputInterface $output)
	{
		$this->comment('Yep, this works!');
	}
}