<?php

namespace ADR\RESTBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class APIController extends Controller
{
    /**
     * @Route("/v{apiVersion}/{entity}/{id}")
     * @Method({"GET"})
     */
    public function getAction($apiVersion, $entity, $id)
    {
        $response = array(
                'method'    =>  'GET',
                'version'   =>  $apiVersion,
                'entity'    =>  $entity,
                'id'        =>  $id
            );
        return new Response(json_encode($response));
    }

    /**
     * @Route("/v{apiVersion}/{entity}")
     * @Method({"POST"})
     */
    public function postAction($apiVersion, $entity)
    {
        $parameters = $this->getRequest()->request->all();
        $response = array(
                'method'    =>  'POST',
                'version'   =>  $apiVersion,
                'entity'    =>  $entity,
                'parameters'=>  $parameters
            );
        return new Response(json_encode($response));
    }

    /**
     * Content Type must be multipart/form-data-urlencoded from Request
     *
     * @Route("/v{apiVersion}/{entity}/{id}")
     * @Method({"PUT"})
     */
    public function putAction($apiVersion, $entity, $id)
    {
        $body = $this->getRequest()->getContent();
        $parameters = $this->getParametersFromPUTRequest($body);

        $response = array(
                'method'    =>  'PUT',
                'version'   =>  $apiVersion,
                'entity'    =>  $entity,
                'id'        =>  $id,
                'parameters'=>  $parameters
            );
        return new Response(json_encode($response));
    }

    /**
     * @Route("/v{apiVersion}/{entity}/{id}")
     * @Method({"DELETE"})
     */
    public function deleteAction($apiVersion, $entity, $id)
    {
        $response = array(
                'method'    =>  'DELETE',
                'version'   =>  $apiVersion,
                'entity'    =>  $entity,
                'id'        =>  $id
            );
        return new Response(json_encode($response));
    }

    /**
     * Parse Content Body From Response
     *
     * @param  [type] $body [description]
     * @return [type]       [description]
     */
    protected function getParametersFromPUTRequest($body)
    {
        $parameters = array();
        parse_str($body, $postvars);
        foreach($postvars as $field => $value) {
            $parameters[$field] = $value;
        }

        return $parameters;
    }
}
