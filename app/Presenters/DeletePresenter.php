<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Model;
use Nette;
use Nette\Application\UI\Form;

/**
 * Handles the deletion of albums.
 */
final class DeletePresenter extends Nette\Application\UI\Presenter
{
	use RequireLoggedUser;

	// Dependency injection of the album repository.
	public function __construct(
		private Model\AlbumRepository $albums,
	) {
	}


	/**
	 * Display the delete confirmation page for a specific album.
	 */
	public function renderDefault(int $id): void
	{
		$this->template->album = $this->albums->findById($id);
		if (!$this->template->album) {
			$this->error('Record not found');
		}
	}


	/**
	 * Form for confirming album deletion.
	 */
	protected function createComponentDeleteForm(): Form
	{
		$form = new Form;
		$form->addSubmit('cancel', 'Cancel')
			->onClick[] = $this->formCancelled(...);

		$form->addSubmit('delete', 'Delete')
			->setHtmlAttribute('class', 'default')
			->onClick[] = $this->deleteFormSucceeded(...);

		return $form;
	}


	/**
	 * Executes album deletion upon form submission.
	 */
	private function deleteFormSucceeded(): void
	{
		$id = (int) $this->getParameter('id');
		$this->albums->findById($id)
			->delete();
		$this->flashMessage('Album has been deleted.');
		$this->redirect('Dashboard:');
	}


	/**
	 * Redirects to the dashboard if the deletion is cancelled.
	 */
	private function formCancelled(): void
	{
		$this->redirect('Dashboard:');
	}
}
