<?php

namespace Hector\Migration\Contract;

interface MigrationLoggerInterface
{
    public function logUpdate(RevisionInterface $revision): string;
    public function logDowndate(RevisionInterface $revision): string;
}
