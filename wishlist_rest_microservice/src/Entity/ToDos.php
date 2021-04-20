<?php


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class ToDos
 * @ORM\Entity
 * @ORM\Table(name="todos", options={"collation":"utf8_bin"})
 */
class ToDos
{
    /**
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="name", type="string", length=64)
     */
    private $name;

    /**
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

//    /**
//     * @ORM\ManyToOne (targetEntity="App\Entity\SubTasks", inversedBy="ToDos")
//     * @ORM\JoinColumn(name="sub_tasks_id", referencedColumnName="id")
//     */
//    protected $subTasks;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

//    /**
//     * @return mixed
//     */
//    public function getSubTasks()
//    {
//        return $this->subTasks;
//    }
//
//    /**
//     * @param mixed $subTasks
//     */
//    public function setSubTasks($subTasks): void
//    {
//        $this->subTasks = $subTasks;
//    }


}