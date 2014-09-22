<?php

namespace Plu\PhorgBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FilterTag
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class FilterTag
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
     * @var Tag
     *
     * @ORM\ManyToOne(targetEntity="Tag")
     */
    private $tag;

    /**
     * @var Filter
     *
     * @ORM\ManyToOne(targetEntity="Filter")
     */
    private $filter;

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
     * @param \Plu\PhorgBundle\Entity\Filter $filter
     */
    public function setFilter($filter)
    {
        $this->filter = $filter;
        return $this;
    }

    /**
     * @return \Plu\PhorgBundle\Entity\Filter
     */
    public function getFilter()
    {
        return $this->filter;
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
