<?php

namespace Hector\Migration\Contract;

interface MigrationLoggerInterface
{
    public function logUpdate(RevisionInterface $revision);
    public function logDowndate(RevisionInterface $revision);
}
