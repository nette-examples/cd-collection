<?php

declare(strict_types=1);

namespace App;

use Nette\Bootstrap\Configurator;


class Bootstrap
{
	public static function boot(): Configurator
	{
		$configurator = new Configurator;
		$appDir = dirname(__DIR__);

		// Enable Tracy for error visualisation & logging
		//$configurator->setDebugMode('secret@23.75.345.200'); // enable for your remote IP
		$configurator->enableTracy($appDir . '/log');

		// Enable RobotLoader - this will load all classes automatically
		$configurator->setTempDirectory($appDir . '/temp');
		$configurator->createRobotLoader()
			->addDirectory(__DIR__)
			->register();

		// Create Dependency Injection container from config.neon file
		$configurator->addConfig($appDir . '/config/common.neon');

		return $configurator;
	}
}
