<?php

namespace ADR\RESTBundle\Tests\Service\Hasher;

use \Mockery;
use ADR\RESTBundle\Services\Hasher\ConsistentHashing;
use ADR\RESTBundle\Services\Storage\HandlerInterface;


class ConsistentHashingTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $shard0 = Mockery::mock('\ADR\RESTBundle\Services\Storage\Shard',
            array(
                'getIpAddress'      =>  '192.168.1.2',
                'getPort'           =>  '3679',
                'getDatabase'       =>  '0',
                'getNamespace'      =>  '0'
                )
            );

        $shard1 = Mockery::mock('\ADR\RESTBundle\Services\Storage\Shard',
            array(
                'getIpAddress'      =>  '192.168.1.3',
                'getPort'           =>  '3679',
                'getDatabase'       =>  '0',
                'getNamespace'      =>  '0'
                )
            );

        $shard2 = Mockery::mock('\ADR\RESTBundle\Services\Storage\Shard',
            array(
                'getIpAddress'      =>  '192.168.1.4',
                'getPort'           =>  '3679',
                'getDatabase'       =>  '0',
                'getNamespace'      =>  '0'
                )
            );

        $shard3 = Mockery::mock('\ADR\RESTBundle\Services\Storage\Shard',
            array(
                'getIpAddress'      =>  '192.168.1.5',
                'getPort'           =>  '3679',
                'getDatabase'       =>  '0',
                'getNamespace'      =>  '0'
                )
            );


        $handler = Mockery::mock(
            'StdClass, \ADR\RESTBundle\Services\Storage\HandlerInterface',
            array(
                'getNodes'   => array($shard0, $shard1, $shard2, $shard3) ,
                'getKeySpace'       => 32
                )
            );
        $this->object = new ConsistentHashing($handler);

    }



    public function testGetKeyNodes()
    {
        var_dump($this->object->getKeyNodes());
    }
}
