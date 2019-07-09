<?php

namespace ShopBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
* @Route("/user")
*/

class UserpanelController extends Controller
{
     /**
     * @Route("/userprofile/", name="user_profile")
     */
    public function PanelAction()
    {
        return $this->render('@Shop/Default/userpanel.html.twig');  
    }    


}
