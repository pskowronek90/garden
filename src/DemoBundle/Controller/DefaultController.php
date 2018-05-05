<?php

namespace DemoBundle\Controller;

use AppBundle\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DefaultController extends Controller
{
    /**
     * @Route("/demo", name="demo")
     */
    public function indexAction()
    {
        return $this->render('demo/demo.html.twig');
    }

    /**
     * @Route("/admin", name="admin")
     */
    public function adminAction()
    {
        return $this->render('admin/dashboard.html.twig');
    }

    /**
     * @Route("/tasks", name="tasks", methods={"GET"})
     */
    public function tasksAction()
    {
        return $this->render('admin/tasks.html.twig');
    }

    /**
     * @Route("/homepage", name="panel-login", methods={"POST"})
     */
    public function loginAction(Request $request)
    {
        $login = $request->get('login-panel');
        $password = $request->get('password-panel');

        $passVerify = password_verify($password, PASSWORD_DEFAULT);

        $em = $this->getDoctrine()->getManager();
        $userRepository = $em->getRepository(User::class);

        $validLogin = $userRepository->findOneBy(['login' => $login, 'password' => $passVerify]);

        if (!$validLogin) {
            throw new NotFoundHttpException();
        } else {
            $this->render("admin/dashboard.html.twig");
        }

    }



}
