<?php

namespace Plu\PhorgBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TagRelation
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Plu\PhorgBundle\Entity\TagRelationRepository")
 */
class TagRelation
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
     * @var boolean
     *
     * @ORM\Column(name="primary_parent", type="boolean")
     */
    private $primaryParent = false;

    /**
     * @var Tag
     *
     * @ORM\ManyToOne(targetEntity="Tag")
     */
    private $parent;

    /**
     * @var Tag
     *
     * @ORM\ManyToOne(targetEntity="Tag")
     */
    private $child;

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
     * @param \Plu\PhorgBundle\Entity\Tag $child
     */
    public function setChild($child)
    {
        $this->child = $child;
        return $this;
    }

    /**
     * @return \Plu\PhorgBundle\Entity\Tag
     */
    public function getChild()
    {
        return $this->child;
    }

    /**
     * @param \Plu\PhorgBundle\Entity\Tag $parent
     */
    public function setParent($parent)
    {
        $this->parent = $parent;
        return $this;
    }

    /**
     * @return \Plu\PhorgBundle\Entity\Tag
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @param boolean $primaryParent
     */
    public function setPrimaryParent($primaryParent)
    {
        $this->primaryParent = $primaryParent;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getPrimaryParent()
    {
        return $this->primaryParent;
    }



}
