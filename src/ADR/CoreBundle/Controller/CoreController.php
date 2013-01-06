<?php

namespace ADR\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CoreController
{
    protected $templating;

    public function __construct($templating)
    {
        $this->templating = $templating;
    }

    public function indexAction(Request $request)
    {
        //echo "hello";
        //ladybug_dump($request->query->get('test'));

        $response =  $this->templating->renderResponse(
            'ADRCoreBundle:Default:index.html.twig', array('name' => 'test:'.time())
        );
        $response->setSharedMaxAge(30);

        return $response;
    }



}
