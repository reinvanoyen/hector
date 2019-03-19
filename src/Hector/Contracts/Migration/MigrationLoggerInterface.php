<?php

namespace Hector\Contracts\Migration;

interface MigrationLoggerInterface
{
    public function logUpdate(RevisionInterface $revision);
    public function logDowndate(RevisionInterface $revision);
}
