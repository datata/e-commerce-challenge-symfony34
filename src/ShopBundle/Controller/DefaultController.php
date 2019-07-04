<?php

namespace ShopBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use AdminBundle\Entity\User;
use AdminBundle\Form\UserType;

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
     * @Route("/register")
     */
    public function addUser(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        // 1) build the form
        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            // 3) Encode the password (you could also do this via Doctrine listener)
            $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);

            // 4) save the User!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user

            return $this->redirectToRoute('index_shop');
        }

        return $this->render(
            '@Shop/Default/register.html.twig',
            ['form' => $form->createView()]
        );
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
