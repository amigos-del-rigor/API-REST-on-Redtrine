<?php

namespace ADR\RESTBundle\Tests\Service;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;


class HydratorTest extends WebTestCase
{
    public function setUp()
    {

    }

    public function testBasicHydration()
    {
        $fakeEntity = new FakeEntity();
        $serializedObj = serialize($fakeEntity);
        $this->assertTrue(is_string($serializedObj));

        $originalObj = unserialize($serializedObj);
        $this->assertInstanceOf('ADR\RESTBundle\Tests\Service\FakeEntity', $originalObj);

        $this->assertTrue(method_exists($originalObj, 'test'));

    }

}

Class FakeEntity
{
    protected $attribute = 1;
    protected $method = 'GET';

    public function test()
    {

    }
}