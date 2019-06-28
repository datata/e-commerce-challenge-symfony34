<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use AdminBundle\Entity\Category;
use AdminBundle\Entity\Brand;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/product")
 */

class ProductController extends Controller
{

    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->render('@Shop/Default/index.html.twig');
    }

    /**
     * @Route("/addbrand")
     */

    public function add()
    {
        $brand = new Brand();
        $brand->setBrand('Adidas');

        $em = $this->getDoctrine()->getManager();
        $em->persist($brand);
        $em->flush();

        return new Response("Marca creada " . $brand->getBrand());
    }

     /**
     * @Route("/addcategory")
     */

    public function addcategory()
    {
        $em = $this->getDoctrine()->getManager();

        $cat= $_POST['category'];           

        $category = new Category();
        $category->model = $cat;

        $em->persist($category);
        $em->flush();

        return new Response("Modelo creado " . $category->getModel());
    }




}
