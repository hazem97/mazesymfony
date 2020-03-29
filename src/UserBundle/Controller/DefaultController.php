<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {

        $staffs =$this->getDoctrine()->getRepository('BackendBundle:Staff')->findAll();
        return $this->render('@User/Admin/base2.html.twig', array(
            'staffs' => $staffs,
        ));
    }
}
