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
        $hashPassword = password_hash($password, PASSWORD_BCRYPT);
        $filter = filter_var($email, FILTER_VALIDATE_EMAIL);

        if ($filter === false) {
            return $this->render("register/incorrect-email.html.twig");
        } else {

            $em = $this->getDoctrine()->getManager();
            $userRepository = $em->getRepository(User::class);
            $validEmail = $userRepository->findOneBy(['email' => $email]);

            $user = new User();
            $user->setUsername($username);

            if (!$validEmail) {
                $user->setEmail($email);
                $user->setPassword($hashPassword);

                $em->persist($user);
                $em->flush();

                return $this->render("register/created-user.html.twig", ['User' => $user]);
            } else {
                return $this->render("register/email-exists.html.twig");
            }
        }
    }

}
