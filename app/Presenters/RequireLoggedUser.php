<?php

declare(strict_types=1);

namespace App\Presenters;


/**
 * Ensures the user is logged in to access certain pages.
 */
trait RequireLoggedUser
{
	// Registers the requirement for a logged user on startup.
	public function injectRequireLoggedUser()
	{
		$this->onStartup[] = $this->requireLoggedUser(...);
	}


	/**
	 * Redirects to the sign-in page if the user is not logged in.
	 */
	private function requireLoggedUser(): void
	{
		$user = $this->getUser();
		if (!$user->isLoggedIn()) {
			if ($user->getLogoutReason() === $user::LOGOUT_INACTIVITY) {
				$this->flashMessage('You have been signed out due to inactivity. Please sign in again.');
			}
			$this->redirect('Sign:in', ['backlink' => $this->storeRequest()]);
		}
	}
}
