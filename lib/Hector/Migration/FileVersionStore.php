<?php

namespace Hector\Migration;

class FileVersionStore implements VersionStoreInterface
{
	private $filename;

	public function __construct( $filename )
	{
		$this->filename = $filename;
	}

	public function store( int $version )
	{
		file_put_contents( $this->filename, $version );
	}

	public function retreive() : int
	{
		return (int) file_get_contents( $this->filename );
	}
}