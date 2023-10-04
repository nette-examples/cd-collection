<?php

declare(strict_types=1);

namespace App\Model;

use Nette;

/**
 * Manages CRUD operations for albums in the database.
 */
class AlbumRepository
{
	// Dependency injection of the Nette database explorer.
	public function __construct(
		private Nette\Database\Explorer $database,
	) {
	}


	/**
	 * Retrieves all albums in the database.
	 */
	public function findAll(): Nette\Database\Table\Selection
	{
		return $this->database->table('albums');
	}


	/**
	 * Retrieves a specific album using its unique identifier.
	 */
	public function findById(int $id): Nette\Database\Table\ActiveRow
	{
		return $this->findAll()->get($id);
	}


	/**
	 * Adds a new album to the database.
	 */
	public function insert(iterable $values): void
	{
		$this->findAll()->insert($values);
	}
}
