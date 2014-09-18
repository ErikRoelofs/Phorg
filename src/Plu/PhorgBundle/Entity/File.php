<?php

namespace Plu\PhorgBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * File
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Plu\PhorgBundle\Entity\FileRepository")
 */
class File
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
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="FileTag", mappedBy="file")
     */
    private $tags;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="StringMeta", mappedBy="file")
     */
    private $stringMeta;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="DateMeta", mappedBy="file")
     */
    private $dateMeta;

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
     * @param \Plu\PhorgBundle\Entity\ArrayCollection $tags
     */
    public function setTags($tags)
    {
        $this->tags = $tags;
        return $this;
    }

    /**
     * @return \Plu\PhorgBundle\Entity\ArrayCollection
     */
    public function getFileTags()
    {
        return $this->tags;
    }

    /**
     * @return \Plu\PhorgBundle\Entity\ArrayCollection
     */
    public function getTags()
    {
        $out = array();
        foreach ($this->tags as $fileTag) {
            $out[] = $fileTag->getTag();
        }
        return $out;
    }

    /**
     * @param \Plu\PhorgBundle\Entity\ArrayCollection $stringMeta
     */
    public function setStringMeta($stringMeta)
    {
        $this->stringMeta = $stringMeta;
        return $this;
    }

    /**
     * @return \Plu\PhorgBundle\Entity\ArrayCollection
     */
    public function getStringMeta()
    {
        return $this->stringMeta;
    }

    /**
     * @param \Plu\PhorgBundle\Entity\ArrayCollection $dateMeta
     */
    public function setDateMeta($dateMeta)
    {
        $this->dateMeta = $dateMeta;
        return $this;
    }

    /**
     * @return \Plu\PhorgBundle\Entity\ArrayCollection
     */
    public function getDateMeta()
    {
        return $this->dateMeta;
    }

}
