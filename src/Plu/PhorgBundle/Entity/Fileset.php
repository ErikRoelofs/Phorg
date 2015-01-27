<?php

namespace Plu\PhorgBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Fileset
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Plu\PhorgBundle\Entity\FilesetRepository")
 */
class Fileset implements TrackModifications
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
     * @ORM\ManyToOne(targetEntity="Filter")
     */
    private $filter;

    /**
     * @ORM\OneToMany(targetEntity="FileSetFile", mappedBy="fileset")
     */
    private $files;

    /**
     * @ORM\Column(type="datetime")
     */
    private $lastModification;

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
     * @param mixed $files
     */
    public function setFileSetFiles($files)
    {
        $this->files = $files;
        return $this;
    }

    public function getFilesetFiles()
    {
        return $this->files;
    }

    /**
     * @return mixed
     */
    public function getFiles()
    {
        $out = array();
        foreach ($this->files as $filesetfile) {
            $out[] = $filesetfile->getFile();
        }
        return $out;
    }

    public function addFile(FileSetFile $fsf)
    {
        $this->files->add($fsf);
    }

    /**
     * @param mixed $filter
     */
    public function setFilter($filter)
    {
        $this->filter = $filter;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFilter()
    {
        return $this->filter;
    }

    /**
     * @param mixed $lastModification
     */
    public function setLastModification($lastModification)
    {
        $this->lastModification = $lastModification;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLastModification()
    {
        return $this->lastModification;
    }

}
