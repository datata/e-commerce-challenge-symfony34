<?php

namespace ShopBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use ShopBundle\Entity\User;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        



        return $this->render('@Shop/Default/index.html.twig');
    }

    /**
     * @Route("/register")
     */
    public function addUser()
    {
        $user = new User();
        $user->setName('Ruben');
        $user->setEmail('Ruben@danitarazona.dev');
        $user->setCreateAt(new \DateTime('now'));
        $user->setUpdateAt(new \DateTime('now'));


        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();

        return new Response("Usuario creado" . $user->getId());
    }

}
