<?php

declare(strict_types=1);

namespace App\Core;

use Nette;
use Nette\Application\Routers\Route;
use Nette\Application\Routers\RouteList;
use Nette\Application\Routers\SimpleRouter;
use Nette\Routing\Router;


/**
 * Factory class to create the application's router.
 */
final class RouterFactory
{
	use Nette\StaticClass;

	public static function createRouter(): Router
	{
		// Detect if mod_rewrite is enabled and set up routing accordingly
		if (function_exists('apache_get_modules') && in_array('mod_rewrite', apache_get_modules(), true)) {
			$router = new RouteList;
			$router->addRoute('index.php', 'Dashboard:default', Route::ONE_WAY);
			$router->addRoute('<presenter>/<action>[/<id>]', 'Dashboard:default');
			return $router;
		}

		// Fallback to simple routing if mod_rewrite is not available.
		return new SimpleRouter('Dashboard:default');
	}
}
