<?php

namespace Hector\Migration;

class Migrator
{
	/**
	 * Handles storing the version
	 *
	 * @var VersionStorageInterface
	 */
	private $versionStorage;

	/**
	 * Array holding all revisions
	 *
	 * @var array RevisionInterface[]
	 */
	private $revisions = [];

	/**
	 * The maximum version number
	 *
	 * @var int
	 */
	private $maxVersion = 0;

	/**
	 * Migrator constructor.
	 *
	 * @param VersionStorageInterface $versionStore
	 */
	public function __construct(VersionStorageInterface $versionStorage)
	{
		$this->versionStorage = $versionStorage;
	}

	/**
	 * Adds a revision to the migrator
	 *
	 * @param RevisionInterface $revision
	 */
	public function addRevision(RevisionInterface $revision): void
	{
		$this->revisions[] = $revision;
		$this->maxVersion++;
	}

	/**
	 * Migrate all revisions
	 *
	 */
	public function migrate()
	{
		$this->rollTo($this->maxVersion);
	}

	/**
	 * Updates to the next revision
	 *
	 */
	public function update()
	{
		$nextVersionNumber = $this->getClampedVersion($this->versionStorage->get()+1);
		$nextRevision = $this->getRevisionByVersion($nextVersionNumber);

		if (! $nextRevision || $this->isUpToDateWith($nextVersionNumber)) {
			return;
		}

		$nextRevision->up();
		$this->versionStorage->store($nextVersionNumber);
	}

	/**
	 * Rolls back one version
	 *
	 */
	public function downdate()
	{
		$revision = $this->getCurrentRevision();

		if (! $revision) {
			return;
		}

		$revision->down();
		$version = $this->getClampedVersion($this->versionStorage->get()-1);
		$this->versionStorage->store($version);
	}

	/**
	 * Undoes all revisions
	 *
	 */
	public function reset()
	{
		$this->rollTo(0);
	}

	/**
	 * Rolls to a specific version
	 *
	 * @param int $version
	 */
	public function rollTo(int $version)
	{
		// Clamp the version number
		$version = max(min($version, $this->maxVersion), 0);

		// Check whether we are already up-to-date with the requested version
		if ($this->isUpToDateWith($version)) {
			return;
		}

		$currentVersion = $this->versionStorage->get();

		// Check whether we need to downdate
		if ($currentVersion > $version) {
			$this->downdate();
		}

		// Check whether we need to update
		if ($currentVersion < $version) {
			$this->update();
		}

		$this->rollTo($version);
		return;
	}

	/**
	 * Check if we're up-to-date with the current version
	 *
	 * @param int $version
	 * @return bool
	 */
	private function isUpToDateWith(int $version): bool
	{
		return ($this->versionStorage->get() === $version);
	}

	/**
	 * Check if we're up to date with the latest revision
	 *
	 * @return bool
	 */
	private function isUpToDate() : bool
	{
		return $this->isUpToDateWith($this->maxVersion);
	}

	private function getClampedVersion(int $version): int
	{
		return max(min($version, $this->maxVersion), 0);
	}

	/**
	 * Get a revision by a specific version number
	 *
	 * @param int $version
	 * @return RevisionInterface|null
	 */
	private function getRevisionByVersion(int $version): ?RevisionInterface
	{
		$version = $this->getClampedVersion($version);

		if (isset($this->revisions[$version-1])) {
			return $this->revisions[$version-1];
		}

		return null;
	}

	/**
	 * Gets the current revision
	 *
	 * @return RevisionInterface|null
	 */
	private function getCurrentRevision(): ?RevisionInterface
	{
		return $this->getRevisionByVersion($this->versionStorage->get());
	}
}