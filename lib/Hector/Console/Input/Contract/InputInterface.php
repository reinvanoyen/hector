<?php

namespace Hector\Console\Input\Contract;

use Hector\Console\Command\Signature;

interface InputInterface
{
    public function setSignature(Signature $signature);
    public function getSignature(): Signature;

    public function getArguments();
    public function getArgument(string $name);

    public function hasArgument(string $name): bool;
    public function setArgument(string $name, $value);

    public function getOptions();
    public function getOption(string $name);
    public function setOption(string $name, $value = true);

    public function hasSubCommand(): bool;
    public function getSubCommand();
    public function setSubCommand(string $name);

    public function reset();
}