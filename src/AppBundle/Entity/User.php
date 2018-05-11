<?php

namespace AppBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\EquatableInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 */
class User implements UserInterface, \Serializable
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
     * @ORM\Column(name="username", type="string", length=255)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, unique=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;

    /**
     * @ORM\OneToMany(targetEntity="DemoBundle\Entity\Plant", mappedBy="user")
     */
    private $plants;

    /**
     * @ORM\OneToMany(targetEntity="DemoBundle\Entity\Task", mappedBy="user")
     */
    private $tasks;

    public function __construct()
    {
        $this->plants = new ArrayCollection();
    }

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
     * Set username
     *
     * @param string $username
     *
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    public function __toString()
    {
        return $this->username;
    }

    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt,
        ));
    }

    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt
            ) = unserialize($serialized, ['allowed_classes' => false]);
    }

    public function getRoles()
    {
        return ['ROLE_USER', 'ROLE_ADMIN'];
    }

    public function getSalt()
    {
        return null;
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }


    /**
     * Add plant
     *
     * @param \DemoBundle\Entity\Plant $plant
     *
     * @return User
     */
    public function addPlant(\DemoBundle\Entity\Plant $plant)
    {
        $this->plants[] = $plant;

        return $this;
    }

    /**
     * Remove plant
     *
     * @param \DemoBundle\Entity\Plant $plant
     */
    public function removePlant(\DemoBundle\Entity\Plant $plant)
    {
        $this->plants->removeElement($plant);
    }

    /**
     * Get plants
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPlants()
    {
        return $this->plants;
    }

    /**
     * Add task
     *
     * @param \DemoBundle\Entity\Task $task
     *
     * @return User
     */
    public function addTask(\DemoBundle\Entity\Task $task)
    {
        $this->tasks[] = $task;

        return $this;
    }

    /**
     * Remove task
     *
     * @param \DemoBundle\Entity\Task $task
     */
    public function removeTask(\DemoBundle\Entity\Task $task)
    {
        $this->tasks->removeElement($task);
    }

    /**
     * Get tasks
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTasks()
    {
        return $this->tasks;
    }



}
