<?php

use Nette\Object,
	Nette\Security\AuthenticationException;


/**
 * Users authenticator.
 */
class UsersModel extends Object implements Nette\Security\IAuthenticator
{

	/**
	 * Performs an authentication
	 * @param  array
	 * @return IIdentity
	 * @throws AuthenticationException
	 */
	public function authenticate(array $credentials)
	{
		$username = strtolower($credentials[self::USERNAME]);
		$password = strtolower($credentials[self::PASSWORD]);

		$row = dibi::select('*')->from('users')->where('username=%s', $username)->fetch();

		if (!$row) {
			throw new AuthenticationException("User '$username' not found.", self::IDENTITY_NOT_FOUND);
		}

		if ($row->password !== $password) {
			throw new AuthenticationException("Invalid password.", self::INVALID_CREDENTIAL);
		}

		unset($row->password);
		return new Nette\Security\Identity($row->id, NULL, $row);
	}

}
