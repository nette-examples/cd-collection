<?php

declare(strict_types=1);

namespace App\Presentation\Dashboard;

use App\Model;
use App\Presentation\Accessory\RequireLoggedUser;
use Nette;

/**
 * Manages the dashboard view, displaying a list of albums.
 */
final class DashboardPresenter extends Nette\Application\UI\Presenter
{
	use RequireLoggedUser;

	// Dependency injection of the album repository.
	public function __construct(
		private Model\AlbumRepository $albums,
	) {
	}


	/**
	 * Default render method for the dashboard. Retrieves and displays albums.
	 */
	public function renderDefault(): void
	{
		$this->template->albums = $this->albums->findAll()
			->order('artist')
			->order('title');
	}
}
