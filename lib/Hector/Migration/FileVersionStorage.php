<?php

namespace Hector\Migration;

class FileVersionStorage implements VersionStorageInterface
{
	/**
	 * Filename of the file that stores the version number
	 *
	 * @var string
	 */
	private $filename;

	/**
	 * FileVersionStorage constructor.
	 * @param $filename
	 */
	public function __construct(string $filename)
	{
		$this->filename = $filename;
	}

	/**
	 * Store the version to the file
	 *
	 * @param int $version
	 */
	public function store(int $version)
	{
		file_put_contents($this->filename, $version);
	}

	/**
	 * Get the version number from the file
	 *
	 * @return int
	 */
	public function get(): int
	{
		return (int) file_get_contents($this->filename);
	}
}