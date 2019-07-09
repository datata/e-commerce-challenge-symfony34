<?php

namespace ShopBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
     * @Route("/cart", name="index_shop")
     */

class CartController extends Controller
{
    /**
     * @Route("/", name="cart_shop")
     */
    public function indexAction()
    {
        return $this->render('@Shop/Default/cart.html.twig');
    }
}
