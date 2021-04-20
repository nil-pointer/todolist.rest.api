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
    private int $id;

    /**
     * @ORM\Column(name="name", type="string", length=64)
     */
    private string $name;

    /**
     *
     * @ORM\Column(name="description", type="text")
     */
    private string $description;

//    /**
//     * @ORM\ManyToOne (targetEntity="App\Entity\SubTasks", inversedBy="ToDos")
//     * @ORM\JoinColumn(name="sub_tasks_id", referencedColumnName="id")
//     */
//    protected $subTasks;

    /**
     * @return int
     */
    public function getId() :int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName() :string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getDescription() :string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
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