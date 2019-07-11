<?php

namespace ShopBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Symfony\Component\HttpFoundation\Response;

use ShopBundle\Entity\Cart;



/**
 * @Route("/cart")
 */

class CartController extends Controller
{
    /**
     * @Route("/{user}", name="cart_user")
     */
    public function indexAction($user)
    {   
       try{
        
       $em = $this->getDoctrine()->getManager();
       $query = $em->createQuery('SELECT p.category AS categoria, p.price AS precio, c.quantityproduct AS cantidad, p.photo AS photo, p.id AS id
       FROM ShopBundle:Cart AS c, AdminBundle:Product AS p
       WHERE c.idproducto= p.id
       and c.iduser=:user')->setParameter('user', $user);

       $sunglasses= $query->getResult();       

       return $this->render('@Shop/Default/cart.html.twig',['sunglasses'=>$sunglasses, 'totalcompra'=>0, 'totalproductos'=>0, 'articulos'=>0]);
       }catch(Exception $e){
           return $e->getMessage();
       }     

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
        
        $em->persist($cart);             
        $em->flush();

        return $this->indexAction($user);        

    }

    /**
     * @Route("/delete/{user}/{id}", name="deletecart")
     */
    public function deleteAction($id,$user)
    {

        $em = $this->getDoctrine()->getManager();
        $cart = $em->getRepository('ShopBundle:Cart');

        $cart = $cart->findOneBy(array('idproducto'=>$id, 'iduser'=>$user));        

        $em->remove($cart);             
        $em->flush();

        return $this->indexAction($user);

    }

    /**
     * @Route("/deleteone/{user}/{id}", name="delete_one")
     */
    public function deleteoneAction($id,$user)
    {

        $em = $this->getDoctrine()->getManager();
        $cart = $em->getRepository('ShopBundle:Cart');

        $cart = $cart->findOneBy(array('idproducto'=>$id, 'iduser'=>$user));

        if($cart->getQuantityproduct()>1)
        {
            $cart->setQuantityproduct($cart->getQuantityproduct()-1); 
            $em->persist($cart);             
            $em->flush();   
            
        }else{
            $em->remove($cart);             
            $em->flush();
           
        }
        return $this->indexAction($user);

    }

    /**
     * @Route("/addone/{user}/{id}")
     */
    public function addOneAction($id,$user)
    {

        $em = $this->getDoctrine()->getManager();
        $cart = $em->getRepository('ShopBundle:Cart');

        $cart = $cart->findOneBy(array('idproducto'=>$id, 'iduser'=>$user));

        $cart->setQuantityproduct($cart->getQuantityproduct()+1); 
        $em->persist($cart);             
        $em->flush();        
         
        return $this->indexAction($user);

    }
  



}
