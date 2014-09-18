<?php

namespace Plu\PhorgBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TagMeta
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Plu\PhorgBundle\Entity\TagMetaRepository")
 */
class TagMeta
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
     * @var ProtoMeta
     *
     * @ORM\ManyToOne(targetEntity="ProtoMeta")
     */
    private $protoMeta;

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
     * @param \Plu\PhorgBundle\Entity\ProtoMeta $protoMeta
     */
    public function setProtoMeta($protoMeta)
    {
        $this->protoMeta = $protoMeta;
        return $this;
    }

    /**
     * @return \Plu\PhorgBundle\Entity\ProtoMeta
     */
    public function getProtoMeta()
    {
        return $this->protoMeta;
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
