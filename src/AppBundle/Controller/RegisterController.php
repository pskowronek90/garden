<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class RegisterController extends Controller
{
    /**
     * @Route("/register", name="register-get" ,methods={"GET"})
     */
    public function getRegisterAction()
    {
        return $this->render('default/register.html.twig');
    }

    /**
     * @Route("/register", name="register-post" methods={"POST"})
     */
    public function registerVerifyAction(Request $request)
    {
        $email = $request->get('email');
        $password = $request->get('password');
        $confirm = $request->get('password_confirm');
        $agree = $request->get('agree');
        $filter = filter_var($email, FILTER_VALIDATE_EMAIL);

        if ($filter == false) {
            return new Response("Incorrect data");
        } elseif ($password != $confirm) {
            return new Response("Passwords must be the same");
        } elseif ($agree != true) {
            return new Response("You must acept the rules");
        } else {
            return new Response("User registered");
        }

    }
}
