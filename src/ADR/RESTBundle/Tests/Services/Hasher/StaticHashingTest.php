<?php

namespace ADR\RESTBundle\Tests\Service\Hasher;

use ADR\RESTBundle\Services\Hasher\StaticHasher;
use \Mockery;
use ADR\RESTBundle\Services\Storage\HandlerInterface;

class StaticHashingTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $handler = Mockery::mock(
            'StdClass, \ADR\RESTBundle\Services\Storage\HandlerInterface'
            ,array(
                'getNumberOfNodes'   => 4,
                'getKeySpace'       => 32
                )
            );
        $this->object = new StaticHasher($handler);

    }

    /**
     * @dataProvider getValues
     */
    public function testGetNodeFromStaticHash($value, $nodeId)
    {
        $this->assertEquals($this->object->getNode($value), $nodeId);
    }

    public function getValues()
    {
        return array(
            array(20, 0),
            array(21, 1),
            array(22, 2),
            array(23, 3),
            array(24, 0),
            );
    }

    public function testGetNewKeyResponseIsRandom()
    {
        $randomKey = $this->object->getNewKey();
        $this->assertInternalType('int', $randomKey);

        $newRanomKey = $this->object->getNewKey();
        $this->assertNotEquals($randomKey, $newRanomKey);
    }
}
