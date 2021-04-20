<?php


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class SubTasks
 * @ORM\Entity
 * @ORM\Table(name="sub_tasks", options={"collation":"utf8_bin"})
 */
class SubTasks
{
    /**
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

//    /**
//     * OWNING SIDE
//     *
//     * @var $toDos
//     *
//     * @ORM\ManyToOne(targetEntity="App\Entity\ToDos")
//     * @ORM\JoinColumn(name="to_dos_id", referencedColumnName="id")
//     */
//    private $toDos;

    /**
     * @ORM\Column(name="name", type="string", length=64)
     */
    private $name;

    /**
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

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
    public function setId($id)
    {
        $this->id = $id;
    }

//    /**
//     * @return mixed
//     */
//    public function getToDos()
//    {
//        return $this->toDos;
//    }
//
//    /**
//     * @param mixed $toDos
//     */
//    public function setToDos($toDos): void
//    {
//        $this->toDos = $toDos;
//    }

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


}