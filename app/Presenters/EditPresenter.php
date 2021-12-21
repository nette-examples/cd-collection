<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Model;
use Nette;
use Nette\Application\UI\Form;


final class EditPresenter extends Nette\Application\UI\Presenter
{
	use RequireLoggedUser;

	/** @var Model\AlbumRepository */
	private $albums;


	public function __construct(Model\AlbumRepository $albums)
	{
		$this->albums = $albums;
	}


	public function renderAdd(): void
	{
		$form = $this->getComponent('albumForm');
		$form['save']->caption = 'Add';
	}


	public function renderEdit(int $id): void
	{
		$form = $this->getComponent('albumForm');
		if (!$form->isSubmitted()) {
			$album = $this->albums->findById($id);
			if (!$album) {
				$this->error('Record not found');
			}
			$form->setDefaults($album);
		}
	}


	protected function createComponentAlbumForm(): Form
	{
		$form = new Form;
		$form->addText('artist', 'Artist:')
			->setRequired('Please enter an artist.');

		$form->addText('title', 'Title:')
			->setRequired('Please enter a title.');

		$form->addSubmit('save', 'Save')
			->setHtmlAttribute('class', 'default')
			->onClick[] = [$this, 'albumFormSucceeded'];

		$form->addSubmit('cancel', 'Cancel')
			->setValidationScope([])
			->onClick[] = [$this, 'formCancelled'];

		return $form;
	}


	public function albumFormSucceeded(array $data): void
	{
		$id = (int) $this->getParameter('id');
		if ($id) {
			$this->albums->findById($id)->update($data);
			$this->flashMessage('The album has been updated.');
		} else {
			$this->albums->insert($data);
			$this->flashMessage('The album has been added.');
		}
		$this->redirect('Dashboard:');
	}


	public function formCancelled(): void
	{
		$this->redirect('Dashboard:');
	}
}
