<?php
Namespace ADR\RESTBundle\Services\Hasher;

use ADR\RESTBundle\Services\Storage\HandlerInterface;

class StaticHasher implements HashingInterface
{
    protected $nodes;
    protected $keySpace;

    public function __construct(HandlerInterface $storageHandler)
    {
        $this->nodes = $storageHandler->getNumberOfNodes();
        $this->keySpace = pow(2,$storageHandler->getKeySpace());
    }

    public function getNode($key)
    {
        return abs($key % $this->nodes);
    }

    public function getNewKey()
    {
        return mt_rand(0, $this->keySpace);
    }
}