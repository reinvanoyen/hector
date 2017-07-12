<?php

namespace Hector\Core\Db\Migration;

class Manager
{
	private $revisions;
	private $maxVersion;
	private $currentVersion;

	public function __construct( $revisions = [] )
	{
		$this->revisions = $revisions;
		$this->maxVersion = count( $revisions ) - 1;
	}

	public function update()
	{
		$requestedVersion = $this->currentVersion + 1;
		if( $requestedVersion <= $this->maxVersion ) {
			$this->rollTo( $requestedVersion );
		}
	}

	public function downdate()
	{
		$requestedVersion = $this->currentVersion - 1;
		if( $requestedVersion >= 0 ) {
			$this->rollTo( $requestedVersion );
		}
	}

	public function rollTo( Integer $version )
	{
		$this->currentVersion = $version;
	}
}