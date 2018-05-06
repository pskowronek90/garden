<?php

namespace DemoBundle\Controller;

use DemoBundle\Entity\Plant;
use DemoBundle\Entity\Task;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class NavbarController extends Controller
{
    /**
     * @Route("/demo", name="demo")
     */
    public function indexAction()
    {
        return $this->render('demo/demo.html.twig');
    }

    /**
     * @Route("/admin", name="admin-get", methods={"GET"})
     */
    public function adminGetAction()
    {
        $activeTasks = $this->getDoctrine()->getRepository(Task::class)->findBy(['status' => 1, 'user' =>
            $this->getUser()->getId()]);
        $completedTasks = $this->getDoctrine()->getRepository(Task::class)->findBy(['status' => 0, 'user' =>
            $this->getUser()->getId()]);
        $plants = $this->getDoctrine()->getRepository(Plant::class)->findBy(['user' => $this->getUser()->getId()]);

        return $this->render('admin/dashboard.html.twig',
            ['activeTasks' => $activeTasks, 'completedTasks' => $completedTasks, 'plants' => $plants]);
    }

    /**
     * @Route("/admin", name="admin-post", methods={"POST"})
     */
    public function adminPostAction()
    {
        return $this->render('admin/dashboard.html.twig');
    }

    /**
     * @Route("/user", name="user", methods={"GET"})
     */
    public function userAction()
    {
        return $this->render('admin/user.html.twig');
    }

    /**
     * @Route("/tasks", name="tasks", methods={"GET"})
     */
    public function tasksAction()
    {
        $tasksRepository = $this->getDoctrine()->getRepository(Task::class);
        $tasks = $tasksRepository->findBy(['status' => 0, 'user' => $this->getUser()->getId()]);

        return $this->render('admin/tasks.html.twig', ['tasks' => $tasks]);
    }

    /**
     * @Route("/weather", name="weather", methods={"GET"})
     */
    public function weatherAction()
    {
        return $this->render('admin/weather.html.twig');
    }
}
