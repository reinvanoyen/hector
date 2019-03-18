<?php

namespace Hector\Console;

use Hector\Contracts\Console\KernelInterface;
use Hector\Contracts\Console\InputInterface;
use Hector\Contracts\Console\OutputInterface;

use Hector\Console\Command\Command;
use Hector\Console\Command\Signature;
use Hector\Core\Container\Container;

class Kernel extends Command implements KernelInterface
{
    /**
     * @var Container
     */
    private $app;

    /**
     * An array holding registered commands
     *
     * @var array
     */
    private $registeredCommands = [];

    /**
     * Kernel constructor.
     * @param Container $app
     */
    public function __construct(Container $app)
    {
        $this->app = $app;
    }

    /**
     * Handle the incoming input
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    public function handle(InputInterface $input, OutputInterface $output)
    {
        foreach ($this->registeredCommands as $command) {
            if (is_string($command)) {
                $this->getSignature()->addSubCommand($this->app->get($command));
                continue;
            }

            $this->getSignature()->addSubCommand($command);
        }

        $this->run($input, $output);
    }

    /**
     * Register a command
     *
     * @param $command
     */
    public function registerCommand($command)
    {
        $this->registeredCommands[] = $command;
    }

    /**
     * @param Signature $signature
     * @return Signature
     */
    protected function createSignature(Signature $signature): Signature
    {
        return $signature->setName('hector');
    }
}