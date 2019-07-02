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
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('AdminBundle:Product');
        
        
        $product = $repository->findAll();
        // dump($product);
        // die();


        return $this->render('@Shop/Default/index.html.twig',['products'=>$product]);
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

    /**
     * @Route("/{id}")
     */
    public function cardProduct($id)
    {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('AdminBundle:Product');
        
        $product = $repository->find($id);

        if(!$product) return new Response("No existe producto");
        
        return $this->render('@Shop/Default/cardProduct.html.twig',['products'=>$product]);
        
    }



}
