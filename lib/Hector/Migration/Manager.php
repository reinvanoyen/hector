<?php

namespace Hector\Migration;

class Manager
{
	private $retreive;
	private $store;

	private $isRetreived;

	private $revisions = [];
	private $maxVersion = -1;
	private $currentVersion = -1;

	public function retreiveVersion( $retreive )
	{
		$this->retreive = $retreive;
	}

	public function storeVersion( $store )
	{
		$this->store = $store;
	}

	public function assertRetreiveAndStore()
	{
		if( $this->retreive && $this->store ) {
			if( ! $this->isRetreived ) {
				$this->currentVersion = ($this->retreive)();
				$this->isRetreived = true;
			}
			return;
		}

		throw new \Exception( 'Retreive and store should be set first' );
	}

	public function addRevision( RevisionInterface $revision )
	{
		$this->revisions[] = $revision;
		$this->maxVersion++;
	}

	public function update()
	{
		$this->rollTo( $this->maxVersion );
	}

	public function downdate()
	{
		$this->rollTo( $this->currentVersion - 1 );
	}

	public function rollTo( int $version )
	{
		$this->assertRetreiveAndStore();

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

		($this->store)($this->currentVersion);
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

	private function getRevisionByVersion( int $version ) : RevisionInterface
	{
		if( isset( $this->revisions[ $version ] ) ) {
			return $this->revisions[ $version ];
		}
	}

	private function getCurrentRevision() : RevisionInterface
	{
		return $this->getRevisionByVersion( $this->currentVersion );
	}
}