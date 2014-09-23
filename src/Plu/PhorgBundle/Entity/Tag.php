<?php

namespace Plu\PhorgBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Tag
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Plu\PhorgBundle\Entity\TagRepository")
 */
class Tag
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
     * @ORM\OneToMany(targetEntity="TagRelation", mappedBy="child")
     */
    private $parents;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="TagRelation", mappedBy="parent")
     */
    private $children;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="TagMeta", mappedBy="tag")
     */
    private $protoMeta;

    public function __construct()
    {
        $this->protoMeta = new ArrayCollection(array());
        $this->children = new ArrayCollection(array());
        $this->parents = new ArrayCollection(array());
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
     * @return Tag
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
     * @param \Doctrine\Common\Collections\ArrayCollection $children
     */
    public function setChildRelations($children)
    {
        $this->children = $children;
        return $this;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getChildRelations()
    {
        return $this->children;
    }

    /**
     * @param \Doctrine\Common\Collections\ArrayCollection $parents
     */
    public function setParentRelations($parents)
    {
        $this->parents = $parents;
        return $this;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getParentRelations()
    {
        return $this->parents;
    }

    public function getChildren()
    {
        $out = array();
        foreach ($this->getChildRelations() as $childRelation) {
            $out[] = $childRelation->getChild();
        }
        return $out;
    }

    public function getParents()
    {
        $out = array();
        foreach ($this->getParentRelations() as $parentRelation) {
            $out[] = $parentRelation->getParent();
        }
        return $out;
    }

    public function getPrimaryParent()
    {
        foreach ($this->getParentRelations() as $parentRelation) {
            if ($parentRelation->getPrimaryParent()) {
                return $parentRelation->getParent();
            }
        }
        // this is a root node; return a (non-saved) ROOT tag
        $parent = new Tag;
        $parent->setName("ROOT");
        return $parent;
    }

    public function hasPrimaryParent()
    {
        foreach ($this->getParentRelations() as $parentRelation) {
            if ($parentRelation->getPrimaryParent()) {
                return true;
            }
        }
        return false;
    }

    public function getNonPrimaryParents()
    {
        $out = array();
        foreach ($this->getParentRelations() as $parentRelation) {
            if ($parentRelation->getPrimaryParent()) {
                continue;
            }
            $out[] = $parentRelation->getParent();
        }
        return $out;
    }

    /**
     * @param \Doctrine\Common\Collections\ArrayCollection $protoMeta
     */
    public function setProtoMeta($protoMeta)
    {
        $this->protoMeta = $protoMeta;
        return $this;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getTagProtoMeta()
    {
        return $this->protoMeta;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getProtoMeta()
    {
        $out = array();
        foreach ($this->protoMeta as $tagMeta) {
            $out[] = $tagMeta->getProtoMeta();
        }
        return $out;
    }

    public function getFullName()
    {
        $fullname = '';
        if ($this->hasPrimaryParent()) {
            $fullname .= $this->getPrimaryParent()->getFullName() . " \ ";
        }
        $fullname .= $this->getName();
        return $fullname;
    }

    public function addChildRelation(TagRelation $rel)
    {
        $this->children->add($rel);
    }

    public function addParentRelation(TagRelation $rel)
    {
        $this->parents->add($rel);
    }

}
