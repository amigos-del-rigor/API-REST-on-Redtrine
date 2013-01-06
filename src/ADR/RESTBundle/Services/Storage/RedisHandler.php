<?php
Namespace ADR\RESTBundle\Services\Storage;

class RedisHandler implements HandlerInterface
{
    /**
     *
     * @var array Shards
     */
    protected $nodes;

    public function __construct($keySpace)
    {
        $this->keySpace = $keySpace;
    }

    public function getKeySpace()
    {
        return $this->keySpace;
    }

    public function getNumberOfNodes()
    {
        return count($nodes);
    }


    public function addNode(Shard $shard)
    {
        $this->nodes[] = $shard;
    }
}