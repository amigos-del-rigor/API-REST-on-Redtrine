<?php
Namespace ADR\RESTBundle\Services;

use Redtrine\Structure\Set;

class Redtrine
{
    protected $redis;

    public function __construct($redis)
    {
        $this->redis = $redis;
    }

    public function getRedisInstance()
    {
        return $this->redis;
    }

    public function test()
    {
        $this->set = new Set('theNameOfTheSet');
        $this->set->setClient($this->redis);
        ladybug_dump($this->set);
    }
}