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
    private int $id;

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
    private string $name;

    /**
     *
     * @ORM\Column(name="description", type="text")
     */
    private string $description;

    /**
     * @return int
     */
    public function getId(): int
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

//    /**
//     * @return string
//     */
//    public function getToDos() :string
//    {
//        return $this->toDos;
//    }
//
//    /**
//     * @param string $toDos
//     */
//    public function setToDos($toDos): void
//    {
//        $this->toDos = $toDos;
//    }

    /**
     * @return string
     */
    public function getName(): string
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
    public function getDescription(): string
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


}