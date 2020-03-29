<?php

namespace BackendBundle\Controller;

use BackendBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
class DefaultController extends Controller
{

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        return $this->render('@Backend/Default/index.html.twig');
    }

    public function confirmAction(Request $request)
    {
          if($request->isMethod('POST')) {
              $maValeur = $request->request->get("email");
              $pass = $this->getDoctrine()->getRepository('BackendBundle:User')->findPassByString($maValeur);
              foreach($pass as $p)
              {
              $message = \Swift_Message::newInstance()
                  ->setSubject('password sdfv')
                  ->setFrom('kalboussihazem12@gmail.com')
                  ->setTo($maValeur)
                  ->setBody(
                      "Your password is ".$p->getPassword()." et selivré dans 4 jours ouvrables");
              $this->get('mailer')->send($message);}
            return $this->redirectToRoute('changerpass');
          }

        return $this->render('@Backend/Default/setEmail.html.twig');
    }
    public function updateAction(Request $request)
    {
        return $this->render('@Backend/Default/update.html.twig');
    }
}