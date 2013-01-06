<?php

namespace ADR\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        $redis = $this->container->get('snc_redis.default');
        var_dump($redis);
        $response = $this->render('ADRCoreBundle:Default:index.html.twig', array('name' => time()));
        $response->setSharedMaxAge(30);

        return $response;
    }

    public function blockAction()
    {
        $response = $this->render('ADRCoreBundle:Default:block.html.twig', array('time' => time()));
        $response->setSharedMaxAge(5);

        return $response;
    }
}
