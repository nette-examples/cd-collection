<?php

declare(strict_types=1);

namespace App\Model;

use Nette;
use Nette\Security;


/**
 * Users authenticator.
 */
class Authenticator implements Security\Authenticator
{
	public function __construct(
		private Nette\Database\Explorer $database,
		private Security\Passwords $passwords,
	) {
	}


	/**
	 * Performs an authentication.
	 * @throws Nette\Security\AuthenticationException
	 */
	public function authenticate(string $username, string $password): Security\SimpleIdentity
	{
		$row = $this->database->table('users')->where('username', $username)->fetch();

		if (!$row) {
			throw new Security\AuthenticationException('The username is incorrect.', self::IDENTITY_NOT_FOUND);

		} elseif (!$this->passwords->verify($password, $row->password)) {
			throw new Security\AuthenticationException('The password is incorrect.', self::INVALID_CREDENTIAL);
		}

		$arr = $row->toArray();
		unset($arr['password']);
		return new Security\SimpleIdentity($row->id, null, $arr);
	}
}
