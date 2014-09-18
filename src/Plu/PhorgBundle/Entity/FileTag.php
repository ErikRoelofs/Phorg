<?php

namespace Plu\PhorgBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FileTag
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Plu\PhorgBundle\Entity\FileTagRepository")
 */
class FileTag
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
     * @var File
     *
     * @ORM\ManyToOne(targetEntity="File")
     */
    private $file;

    /**
     * @var Tag
     *
     * @ORM\ManyToOne(targetEntity="Tag")
     */
    private $tag;


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
     * @param \Plu\PhorgBundle\Entity\File $file
     */
    public function setFile($file)
    {
        $this->file = $file;
        return $this;
    }

    /**
     * @return \Plu\PhorgBundle\Entity\File
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param \Plu\PhorgBundle\Entity\Tag $tag
     */
    public function setTag($tag)
    {
        $this->tag = $tag;
        return $this;
    }

    /**
     * @return \Plu\PhorgBundle\Entity\Tag
     */
    public function getTag()
    {
        return $this->tag;
    }

}
