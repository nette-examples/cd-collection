<?php

declare(strict_types=1);

namespace App;

use Nette;
use Nette\Bootstrap\Configurator;

/**
 * Bootstrap class initializes the system settings and application configuration.
 */
class Bootstrap
{
	private Configurator $configurator;
	private string $rootDir;


	public function __construct()
	{
		$this->rootDir = dirname(__DIR__);
		$this->configurator = new Configurator;
		// Set the temp directory for the application
		$this->configurator->setTempDirectory($this->rootDir . '/temp');
	}


	public function bootWebApplication(): Nette\DI\Container
	{
		$this->initializeEnvironment();
		$this->setupContainer();
		return $this->configurator->createContainer();
	}


	public function initializeEnvironment(): void
	{
		// Uncomment the next line to enable debug mode for a specific IP
		// $this->configurator->setDebugMode('secret@23.75.345.200');

		// Enable Tracy debugger and set its log directory
		$this->configurator->enableTracy($this->rootDir . '/log');
	}


	private function setupContainer(): void
	{
		// Add configuration files
		$this->configurator->addConfig($this->rootDir . '/config/common.neon');
	}
}
