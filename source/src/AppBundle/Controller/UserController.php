<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Users;

class UserController extends Controller
{
    /**
     * @Route("/profile", name="homepage")
     */
    public function indexAction(Request $request)
    {
        
        $this->getDoctrine()->getRepository("AppBundle:Users")->find(21);
        
        
        return $this->render('profile.html.twig', [
//            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
        ]);
    }
    
    /**
     * @Route("/login", name="login")
     */
    public function loginAction(Request $request)
    {
        
        $authenticationUtils = $this->get('security.authentication_utils');

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

//        dump($lastUsername);
//        dump($error);
//        dump($request);
//        die;
        
        return $this->render('login.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
        ));
    }
}
