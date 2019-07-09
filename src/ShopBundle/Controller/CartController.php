<?php

namespace ShopBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Symfony\Component\HttpFoundation\Response;

use ShopBundle\Entity\Cart;
use AdminBundle\AdminBundle;

/**
 * @Route("/cart", name="index_shop")
 */

class CartController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {   
        return $this->render('@Shop/Default/cart.html.twig');
    }

    /**
     * @Route("/addproduct/{id}/{user}", name="addcart")
     */
    public function addAction($id,$user)
    {
        $em = $this->getDoctrine()->getManager();
        $cart = $em->getRepository('ShopBundle:Cart');

        $cart = $cart->findOneBy(array('idproducto'=>$id, 'iduser'=>$user));
               
        if(!$cart)
        {
            $cart = new Cart();
            $cart->setIdproducto($id);
            $cart->setIduser($user);
            $cart->setQuantityproduct(1);
        }
        else{
            $cart->setQuantityproduct($cart->getQuantityproduct()+1);
        }

        $em->flush();
        $em->persist($cart);             

        return new Response("Listo!");

    }



}
