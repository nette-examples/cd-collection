<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Model;
use Nette;
use Nette\Application\UI\Form;


final class DeletePresenter extends Nette\Application\UI\Presenter
{
	use RequireLoggedUser;

	public function __construct(
		private Model\AlbumRepository $albums,
	) {
	}


	public function renderDefault(int $id): void
	{
		$this->template->album = $this->albums->findById($id);
		if (!$this->template->album) {
			$this->error('Record not found');
		}
	}


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


	private function deleteFormSucceeded(): void
	{
		$id = (int) $this->getParameter('id');
		$this->albums->findById($id)
			->delete();
		$this->flashMessage('Album has been deleted.');
		$this->redirect('Dashboard:');
	}


	private function formCancelled(): void
	{
		$this->redirect('Dashboard:');
	}
}
