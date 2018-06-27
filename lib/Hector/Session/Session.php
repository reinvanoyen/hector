<?php

namespace Hector\Session;

use SessionHandlerInterface;

class Session
{
    /**
     * Handles sessions
     *
     * @var SessionHandlerInterface
     */
    private $handler;

    /**
     * Name of the session
     *
     * @var string
     */
    private $name;

    private $id;

    public function __construct(SessionHandlerInterface $handler, string $name)
    {
        $this->name = $name;
        $this->handler = $handler;
    }

    /**
     * @return SessionHandlerInterface
     */
    public function getHandler(): SessionHandlerInterface
    {
        return $this->handler;
    }

    /**
     * @param SessionHandlerInterface $handler
     */
    public function setHandler(SessionHandlerInterface $handler)
    {
        $this->handler = $handler;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
}