<?php

namespace DemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Comment
 *
 * @ORM\Table(name="comment")
 * @ORM\Entity(repositoryClass="DemoBundle\Repository\CommentRepository")
 */
class Comment
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="string", length=255)
     */
    private $content;

    /**
     * @ORM\ManyToOne(targetEntity="DemoBundle\Entity\Task", inversedBy="comments")
     * @ORM\JoinColumn(name="task_id", referencedColumnName="id")
     */
    private $task;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Comment
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set task
     *
     * @param \DemoBundle\Entity\Task $task
     *
     * @return Comment
     */
    public function setTask(\DemoBundle\Entity\Task $task = null)
    {
        $this->task = $task;

        return $this;
    }

    /**
     * Get task
     *
     * @return \DemoBundle\Entity\Task
     */
    public function getTask()
    {
        return $this->task;
    }
}
