<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Model;
use Nette;


final class DashboardPresenter extends Nette\Application\UI\Presenter
{
	use RequireLoggedUser;

	public function __construct(
		private Model\AlbumRepository $albums,
	) {
	}


	public function renderDefault(): void
	{
		$this->template->albums = $this->albums->findAll()
			->order('artist')
			->order('title');
	}
}
