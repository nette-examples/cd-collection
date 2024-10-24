<?php

declare(strict_types=1);

if (@!include __DIR__ . '/../vendor/autoload.php') {
	die('Install Nette using `composer update`');
}

// Boot the application, create a container, and run the application.
$bootstrap = new App\Bootstrap;
$container = $bootstrap->bootWebApplication();
$application = $container->getByType(Nette\Application\Application::class);
$application->run();
