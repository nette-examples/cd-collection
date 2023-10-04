<?php

declare(strict_types=1);

namespace App;

use Nette\Bootstrap\Configurator;

/**
 * Bootstrap class initializes the system settings and application configuration.
 */
class Bootstrap
{
	public static function boot(): Configurator
	{
		$configurator = new Configurator;
		$appDir = dirname(__DIR__);

		// Uncomment the next line to enable debug mode for a specific IP
		//$configurator->setDebugMode('secret@23.75.345.200');

		// Enable Tracy debugger and set its log directory
		$configurator->enableTracy($appDir . '/log');

		// Set the temp directory for the application
		$configurator->setTempDirectory($appDir . '/temp');

		// Add configuration files
		$configurator->addConfig($appDir . '/config/common.neon');

		return $configurator;
	}
}
