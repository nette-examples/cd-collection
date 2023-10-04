<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Model;
use Nette;
use Nette\Application\UI\Form;

/**
 * Handles both the addition of new albums and editing existing ones.
 */
final class EditPresenter extends Nette\Application\UI\Presenter
{
	use RequireLoggedUser;

	// Dependency injection of the album repository.
	public function __construct(
		private Model\AlbumRepository $albums,
	) {
	}


	/**
	 * Prepares the form for adding a new album.
	 */
	public function renderAdd(): void
	{
		$form = $this->getComponent('albumForm');
		$form['save']->caption = 'Add';
	}


	/**
	 * Prepares the form for editing an existing album.
	 */
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


	/**
	 * Constructs the form used for adding/editing albums.
	 */
	protected function createComponentAlbumForm(): Form
	{
		$form = new Form;
		$form->addText('artist', 'Artist:')
			->setRequired('Please enter an artist.');

		$form->addText('title', 'Title:')
			->setRequired('Please enter a title.');

		$form->addSubmit('save', 'Save')
			->setHtmlAttribute('class', 'default')
			->onClick[] = $this->albumFormSucceeded(...);

		$form->addSubmit('cancel', 'Cancel')
			->setValidationScope([])
			->onClick[] = $this->formCancelled(...);

		return $form;
	}


	/**
	 * Handles form submission for album addition/editing.
	 */
	private function albumFormSucceeded(array $data): void
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


	/**
	 * Redirects to the dashboard if the addition/editing is cancelled.
	 */
	private function formCancelled(): void
	{
		$this->redirect('Dashboard:');
	}
}
