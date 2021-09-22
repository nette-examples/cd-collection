<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Model;
use Nette;


final class DashboardPresenter extends Nette\Application\UI\Presenter
{
	use RequireLoggedUser;

	/** @var Model\AlbumRepository */
	private $albums;


	public function __construct(Model\AlbumRepository $albums)
	{
		$this->albums = $albums;
	}


	public function renderDefault(): void
	{
		$this->template->albums = $this->albums->findAll()
			->order('artist')
			->order('title');
	}
}
