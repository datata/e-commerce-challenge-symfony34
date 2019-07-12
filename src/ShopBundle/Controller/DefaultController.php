<?php

namespace ShopBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


use Symfony\Component\HttpFoundation\Response;


class DefaultController extends Controller
{
    /**
     * @Route("/", name="index_shop")
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

    /**
     * @Route("genre/{genre}")
     */
    public function genreProduct($genre)
    {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('AdminBundle:Product');


        
        $product = $repository->findBy(array('genre' => $genre));

        if(!$product) return new Response("No existe producto");
        
        return $this->render('@Shop/Default/index.html.twig',['products'=>$product]);
        
    }



}
