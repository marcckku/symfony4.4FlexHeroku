<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MyTestController extends AbstractController
{
    
     /**
     * @Route("/test", methods={"GET","HEAD"})
     */
    public function index()
    {
        return $this->render('mytest/test.html.twig', [
            'controller_name' => 'MyTestController',
        ]);
    }
}
