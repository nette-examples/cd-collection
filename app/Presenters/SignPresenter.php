<?php

declare(strict_types=1);

namespace App\Presenters;

use Nette;
use Nette\Application\UI;


/**
 * Handles user sign-in and sign-out operations.
 */
final class SignPresenter extends Nette\Application\UI\Presenter
{
	#[Nette\Application\Attributes\Persistent]
	public string $backlink = '';


	/**
	 * Creates the sign-in form.
	 */
	protected function createComponentSignInForm(): UI\Form
	{
		$form = new UI\Form;
		$form->addText('username', 'Username:')
			->setRequired('Please enter your username.');

		$form->addPassword('password', 'Password:')
			->setRequired('Please enter your password.');

		$form->addSubmit('send', 'Sign in');

		$form->onSuccess[] = $this->signInFormSucceeded(...);
		return $form;
	}


	/**
	 * Validates the user credentials and logs them in if successful.
	 */
	private function signInFormSucceeded(UI\Form $form, \stdClass $data): void
	{
		try {
			$this->getUser()->login($data->username, $data->password);

		} catch (Nette\Security\AuthenticationException $e) {
			$form->addError($e->getMessage());
			return;
		}

		$this->restoreRequest($this->backlink);
		$this->redirect('Dashboard:');
	}


	/**
	 * Logs the user out and redirects to the sign-in page.
	 */
	public function actionOut(): void
	{
		$this->getUser()->logout();
		$this->flashMessage('You have been signed out.');
		$this->redirect('in');
	}
}
