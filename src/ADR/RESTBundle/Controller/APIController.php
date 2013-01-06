<?php

namespace ADR\RESTBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;

class APIController
{
    protected $request;
    protected $redtrine;

    public function __construct(Request $request, $redtrine)
    {
        $this->request = $request;
        $this->redtrine = $redtrine;
    }

    protected function getRequest()
    {
        return $this->request;
    }

    public function getAction($apiVersion, $type, $name, $key='')
    {
        $this->redtrine->test();

        $response = array(
                'method'    =>  'GET',
                'version'   =>  $apiVersion,
                'type'      =>  $type,
                'name'      =>  $name,
                'key'       =>  $key
            );

        return new Response(json_encode($response));
    }

    public function postAction($apiVersion, $type, $name, $key='')
    {
        $parameters = $this->getRequest()->request->all();
        $response = array(
                'method'    =>  'POST',
                'version'   =>  $apiVersion,
                'type'      =>  $type,
                'name'      =>  $name,
                'key'       =>  $key,
                'parameters'=>  $parameters
            );

        return new Response(json_encode($response));
    }

    /**
     * Content Type must be application/x-www-form-urlencoded from Request
     */
    public function putAction($apiVersion, $type, $name, $key='')
    {
        $parameters = $this->getRequest()->request->all();

        $response = array(
                'method'    =>  'PUT',
                'version'   =>  $apiVersion,
                'type'      =>  $type,
                'name'      =>  $name,
                'key'       =>  $key,
                'parameters'=>  $parameters
            );

        return new Response(json_encode($response));
    }

    public function deleteAction($apiVersion, $type, $name, $key='')
    {
        $response = array(
                'method'    =>  'DELETE',
                'version'   =>  $apiVersion,
                'type'      =>  $type,
                'name'      =>  $name,
                'key'       =>  $key,
            );

        return new Response(json_encode($response));
    }

}
