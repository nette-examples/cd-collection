<?php

declare(strict_types=1);

namespace App\Presenters;


trait RequireLoggedUser
{
	public function injectRequireLoggedUser()
	{
		$this->onStartup[] = [$this, 'requireLoggedUser'];
	}


	public function requireLoggedUser()
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
