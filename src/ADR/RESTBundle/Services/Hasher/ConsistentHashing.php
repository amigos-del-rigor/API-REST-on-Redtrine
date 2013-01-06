<?php
Namespace ADR\RESTBundle\Services\Hasher;

use ADR\RESTBundle\Services\Storage\HandlerInterface;

class ConsistentHashing implements HashingInterface
{
    protected $nodes;
    protected $keySpace;
    protected $keyNodes;

    public function __construct(HandlerInterface $storageHandler)
    {
        $this->keySpace = pow(2, $storageHandler->getKeySpace());
        $this->keyNodes = $this->generateKeyNodes(
            $storageHandler->getNodes()
        );

    }

    public function getNode($key)
    {
        //found
    }

    public function getNewKey()
    {
        return mt_rand(0, $this->keySpace);
    }

    /**
     * [getKeyNodes description]
     * @param  array  $nodes shards
     * @return [type]        [description]
     */
    protected function generateKeyNodes(array $nodes)
    {

        if (count($nodes) == 0)
            throw new \Exception('no nodes found to generate key nodes!');

        $keyNodes = array();
        foreach ($nodes as $key => $shard) {

            $unHashedKey =  $shard->getIpAddress().':'.
                            $shard->getPort().':'.
                            $shard->getDatabase().':'.
                            $shard->getNamespace();

            $keyNodes[$key] = $this->getNewKey();
        }
        sort($keyNodes);

        return $keyNodes;
    }

    public function getKeyNodes()
    {
        return $this->keyNodes;
    }


}