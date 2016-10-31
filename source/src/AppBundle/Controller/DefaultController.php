<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;





class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepaga")
     */
    public function indexAction(Request $request)
    {

        

        
        return new Response('OK!');
        
        
    }
}
