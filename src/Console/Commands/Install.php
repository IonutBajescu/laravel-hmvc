<?php namespace Ionut\Modules\Console\Commands;

use Illuminate\Filesystem\Filesystem;
use Ionut\Modules\Console\Command;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ConfirmationQuestion;

class Install extends Command
{

	function __construct()
	{
		parent::__construct();
		$this->files = new Filesystem();
		$this->question = new QuestionHelper();
	}

	protected function configure()
	{
		$this->setName('install')
			->addArgument(
				'package',
				InputArgument::REQUIRED
			);
	}

	/**
	 * @todo Test if the modules are proper installed.
	 */
	protected function execute(InputInterface $input, OutputInterface $output)
	{
		$command = [
			$this->getComposerPath(),
			'require',
			$this->argument('package')
		];
		$command = implode(' ', $command);

		if ($this->isNotRootDirectory($input, $output)) {
			$this->createComposerConfig();
			$this->runCommand($command);

			$this->info($command);
		}
	}

	public function getComposerPath()
	{
		return 'composer';
	}

	public function isNotRootDirectory($input, $output)
	{
		if (!file_exists('vendor')) {
			$question = new ConfirmationQuestion("Are you sure that this it's your modules directory? (y/n)\n");
			if (!$this->question->ask($input, $output, $question)) {
				return false;
			}
		}

		return true;
	}

	public function createComposerConfig()
	{
		if ( ! $this->files->exists('composer.json')) {
			$this->getApplication()->package->files->copy('stubs/composer.json', realpath('composer.json'));
		}
	}

	private function runCommand($command)
	{
		$fp = popen($command . ' 2>&1', "r");
		while (!feof($fp)) {
			echo fread($fp, 1024);
			flush();
		}
		fclose($fp);
	}
}