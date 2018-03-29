<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\User;

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
     * @Route("/register", name="register-post", methods={"POST"})
     */
    public function registerVerifyAction(Request $request)
    {
        $username = $request->get('username');
        $email = $request->get('email');
        $password = $request->get('password');
        $hashPassword = password_hash($password, PASSWORD_DEFAULT);
        $filter = filter_var($email, FILTER_VALIDATE_EMAIL);

        if ($filter === false) {
            return $this->render("register/incorrect-email.html.twig");
        } else {

            $user = new User();
            $user->setUsername($username);
            $user->setEmail($email);

            if ($user->getEmail($email)) {
                return $this->render("register/email-exists.html.twig");
            } else {
                $user->setPassword($hashPassword);

                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();

                return $this->render("register/created-user.html.twig", ['User' => $user]);
            }
        }
    }

}
