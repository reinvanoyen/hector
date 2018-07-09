<?php

namespace Hector\Console\Contract;

use Hector\Console\Input\Contract\InputInterface;
use Hector\Console\Output\Contract\OutputInterface;

interface KernelInterface
{
    public function handle(InputInterface $input, OutputInterface $output);
}