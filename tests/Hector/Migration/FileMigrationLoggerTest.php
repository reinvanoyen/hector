<?php

class FileMigrationLoggerTest extends PHPUnit_Framework_TestCase
{
    private $migrator;
    private $fileVersionStorage;
    private $fileMigrationLogger;
    private $revisionMock;

    public function setUp()
    {
        file_put_contents(__DIR__ . '/version.txt', 0);
        file_put_contents(__DIR__ . '/migration-log.txt', '');

        $fs = new \Hector\Fs\LocalFilesystem();

        $this->fileVersionStorage = new \Hector\Migration\FileVersionStorage($fs, __DIR__ . '/version.txt');
        $this->fileMigrationLogger = new \Hector\Migration\FileMigrationLogger($fs, __DIR__ . '/migration-log.txt');

        $this->migrator = new \Hector\Migration\Migrator($this->fileVersionStorage, $this->fileMigrationLogger);

        $this->revisionMock = $this->getMock(\Hector\Migration\Contract\RevisionInterface::class);

        $this->revisionMock
            ->method('describeUp')
            ->willReturn('Updated');

        $this->revisionMock
            ->method('describeDown')
            ->willReturn('Downdated');

        $this->migrator->addRevision($this->revisionMock);
        $this->migrator->addRevision($this->revisionMock);
    }

    public function testLogging()
    {
        $this->migrator->migrate();
        $this->assertEquals( file_get_contents( __DIR__ . '/migration-log.txt' ), 'Updated' . "\n" . 'Updated' . "\n" );

        $this->migrator->downdate();
        $this->assertEquals( file_get_contents( __DIR__ . '/migration-log.txt' ), 'Updated' . "\n" . 'Updated' . "\n" . 'Downdated' . "\n" );

        $this->migrator->reset();
        $this->assertEquals( file_get_contents( __DIR__ . '/migration-log.txt' ), 'Updated' . "\n" . 'Updated' . "\n" . 'Downdated' . "\n" . 'Downdated' . "\n" );

        $this->migrator->update();
        $this->assertEquals( file_get_contents( __DIR__ . '/migration-log.txt' ), 'Updated' . "\n" . 'Updated' . "\n" . 'Downdated' . "\n" . 'Downdated' . "\n" . 'Updated' . "\n" );
    }
}
