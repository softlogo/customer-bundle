<?php

namespace Softlogo\CustomerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('SoftlogoCustomerBundle:Default:index.html.twig', array('name' => $name));
    }
}
