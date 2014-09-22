<?php

namespace Plu\PhorgBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FilterMeta
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class FilterMeta
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
     * @var ProtoMeta
     *
     * @ORM\ManyToOne(targetEntity="ProtoMeta")
     */
    private $meta;

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
     * @param \Plu\PhorgBundle\Entity\ProtoMeta $meta
     */
    public function setMeta($meta)
    {
        $this->meta = $meta;
        return $this;
    }

    /**
     * @return \Plu\PhorgBundle\Entity\ProtoMeta
     */
    public function getMeta()
    {
        return $this->meta;
    }

}
