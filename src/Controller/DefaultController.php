<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     * 
     * @return Response
     */
    public function indexAction(Request $request)
    {
        $response = new Response();
        $yaml = file_get_contents('../musement.weather.api.yml');
        $response->setContent(($yaml !== false) ? $yaml : null);
        $response->headers->set('Content-Type', 'text/plain');
        
        return $response;
    }
        
}