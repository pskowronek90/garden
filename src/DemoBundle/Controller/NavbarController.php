<?php

namespace DemoBundle\Controller;

use DemoBundle\Entity\Comment;
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


        $activeTasks = $this->getDoctrine()->getRepository(Task::class)->findBy([
            'status' => 1,
            'user' => $this->getUser()->getId()
        ]);
        $completedTasks = $this->getDoctrine()->getRepository(Task::class)->findBy([
            'status' => 0,
            'user' => $this->getUser()->getId()
        ]);

        $comments = $this->getDoctrine()->getRepository(Comment::class)->findBy(['task' => $activeTasks]);
        $counter = count($comments);

        $plants = $this->getDoctrine()->getRepository(Plant::class)->findBy(['user' => $this->getUser()->getId()]);
        return $this->render('admin/dashboard.html.twig', [
                'activeTasks' => $activeTasks,
                'completedTasks' => $completedTasks,
                'plants' => $plants,
                'counter' => $counter
            ]);
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
     * @Route("/task", name="task", methods={"GET"})
     */
    public function tasksAction()
    {
        $tasksRepository = $this->getDoctrine()->getRepository(Task::class);
        $tasks = $tasksRepository->findBy(['user' => $this->getUser()->getId()]);

        return $this->render('admin/tasks.html.twig', ['tasks' => $tasks]);
    }

    /**
     * @Route("/weather", name="weather", methods={"GET"})
     */
    public function weatherAction()
    {
        return $this->render('admin/weather.html.twig');
    }

    /**
     * @Route("task/details/{id}", name="dashboard-details-get", methods={"GET"})
     */
    public function detailsAction($id)
    {
        $task = $this->getDoctrine()->getRepository(Task::class)->findOneBy(['id' => $id]);
        $comments = $this->getDoctrine()->getRepository(Comment::class)->findBy(['task' => $task]);

        return $this->render('admin/task/details.html.twig', ['task' => $task, 'comments' => $comments]);
    }

    /**
     * @Route("plant/details/{id}", name="plant-dashboard-details", methods={"GET"})
     */
    public function detailsPlantAction($id)
    {
        $plant = $this->getDoctrine()->getRepository(Plant::class)->findOneBy(['id' => $id]);
        return $this->render('admin/plant/details.html.twig', ['plant' => $plant]);
    }
}
