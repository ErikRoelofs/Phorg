<?php

namespace Plu\PhorgBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Filter
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Plu\PhorgBundle\Entity\FilterRepository")
 */
class Filter implements TrackModifications
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="FilterTag", mappedBy="filter")
     */
    private $tags;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="FilterMeta", mappedBy="filter")
     */
    private $meta;

    /**
     * @ORM\Column(type="datetime")
     */
    private $lastModification;

    public function __construct()
    {
        $this->tags = new ArrayCollection(array());
        $this->meta = new ArrayCollection(array());
    }

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
     * Set name
     *
     * @param string $name
     * @return Filter
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param \Doctrine\Common\Collections\ArrayCollection $meta
     */
    public function setMetaRelations($meta)
    {
        $this->meta = $meta;
        return $this;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getMetaRelations()
    {
        return $this->meta;
    }

    /**
     * @param \Doctrine\Common\Collections\ArrayCollection $tags
     */
    public function setTagRelations($tags)
    {
        $this->tags = $tags;
        return $this;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getTagRelations()
    {
        return $this->tags;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getMeta()
    {
        $out = array();
        foreach ($this->meta as $meta) {
            $out[] = $meta->getMeta();
        }
        return $out;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getTags()
    {
        $out = array();
        foreach ($this->tags as $tag) {
            $out[] = $tag->getTag();
        }
        return $out;
    }

    public function addFilterTag(FilterTag $rel)
    {
        $this->tags->add($rel);
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
