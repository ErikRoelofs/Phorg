<?php

namespace Plu\PhorgBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FileSetFile
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Plu\PhorgBundle\Entity\FileSetFileRepository")
 */
class FileSetFile
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="File")
     */
    private $file;

    /**
     * @ORM\ManyToOne(targetEntity="FileSet")
     */
    private $fileset;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $file
     */
    public function setFile($file)
    {
        $this->file = $file;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param mixed $fileset
     */
    public function setFileset($fileset)
    {
        $this->fileset = $fileset;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFileset()
    {
        return $this->fileset;
    }

}
