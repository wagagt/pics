<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class CleanDB extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'clean:db';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Cleans deprecated tokens and cache keys.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
        $now = gmdate('Y-m-d H:i:s',time());

        $affectedToken= Token::where('expires', '<', $now)->delete();
		$this->info("Deleted {$affectedToken} tokens that expired before {$now} UTC");

        $affectedCache = SearchCache::where('expiration', '<', $now)->delete();
		$this->info("Deleted {$affectedCache} cache entries that expired before {$now} UTC");
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
			// array('example', InputArgument::REQUIRED, 'An example argument.'),
		);
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
			// array('example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null),
		);
	}

}
