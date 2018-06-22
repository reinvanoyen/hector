<?php

namespace Hector\Migration\Contract;

interface RevisionInterface
{
    public function up();
    public function down();
    public function describeUp(): string;
    public function describeDown(): string;
}
