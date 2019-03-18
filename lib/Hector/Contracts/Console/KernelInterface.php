<?php

namespace Hector\Contracts\Console;

interface KernelInterface
{
    public function handle(InputInterface $input, OutputInterface $output);
}