<?php

namespace Hector\Migration;

class Manager
{
	private $versionStore;

	private $isRetreived;

	private $revisions = [];
	private $maxVersion = 0;
	private $currentVersion = 0;

	public function __construct( VersionStoreInterface $versionStore )
	{
		$this->versionStore = $versionStore;
	}

	public function assertRetreived()
	{
		if( ! $this->isRetreived ) {
			$this->currentVersion = $this->versionStore->retreive();
			$this->isRetreived = true;
		}
	}

	public function addRevision(RevisionInterface $revision)
	{
		$this->revisions[] = $revision;
		$this->maxVersion++;
	}

	public function update()
	{
		$this->rollTo($this->maxVersion);
	}

	public function downdate()
	{
		$this->rollTo($this->currentVersion - 1);
	}

	public function reset()
	{
		$this->rollTo(0);
	}

	public function rollTo( int $version )
	{
		$this->assertRetreived();

		$version = max( min( $version, $this->maxVersion ), 0 );

		if( $this->isUpToDateWith( $version ) ) {
			return;
		}

		if( $this->currentVersion > $version ) {

			$this->getCurrentRevision()->down();
			$this->currentVersion = $this->currentVersion - 1;

		} else if( $this->currentVersion < $version ) {

			$nextVersion = $this->currentVersion + 1;
			$this->getRevisionByVersion( $nextVersion )->up();

			$this->currentVersion = $nextVersion;
		}

		if( ! $this->isUpToDateWith( $version ) ) {
			$this->rollTo( $version );
			return;
		}

		$this->versionStore->store($this->currentVersion);
	}

	public function getCurrentVersion() : int
	{
		return $this->currentVersion;
	}

	private function isUpToDateWith( int $version ) : bool
	{
		return ( $this->currentVersion === $version );
	}

	private function isUpToDate() : bool
	{
		return $this->isUpToDateWith( $this->maxVersion );
	}

	private function getRevisionByVersion( int $version ) : ?RevisionInterface
	{
		if( isset( $this->revisions[ $version - 1 ] ) ) {
			return $this->revisions[ $version - 1 ];
		}

		return null;
	}

	private function getCurrentRevision() : RevisionInterface
	{
		return $this->getRevisionByVersion( $this->currentVersion );
	}
}