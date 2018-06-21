<?php

class MigratorTest extends PHPUnit_Framework_TestCase
{
	private $migrator;
	private $fileVersionStorage;
	private $revisionMock;

	public function setUp()
	{
		file_put_contents(__DIR__.'/version.txt', 0);

		$this->fileVersionStorage = new \Hector\Migration\FileVersionStorage(__DIR__ . '/version.txt');
		$this->migrator = new \Hector\Migration\Migrator($this->fileVersionStorage);

		$this->revisionMock = $this->getMock(\Hector\Migration\Contract\RevisionInterface::class);

		$this->migrator->addRevision($this->revisionMock);
		$this->migrator->addRevision($this->revisionMock);
		$this->migrator->addRevision($this->revisionMock);
		$this->migrator->addRevision($this->revisionMock);
		$this->migrator->addRevision($this->revisionMock);
		$this->migrator->addRevision($this->revisionMock);
		$this->migrator->addRevision($this->revisionMock);
		$this->migrator->addRevision($this->revisionMock);
	}

	public function testVersionChanges()
	{
		$this->migratingShouldChangeVersionToTheLastVersion();
		$this->addingRevisionsShouldChangeVersionOnlyWhenMigrating();
		$this->downdatingShouldChangeVersionToPreviousVersion();
		$this->updatingShouldChangeVersionToNextVersion();
		$this->resettingShouldChangeVersionToZero();
		$this->rollingToASpecificVersionShouldChangeVersionToThatVersion();
		$this->itShouldNotBePossibleToExceedTheUpperVersionLimit();
		$this->itShouldNotBePossibleToExceedTheLowerVersionLimit();
	}

	public function migratingShouldChangeVersionToTheLastVersion()
	{
		$this->migrator->migrate();
		$this->assertEquals(8, $this->fileVersionStorage->get());
	}

	public function addingRevisionsShouldChangeVersionOnlyWhenMigrating()
	{
		// Add one more revision
		$this->migrator->addRevision($this->revisionMock);
		$this->migrator->migrate();

		// Make sure the version got updated
		$this->assertEquals(9, $this->fileVersionStorage->get());

		// Add 3 more revisions
		$this->migrator->addRevision($this->revisionMock);
		$this->migrator->addRevision($this->revisionMock);
		$this->migrator->addRevision($this->revisionMock);

		// Make sure the version didn't change
		$this->assertEquals(9, $this->fileVersionStorage->get());

		// Migrate
		$this->migrator->migrate();

		// Make sure it did change now
		$this->assertEquals(12, $this->fileVersionStorage->get());
	}

	public function downdatingShouldChangeVersionToPreviousVersion()
	{
		$this->migrator->downdate();

		// Make sure the version got updated to the previous version
		$this->assertEquals(11, $this->fileVersionStorage->get());
	}

	public function updatingShouldChangeVersionToNextVersion()
	{
		$this->migrator->update();

		// Make sure the version got updated to the previous version
		$this->assertEquals(12, $this->fileVersionStorage->get());
	}

	public function resettingShouldChangeVersionToZero()
	{
		$this->migrator->reset();

		// Make sure the version got updated to the previous version
		$this->assertEquals(0, $this->fileVersionStorage->get());
	}

	public function rollingToASpecificVersionShouldChangeVersionToThatVersion()
	{
		$this->migrator->rollTo(5);
		$this->assertEquals(5, $this->fileVersionStorage->get());

		$this->migrator->rollTo(2);
		$this->assertEquals(2, $this->fileVersionStorage->get());
	}

	public function itShouldNotBePossibleToExceedTheUpperVersionLimit()
	{
		$this->migrator->migrate();
		$this->assertEquals(12, $this->fileVersionStorage->get());

		$this->migrator->rollTo(13);
		$this->assertEquals(12, $this->fileVersionStorage->get());

		$this->migrator->update();
		$this->assertEquals(12, $this->fileVersionStorage->get());

		$this->migrator->update();
		$this->migrator->update();
		$this->assertEquals(12, $this->fileVersionStorage->get());
	}


	public function itShouldNotBePossibleToExceedTheLowerVersionLimit()
	{
		$this->migrator->reset();
		$this->assertEquals(0, $this->fileVersionStorage->get());

		$this->migrator->rollTo(-1);
		$this->assertEquals(0, $this->fileVersionStorage->get());

		$this->migrator->downdate();
		$this->assertEquals(0, $this->fileVersionStorage->get());

		$this->migrator->downdate();
		$this->migrator->downdate();
		$this->assertEquals(0, $this->fileVersionStorage->get());
	}
}