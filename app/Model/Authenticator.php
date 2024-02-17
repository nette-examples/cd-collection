<?php

declare(strict_types=1);

namespace App\Model;

use Nette;
use Nette\Security;


/**
 * Handles user authentication against the database.
 */
class Authenticator implements Security\Authenticator
{
	// Dependency injection of the Nette database explorer and password utility.
	public function __construct(
		private Nette\Database\Explorer $database,
		private Security\Passwords $passwords,
	) {
	}


	/**
	 * Validates the provided username and password.
	 * Throws exceptions for invalid credentials.
	 */
	public function authenticate(string $username, string $password): Security\SimpleIdentity
	{
		$row = $this->database->table('users')->where('username', $username)->fetch();

		if (!$row) {
			throw new Security\AuthenticationException('The username is incorrect.', self::IdentityNotFound);

		} elseif (!$this->passwords->verify($password, $row->password)) {
			throw new Security\AuthenticationException('The password is incorrect.', self::InvalidCredential);
		}

		$arr = $row->toArray();
		unset($arr['password']);
		return new Security\SimpleIdentity($row->id, null, $arr);
	}
}
