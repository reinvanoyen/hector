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

    /**
     * The session id
     *
     * @var int
     */
    private $id;

    /**
     * Data of the session
     *
     * @var array
     */
    private $data = [];

    /**
     * Stores if the session data has been loaded
     *
     * @var bool
     */
    private $loaded = false;

    /**
     * Stores if the session has already been saved
     *
     * @var bool
     */
    private $saved = true;

    /**
     * Session constructor.
     *
     * @param SessionHandlerInterface $handler
     * @param string $name
     */
    public function __construct(string $name, SessionHandlerInterface $handler)
    {
        $this->name = $name;
        $this->handler = $handler;
    }

    /**
     * Gets the session handler
     *
     * @return SessionHandlerInterface
     */
    public function getHandler(): SessionHandlerInterface
    {
        return $this->handler;
    }

    /**
     * Loads the data
     */
    private function loadData()
    {
        $this->data = unserialize($this->handler->read($this->getId()));
        $this->loaded = true;
    }

    /**
     * Gets the name of the session
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Gets the session id
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Sets the session id
     *
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Stores data for a given key
     *
     * @param $key
     * @param $data
     */
    public function set($key, $data)
    {
        if (! $this->loaded) {
            $this->loadData();
        }
        $this->data[$key] = $data;
        $this->saved = false;
    }

    /**
     * Gets data for a given key
     *
     * @param $key
     * @return mixed|null
     */
    public function get($key)
    {
        if (! $this->loaded) {
            $this->loadData();
        }
        return $this->data[$key] ?? null;
    }

    /**
     * Saves the data in the session (using our handler)
     */
    public function save()
    {
        if (! $this->saved) {
            $this->handler->write($this->getId(), serialize($this->data));
            $this->saved = true;
        }
    }
}