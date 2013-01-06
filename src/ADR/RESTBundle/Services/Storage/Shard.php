<?php
Namespace ADR\RESTBundle\Services\Storage;

class Shard
{
    protected $ipAddress;
    protected $port;
    protected $database;
    protected $namespace;

    public function __construct($ipAddress, $port, $database, $namespace='')
    {
        $this->ipAddress = $ipAddress;
        $this->port = $port;
        $this->database = $database;
        $this->namespace = $namespace;
    }

    public function getIpAddress()
    {
        return $this->ipAddress;
    }

    public function getPort()
    {
        return $this->port;
    }

    public function getDatabase()
    {
        return $this->database;
    }

    public function getNamespace()
    {
        return $this->namespace;
    }
}